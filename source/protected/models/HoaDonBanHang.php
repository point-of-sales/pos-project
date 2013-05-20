<?php

Yii::import('application.models._base.BaseHoaDonBanHang');

class HoaDonBanHang extends BaseHoaDonBanHang
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function pivotModels()
    {
        return array(
            'tblSanPhams' => 'ChiTietHoaDonBan',
            'tblSanPhamTangs' => 'ChiTietHoaDonTang',
        );
    }

    public function relations()
    {
        return array(
            'tblSanPhams' => array(self::MANY_MANY, 'SanPham', 'tbl_ChiTietHoaDonBan(hoa_don_ban_id, san_pham_id)'),
            'chungTu' => array(self::BELONGS_TO, 'ChungTu', 'id'),
            'khachHang' => array(self::BELONGS_TO, 'KhachHang', 'khach_hang_id'),
            'hoaDonTraHangs' => array(self::HAS_MANY, 'HoaDonTraHang', 'hoa_don_ban_id'),
            'tblSanPhamTangs' => array(self::MANY_MANY, 'SanPhamTang', 'tbl_ChiTietHoaDonTang(hoa_don_ban_id,san_pham_tang_id)'),
        );
    }

    public function them($params)
    {
        // kiem tra du lieu con bi trung hay chua

        if (!$this->baseModel->kiemTraTonTai($params[$this->baseTableName])) {
            //neu khoa chua ton tai
            $this->setAttributes($params);
            if (!empty($params['ChiTietHoaDonBan'])) {

                $cthd_hang_ban = Helpers::formatArray($params['ChiTietHoaDonBan']);
                if (!empty($params['ChiTietHoaDonTang'])) {
                    $cthd_hang_tang = Helpers::formatArray($params['ChiTietHoaDonTang']);
                    $relatedData = array(
                        // fill related with data from the Session
                        'tblSanPhams' => $cthd_hang_ban,
                        'tblSanPhamTangs' => $cthd_hang_tang,
                    );
                } else {
                    $relatedData = array(
                        // fill related with data from the Session
                        'tblSanPhams' => Helpers::formatArray($cthd_hang_ban),
                    );
                }
            } else
                return 'detail-error';


            if ($this->saveWithRelated($relatedData)) {

                // Tru vao so luong tung chi nhanh tblSanPhamChiNhanh
                $chiNhanh = ChiNhanh::model()->findByPk($this->baseModel->chi_nhanh_id);

                foreach ($cthd_hang_ban as $key => $itemsInfo) {

                    $product = SanPham::model()->findByPk($key); // update scenario
                    $product->chi_nhanh_id = $this->baseModel->chi_nhanh_id;
                    $currentQuantity = $product->laySoLuongTonHienTai();
                    $newQuantity = $currentQuantity - $itemsInfo['so_luong'];
                    $relatedQuantitySanPhams[$key] = array('so_ton' => $newQuantity, 'trang_thai' => 1);
                }

                if (isset($cthd_hang_tang)) {
                    foreach ($cthd_hang_tang as $key => $itemsInfo) {
                        $product = SanPhamTang::model()->findByPk($key); // update scenario
                        $product->chi_nhanh_id = $this->baseModel->chi_nhanh_id;
                        $currentQuantity = $product->laySoLuongTonHienTai();
                        $newQuantity = $currentQuantity - $itemsInfo['so_luong'];
                        $relatedQuantitySanPhamTangs[$key] = array('so_ton' => $newQuantity, 'trang_thai' => 1);
                    }
                    $relatedQuantityData = array(
                        'tblSanPhams' => $relatedQuantitySanPhams,
                        'tblSanPhamTangs' => $relatedQuantitySanPhamTangs,
                    );
                } else {
                    $relatedQuantityData = array(
                        'tblSanPhams' => $relatedQuantitySanPhams,
                    );
                }

                if ($chiNhanh->saveWithRelated($relatedQuantityData, false, null, array(), true, true))
                    return 'ok';
            } else
                return 'fail';
        } else
            return 'dup-error';
    }

    public function capNhat($params)
    {
        // kiem tra du lieu con bi trung hay chua
        $relatedData = array(
            'tblSanPhams' => $_POST['HoaDonBanHang']['tblSanPhams'] === '' ? null : $_POST['HoaDonBanHang']['tblSanPhams'],
        );
        if (!$this->kiemTraTonTai($params)) {
            $this->setAttributes($params);
            if ($this->saveWithRelated($relatedData))
                return 'ok';
            else
                return 'fail';
        } else {

            // so sanh ma cu == ma moi
            if ($this->soKhopMa($params)) {
                $this->setAttributes($params);
                if ($this->saveWithRelated($relatedData))
                    return 'ok';
                else
                    return 'fail';
            } else
                return 'dup-error';

        }
    }

    public function xoa()
    {
        $relation = $this->kiemTraQuanHe($this->id);
        if (!$relation) {
            if ($this->delete())
                return 'ok';
            else
                return 'fail';
        } else {
            return 'rel-error';
        }
    }


    public function xuatFileExcel()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('chiet_khau', $this->chiet_khau);
        $criteria->compare('khach_hang_id', $this->khach_hang_id);

        /*$event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['HoaDonBanHang'];
        $this->onAfterExport($event);*/

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function layMaHoaDonMoi()
    {

        $maxId = Yii::app()->db->createCommand()
            ->select('max(id)')
            ->from('tbl_HoaDonBanHang')
            ->queryScalar();

        $model = HoaDonBanHang::model()->findByPk($maxId);
        if (isset($model)) {

            $ma_chung_tu = $model->getBaseModel()->ma_chung_tu;
            $str = parent::taoMaChungTuMoi($ma_chung_tu, 'BH', 13);
        } else {
            $str = parent::taoMaChungTuMoi('', 'BH', 13);
        }
        return $str;
    }

}