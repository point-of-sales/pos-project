<?php

Yii::import('application.models._base.BasePhieuNhap');

class PhieuNhap extends BasePhieuNhap
{

   public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function attributeLabels() {
        return array(
            'id' => null,
            'loai_nhap_vao' => Yii::t('viLib', 'Import type'),
            'chi_nhanh_xuat_id' => Yii::t('viLib', 'Exported branch'),
            'nha_cung_cap_id'=>Yii::t('viLib','Supplier'),
            'tblSanPhams' => null,
            'id0' => null,
            'chiNhanhXuat' => null,
        );
    }

    public function rules()
    {
        return array(
            array('loai_nhap_vao, chi_nhanh_xuat_id', 'required'),
            array('chi_nhanh_xuat_id,nha_cung_cap_id', 'numerical', 'integerOnly' => true),
            array('id, loai_nhap_vao, chi_nhanh_xuat_id, nha_cung_cap_id', 'safe', 'on' => 'search'),
            array('chi_nhanh_xuat_id','ext.custom-validator.CPOSSupplierValidator'),
            array('chi_nhanh_xuat_id','ext.custom-validator.CPOSBranchValidator'),
        );
    }

    public function them($params)
    {
        // kiem tra du lieu con bi trung hay chua

        if (!$this->baseModel->kiemTraTonTai($params[$this->baseTableName])) {
            //neu khoa chua ton tai

            $this->setAttributes($params);
            if(!Yii::app()->CPOSSessionManager->isEmpty('ChiTietPhieuNhap')) {
                $sessionData = Yii::app()->CPOSSessionManager->getKey('ChiTietPhieuNhap');
                $items = $sessionData['items'];
                $relatedItems = Helpers::formatArray($items);
                $relatedData = array(
                    // fill related with data from the Session
                    'tblSanPhams' => $relatedItems,
                );
            } else
                return 'detail-error';
            if ($this->saveWithRelated($relatedData)) {
                // Cong vao so luong tung chi nhanh tblSanPhamChiNhanh
                $chiNhanh = ChiNhanh::model()->findByPk($this->baseModel->chi_nhanh_id);
                foreach($relatedItems as $key=>$itemsInfo) {
                    $product = SanPham::model()->findByPk($key);  // update scenario
                    $product->chi_nhanh_id = $this->baseModel->chi_nhanh_id;
                    $currentQuantity = $product->laySoLuongTonHienTai();
                    $newQuantity = $currentQuantity + $itemsInfo['so_luong'];
                    $relatedQuantityItems[$key] = array('so_ton'=>$newQuantity);
                }
                $relatedQuantityData  = array(
                    'tblSanPhams' => $relatedQuantityItems,
                );

                if($chiNhanh->saveWithRelated($relatedQuantityData,false,null,array(),true,true))
                    return 'ok';
            }
            else
                return 'fail';
        } else
            return 'dup-error';
    }

    public function capNhat($params)
    {
        // kiem tra du lieu con bi trung hay chua
        $relatedData = array(
            //'tblSanPhams' => $_POST['PhieuNhap']['tblSanPhams'] === '' ? null : $_POST['PhieuNhap']['tblSanPhams'],
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
        $criteria->compare('loai_nhap_vao', $this->loai_nhap_vao);
        $criteria->compare('chi_nhanh_xuat_id', $this->chi_nhanh_xuat_id);

        /*$event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['PhieuNhap'];
        $this->onAfterExport($event);*/

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function layDanhSachLoaiNhap() {
        return array(Yii::t('viLib','Import for sale'),Yii::t('viLib','Import for borrow'),Yii::t('viLib','Import for test'));
    }

    public function layTenLoaiNhap() {
        $danhSachLoaiNhap = $this->layDanhSachLoaiNhap();
        return $danhSachLoaiNhap[$this->loai_nhap_vao];
    }

}