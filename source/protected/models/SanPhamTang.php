<?php

Yii::import('application.models._base.BaseSanPhamTang');

class SanPhamTang extends BaseSanPhamTang
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}


    public function them($params) {
        // kiem tra du lieu con bi trung hay chua

        if(!$this->kiemTraTonTai($params)) {
            //neu khoa chua ton tai
            $this->setAttributes($params);
                    $relatedData = array(
				'tblChiNhanhs' => $_POST['SanPhamTang']['tblChiNhanhs'] === '' ? null : $_POST['SanPhamTang']['tblChiNhanhs'],
				);
                            if ($this->saveWithRelated($relatedData))
                        return 'ok';
            else
                return 'fail';
        } else
                return 'dup-error';
    }

    public function capNhat($params) {
        // kiem tra du lieu con bi trung hay chua
                    $relatedData = array(
				'tblChiNhanhs' => $_POST['SanPhamTang']['tblChiNhanhs'] === '' ? null : $_POST['SanPhamTang']['tblChiNhanhs'],
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
                                $criteria->compare('ma_vach', $this->ma_vach, true);
                                $criteria->compare('ten_san_pham', $this->ten_san_pham, true);
                                $criteria->compare('gia_tang', $this->gia_tang);
                                $criteria->compare('thoi_gian_bat_dau', $this->thoi_gian_bat_dau, true);
                                $criteria->compare('thoi_gian_ket_thuc', $this->thoi_gian_ket_thuc, true);
                                $criteria->compare('mo_ta', $this->mo_ta, true);
        
        $event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['SanPhamTang'];
        $this->onAfterExport($event);

        return new CActiveDataProvider($this, array(
        'criteria' => $criteria,
        ));
        }


}