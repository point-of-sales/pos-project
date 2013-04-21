<?php

Yii::import('application.models._base.BaseKhuyenMai');

class KhuyenMai extends BaseKhuyenMai
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
				'tblChiNhanhs' => $_POST['KhuyenMai']['tblChiNhanhs'] === '' ? null : $_POST['KhuyenMai']['tblChiNhanhs'],
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
				'tblChiNhanhs' => $_POST['KhuyenMai']['tblChiNhanhs'] === '' ? null : $_POST['KhuyenMai']['tblChiNhanhs'],
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
                                $criteria->compare('ma_chuong_trinh', $this->ma_chuong_trinh, true);
                                $criteria->compare('ten_chuong_trinh', $this->ten_chuong_trinh, true);
                                $criteria->compare('mo_ta', $this->mo_ta, true);
                                $criteria->compare('gia_giam', $this->gia_giam);
                                $criteria->compare('thoi_gian_bat_dau', $this->thoi_gian_bat_dau, true);
                                $criteria->compare('thoi_gian_ket_thuc', $this->thoi_gian_ket_thuc, true);
                                $criteria->compare('trang_thai', $this->trang_thai);
                                $criteria->compare('chi_nhanh_id', $this->chi_nhanh_id);
        
        $event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['KhuyenMai'];
        $this->onAfterExport($event);

        return new CActiveDataProvider($this, array(
        'criteria' => $criteria,
        ));
        }


}