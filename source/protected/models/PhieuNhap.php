<?php

Yii::import('application.models._base.BasePhieuNhap');

class PhieuNhap extends BasePhieuNhap
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
				'tblSanPhams' => $_POST['PhieuNhap']['tblSanPhams'] === '' ? null : $_POST['PhieuNhap']['tblSanPhams'],
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
				'tblSanPhams' => $_POST['PhieuNhap']['tblSanPhams'] === '' ? null : $_POST['PhieuNhap']['tblSanPhams'],
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
                                $criteria->compare('loai_nhap_vao', $this->loai_nhap_vao);
                                $criteria->compare('chi_nhanh_xuat_id', $this->chi_nhanh_xuat_id);
        
        $event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['PhieuNhap'];
        $this->onAfterExport($event);

        return new CActiveDataProvider($this, array(
        'criteria' => $criteria,
        ));
        }


}