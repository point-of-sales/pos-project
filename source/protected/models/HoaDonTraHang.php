<?php

Yii::import('application.models._base.BaseHoaDonTraHang');

class HoaDonTraHang extends BaseHoaDonTraHang
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
				'tblSanPhams' => $_POST['HoaDonTraHang']['tblSanPhams'] === '' ? null : $_POST['HoaDonTraHang']['tblSanPhams'],
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


}