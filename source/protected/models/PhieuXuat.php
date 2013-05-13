<?php

Yii::import('application.models._base.BasePhieuXuat');

class PhieuXuat extends BasePhieuXuat
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function attributeLabels()
    {
        return array(
            'id' => null,
            'ly_do_xuat' => Yii::t('viLib', 'Export reason'),
            'loai_xuat_ra' => Yii::t('viLib', 'Export type'),
            'chi_nhanh_nhap_id' => Yii::t('viLib', 'Import branch'),
            'tblSanPhams' => null,
            'chiNhanhNhap' => null,
            'id0' => null,
        );
    }

    public function rules()
    {
        return array(
            array('ly_do_xuat, loai_xuat_ra, chi_nhanh_nhap_id', 'required'),
            array('id, loai_xuat_ra, chi_nhanh_nhap_id', 'numerical', 'integerOnly' => true),
            array('id, ly_do_xuat, loai_xuat_ra, chi_nhanh_nhap_id', 'safe', 'on' => 'search'),
            array('chi_nhanh_nhap_id', 'ext.custom-validator.CPOSBranchValidator'),
        );
    }


    public function relations()
    {
        return array(
            'tblSanPhams' => array(self::MANY_MANY, 'SanPham', 'tbl_ChiTietPhieuXuat(phieu_xuat_id, san_pham_id)'),
            'tblSanPhamTangs' => array(self::MANY_MANY, 'SanPhamTang', 'tbl_ChiTietPhieuXuatSanPhamTang(phieu_xuat_id, san_pham_tang_id)'),
            'chiNhanhNhap' => array(self::BELONGS_TO, 'ChiNhanh', 'chi_nhanh_nhap_id'),
            'chungTu' => array(self::BELONGS_TO, 'ChungTu', 'id'),
            'loaiNhapXuat'=>array(self::BELONGS_TO, 'LoaiNhapXuat', 'loai_xuat_ra')
        );
    }

    public function pivotModels()
    {
        return array(
            'tblSanPhams' => 'ChiTietPhieuXuat',
            'tblSanPhamTangs' => 'ChiTietPhieuXuatSanPhamTang',
        );
    }

    public function them($params)
    {
        // kiem tra du lieu con bi trung hay chua

        if (!$this->baseModel->kiemTraTonTai($params[$this->baseTableName])) {
            //neu khoa chua ton tai
            $this->setAttributes($params);
            if (!Yii::app()->CPOSSessionManager->isEmpty('ChiTietPhieuXuat')) {
                $sessionData = Yii::app()->CPOSSessionManager->getItem('ChiTietPhieuXuat');
                $items = $sessionData['items'];
                $relatedItems = Helpers::formatArray($items);
                $relatedData = array(
                    // fill related with data from the Session
                    'tblSanPhams' => $relatedItems,
                );
            } else
                return 'detail-error';
            if ($this->saveWithRelated($relatedData)) {
                // Tru vao so luong tung chi nhanh tblSanPhamChiNhanh
                $chiNhanh = ChiNhanh::model()->findByPk($this->baseModel->chi_nhanh_id);
                foreach ($relatedItems as $key => $itemsInfo) {
                    $product = SanPham::model()->findByPk($key); // update scenario
                    $product->chi_nhanh_id = $this->baseModel->chi_nhanh_id;
                    $currentQuantity = $product->laySoLuongTonHienTai();
                    $newQuantity = $currentQuantity - $itemsInfo['so_luong'];
                    $relatedQuantityItems[$key] = array('so_ton' => $newQuantity);
                }
                $relatedQuantityData = array(
                    'tblSanPhams' => $relatedQuantityItems,
                );

                if ($chiNhanh->saveWithRelated($relatedQuantityData, false, null, array(), true, true))
                    return 'ok';
            } else
                return 'fail';
        } else
            return 'dup-error';
    }


    public function xuatSanPhamTang($params)
    {
        // kiem tra du lieu con bi trung hay chua

        if (!$this->baseModel->kiemTraTonTai($params[$this->baseTableName])) {
            //neu khoa chua ton tai

            $this->setAttributes($params);

            if (!Yii::app()->CPOSSessionManager->isEmpty('ChiTietPhieuXuat')) {
                $sessionData = Yii::app()->CPOSSessionManager->getItem('ChiTietPhieuXuat');
                $items = $sessionData['items'];
                $relatedItems = Helpers::formatArray($items);
                $relatedData = array(
                    // fill related with data from the Session
                    'tblSanPhamTangs' => $relatedItems,
                );
            } else
                return 'detail-error';
            if ($this->saveWithRelated($relatedData)) {
                // Tru vao so luong tung chi nhanh tblSanPhamChiNhanh
                $chiNhanh = ChiNhanh::model()->findByPk($this->baseModel->chi_nhanh_id);
                foreach ($relatedItems as $key => $itemsInfo) {
                    $giftProduct = SanPhamTang::model()->findByPk($key); // update scenario
                    $giftProduct->chi_nhanh_id = $this->baseModel->chi_nhanh_id;
                    $currentQuantity = $giftProduct->laySoLuongTonHienTai();
                    $newQuantity = $currentQuantity - $itemsInfo['so_luong'];
                    $relatedQuantityItems[$key] = array('so_ton' => $newQuantity);
                }
                $relatedQuantityData = array(
                    'tblSanPhamTangs' => $relatedQuantityItems,
                );

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
            'tblSanPhams' => $_POST['PhieuXuat']['tblSanPhams'] === '' ? null : $_POST['PhieuXuat']['tblSanPhams'],
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
        $criteria->compare('ly_do_xuat', $this->ly_do_xuat, true);
        $criteria->compare('loai_xuat_ra', $this->loai_xuat_ra);
        $criteria->compare('chi_nhanh_nhap_id', $this->chi_nhanh_nhap_id);

        /* $event = new CPOSSessionEvent();
         $event->currentSession = Yii::app()->session['PhieuXuat'];
         $this->onAfterExport($event);*/

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('ly_do_xuat', $this->ly_do_xuat, true);
        $criteria->compare('loai_xuat_ra', $this->loai_xuat_ra);
        $criteria->compare('chi_nhanh_nhap_id', $this->chi_nhanh_nhap_id);
        /* $event = new CPOSSessionEvent();
         $event->currentSession = Yii::app()->session['PhieuXuat'];
         $this->onAfterExport($event);*/

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }



}