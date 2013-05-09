<?php

Yii::import('application.models._base.BaseKhuyenMaiChiNhanh');

class KhuyenMaiChiNhanh extends BaseKhuyenMaiChiNhanh
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

        $criteria->compare('khuyen_mai_id', $this->khuyen_mai_id);
        $criteria->compare('chi_nhanh_id', $this->chi_nhanh_id);

        /*$event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['KhuyenMaiChiNhanh'];
        $this->onAfterExport($event);*/

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }


}