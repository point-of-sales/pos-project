<?php

Yii::import('application.models._base.BaseHoaDonTraHang');

class HoaDonTraHang extends BaseHoaDonTraHang
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
    
    public function rules() {
		return array(
			array('hoa_don_ban_id, ly_do_tra_hang', 'required'),
			array('id, hoa_don_ban_id', 'numerical', 'integerOnly'=>true),
			array('ly_do_tra_hang', 'safe'),
			array('ly_do_tra_hang', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, ly_do_tra_hang, hoa_don_ban_id', 'safe', 'on'=>'search'),
		);
	}


    public function them($params) {
        /*
        // kiem tra du lieu con bi trung hay chua

        if(!$this->kiemTraTonTai($params)) {
            //neu khoa chua ton tai
            $this->setAttributes($params);
                    $relatedData = array(
				'tblSanPhams' => $_POST['HoaDonTraHang']['tblSanPhams'] === '' ? null : $_POST['HoaDonTraHang']['tblSanPhams'],
				);
                            if ($this->saveWithRelated($relatedData))
                        return 'ok';
            else
                return 'fail';
        } else
                return 'dup-error';*/
        
        // kiem tra du lieu con bi trung hay chua
        
        //var_dump($this);exit;
        if (!$this->kiemTraTonTai($params['ChungTu'])) {
            //neu khoa chua ton tai
            $this->setAttributes($params['HoaDonTraHang']);
            if (!empty($params['ChiTietHoaDonTra'])) {
                $cthd_tra = Helpers::formatArray($params['ChiTietHoaDonTra']);
                $relatedData = array(
                    // fill related with data from the Session
                    'tblSanPhams' => $cthd_tra,
                );
            } else
                return 'detail-error';

            if ($this->saveWithRelated($relatedData)) {

                // Tru vao so luong tung chi nhanh tblSanPhamChiNhanh
                $chiNhanh = ChiNhanh::model()->findByPk($this->baseModel->chi_nhanh_id);

                foreach ($cthd_tra as $key => $itemsInfo) {

                    $product = SanPham::model()->findByPk($key); // update scenario
                    $product->chi_nhanh_id = $this->baseModel->chi_nhanh_id;
                    $currentQuantity = $product->laySoLuongTonHienTai();
                    $newQuantity = $currentQuantity - $itemsInfo['so_luong'];
                    $relatedQuantitySanPhams[$key] = array('so_ton' => $newQuantity, 'trang_thai' => 1);
                }

                $relatedQuantityData = array(
                    'tblSanPhams' => $relatedQuantitySanPhams,
                );

                if ($chiNhanh->saveWithRelated($relatedQuantityData, false, null, array(), true, true))
                    return 'ok';
            } else
                return 'fail';
        } else
            return 'dup-error';
    }

    public function capNhat($params) {
        // kiem tra du lieu con bi trung hay chua
                    $relatedData = array(
				'tblSanPhams' => $_POST['HoaDonTraHang']['tblSanPhams'] === '' ? null : $_POST['HoaDonTraHang']['tblSanPhams'],
				);
                if(!$this->kiemTraTonTai($params)) {
            $this->setAttributes($params);
                            if ($this->saveWithRelated($relatedData))
                                return 'ok';
                else
                    return 'fail';
        } else {

        // so sanh ma cu == ma moi
        if($this->soKhopMa($params)) {
            $this->setAttributes($params);
                            if ($this->saveWithRelated($relatedData))
                                return 'ok';
                else
                    return 'fail';
        } else
                return 'dup-error';

        }
    }

    public function xoa() {
        $relation = $this->kiemTraQuanHe($this->id);
        if(!$relation) {
            if($this->delete())
                return 'ok';
            else
                return 'fail';
        } else {
            return 'rel-error';
        }
    }


    public function xuatFileExcel() {
        $criteria = new CDbCriteria;

                                $criteria->compare('id', $this->id);
                                $criteria->compare('ly_do_tra_hang', $this->ly_do_tra_hang, true);
                                $criteria->compare('hoa_don_ban_id', $this->hoa_don_ban_id);
        
        /*$event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['HoaDonTraHang'];
        $this->onAfterExport($event);*/

        return new CActiveDataProvider($this, array(
        'criteria' => $criteria,
        ));
        }
        
    public static function layMaHoaDonMoi()
    {

        $maxId = Yii::app()->db->createCommand()
            ->select('max(id)')
            ->from('tbl_HoaDonTraHang')
            ->queryScalar();

        $model = HoaDonTraHang::model()->findByPk($maxId);
        if (isset($model)) {

            $ma_chung_tu = $model->getBaseModel()->ma_chung_tu;
            $str = parent::taoMaChungTuMoi($ma_chung_tu, 'TH', 13);
        } else {
            $str = parent::taoMaChungTuMoi('', 'TH', 13);
        }
        return $str;
    }


}