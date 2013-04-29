<?php

Yii::import('application.models._base.BaseQuyen');

class Quyen extends BaseQuyen
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
				'tblNhanViens' => $_POST['Quyen']['tblNhanViens'] === '' ? null : $_POST['Quyen']['tblNhanViens'],
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
				'tblNhanViens' => $_POST['Quyen']['tblNhanViens'] === '' ? null : $_POST['Quyen']['tblNhanViens'],
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
                                $criteria->compare('ten_quyen', $this->ten_quyen, true);
                                $criteria->compare('loai', $this->loai);
                                $criteria->compare('mo_ta', $this->mo_ta, true);
                                $criteria->compare('bizrule', $this->bizrule, true);
                                $criteria->compare('tham_so', $this->tham_so, true);
        
       /* $event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['Quyen'];
        $this->onAfterExport($event);*/

        return new CActiveDataProvider($this, array(
        'criteria' => $criteria,
        ));
        }


}