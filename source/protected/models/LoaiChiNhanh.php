<?php

Yii::import('application.models._base.BaseLoaiChiNhanh');

class LoaiChiNhanh extends BaseLoaiChiNhanh
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    public function them($params)
    {
        // kiem tra du lieu con bi trung hay chua

        if (!$this->kiemTraTonTai($params)) {
            //neu khoa chua ton tai
            $this->setAttributes($params);
            if ($this->save())
                return 'ok';
            else
                return 'fail';
        } else
            return 'dup-error';
    }

    public function capNhat($params)
    {
        // kiem tra du lieu con bi trung hay chua
        if (!$this->kiemTraTonTai($params)) {
            $this->setAttributes($params);
            if ($this->save())
                return 'ok';
            else
                return 'fail';
        } else {

            // so sanh ma cu == ma moi
            if ($this->soKhopMa($params)) {
                $this->setAttributes($params);
                if ($this->save())
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
        $criteria->compare('ma_loai_chi_nhanh', $this->ma_loai_chi_nhanh, true);
        $criteria->compare('ten_loai_chi_nhanh', $this->ten_loai_chi_nhanh, true);

        /*$event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['LoaiChiNhanh'];
        $this->onAfterExport($event);*/

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function layDanhSachLoaiChiNhanh()
    {
        $danhSachLoaiChiNhanhModel = LoaiChiNhanh::model()->findAll();
        $danhSachLoaiChiNhanh = array();
        foreach ($danhSachLoaiChiNhanhModel as $loai) {
            $danhSachLoaiChiNhanh[$loai->id] = $loai->ten_loai_chi_nhanh;
        }
        return $danhSachLoaiChiNhanh;

    }

}