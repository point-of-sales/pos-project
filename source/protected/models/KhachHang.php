<?php

Yii::import('application.models._base.BaseKhachHang');

class KhachHang extends BaseKhachHang
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

                                $criteria->compare('id', $this->id);
                                $criteria->compare('ma_khach_hang', $this->ma_khach_hang, true);
                                $criteria->compare('ho_ten', $this->ho_ten, true);
                                $criteria->compare('ngay_sinh', $this->ngay_sinh, true);
                                $criteria->compare('dia_chi', $this->dia_chi, true);
                                $criteria->compare('thanh_pho', $this->thanh_pho, true);
                                $criteria->compare('dien_thoai', $this->dien_thoai, true);
                                $criteria->compare('email', $this->email, true);
                                $criteria->compare('mo_ta', $this->mo_ta, true);
                                $criteria->compare('diem_tich_luy', $this->diem_tich_luy);
                                $criteria->compare('loai_khach_hang_id', $this->loai_khach_hang_id);
        
        $event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['KhachHang'];
        $this->onAfterExport($event);

        return new CActiveDataProvider($this, array(
        'criteria' => $criteria,
        ));
        }


}