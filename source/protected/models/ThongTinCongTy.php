<?php

Yii::import('application.models._base.BaseThongTinCongTy');

class ThongTinCongTy extends BaseThongTinCongTy
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}


    public function them($params) {
        // kiem tra du lieu con bi trung hay chua

        if(!$this->kiemTraTonTai($params)) {
            //neu khoa chua ton tai
            $this->setAttributes($params);
                            if ($this->save())
                        return 'ok';
            else
                return 'fail';
        } else
                return 'dup-error';
    }

    public function capNhat($params) {
        // kiem tra du lieu con bi trung hay chua
                if(!$this->kiemTraTonTai($params)) {
            $this->setAttributes($params);
                            if ($this->save())
                                return 'ok';
                else
                    return 'fail';
        } else {

        // so sanh ma cu == ma moi
        if($this->soKhopMa($params)) {
            $this->setAttributes($params);
                            if ($this->save())
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

                                $criteria->compare('ten_cong_ty', $this->ten_cong_ty, true);
                                $criteria->compare('dia_chi', $this->dia_chi, true);
                                $criteria->compare('dien_thoai', $this->dien_thoai, true);
                                $criteria->compare('fax', $this->fax, true);
                                $criteria->compare('email', $this->email, true);
                                $criteria->compare('website', $this->website, true);
        
        /*$event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['ThongTinCongTy'];
        $this->onAfterExport($event);*/

        return new CActiveDataProvider($this, array(
        'criteria' => $criteria,
        ));
        }


}