<?php

Yii::import('application.models._base.BaseCauHinh');

class CauHinh extends BaseCauHinh
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

                                $criteria->compare('so_san_pham_tren_trang', $this->so_san_pham_tren_trang);
                                $criteria->compare('so_phan_trang', $this->so_phan_trang);
                                $criteria->compare('bat_buoc_thong_tin_khach_hang', $this->bat_buoc_thong_tin_khach_hang);
                                $criteria->compare('so_luong_ton_canh_bao', $this->so_luong_ton_canh_bao);
        
        $event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['CauHinh'];
        $this->onAfterExport($event);

        return new CActiveDataProvider($this, array(
        'criteria' => $criteria,
        ));
        }


}