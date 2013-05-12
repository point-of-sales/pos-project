<?php

Yii::import('application.models._base.BaseHoaDonBanHang');

class HoaDonBanHang extends BaseHoaDonBanHang
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}


    public function them($params) {
        // kiem tra du lieu con bi trung hay chua

        if (!$this->baseModel->kiemTraTonTai($params[$this->baseTableName])) {
            //neu khoa chua ton tai
            $this->setAttributes($params);
            if(!Yii::app()->CPOSSessionManager->isEmpty('ChiTietHoaDonBan')) {
                $sessionData = Yii::app()->CPOSSessionManager->getItem('ChiTietHoaDonBan');
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
                foreach($relatedItems as $key=>$itemsInfo) {
                    $product = SanPham::model()->findByPk($key);  // update scenario
                    $product->chi_nhanh_id = $this->baseModel->chi_nhanh_id;
                    $currentQuantity = $product->laySoLuongTonHienTai();
                    $newQuantity = $currentQuantity - $itemsInfo['so_luong'];
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

    public function capNhat($params) {
        // kiem tra du lieu con bi trung hay chua
                    $relatedData = array(
				'tblSanPhams' => $_POST['HoaDonBanHang']['tblSanPhams'] === '' ? null : $_POST['HoaDonBanHang']['tblSanPhams'],
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
                                $criteria->compare('chiet_khau', $this->chiet_khau);
                                $criteria->compare('khach_hang_id', $this->khach_hang_id);
        
        /*$event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['HoaDonBanHang'];
        $this->onAfterExport($event);*/

        return new CActiveDataProvider($this, array(
        'criteria' => $criteria,
        ));
        }
        
    public static function layMaHoaDonMoi(){
  
         $maxId = Yii::app()->db->createCommand()
                    ->select('max(id)')
                    ->from('tbl_HoaDonBanHang')
                    ->queryScalar();
        
        $model = HoaDonBanHang::model()->findByPk($maxId);
        
        $ma_chung_tu = 'BH0000000001'; 
        if(isset($model)){
            $ma_chung_tu = $model->getBaseModel()->ma_chung_tu;
            $ma_chung_tu = substr($ma_chung_tu,2);
            $ma_chung_tu = ((int)$ma_chung_tu)+1;
        }
        return $ma_chung_tu;
    }


}