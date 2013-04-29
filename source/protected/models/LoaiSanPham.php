<?php

Yii::import('application.models._base.BaseLoaiSanPham');

class LoaiSanPham extends BaseLoaiSanPham
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function attributeLabels() {
        return array(
            'id' => Yii::t('viLib', 'ID'),
            'ma_loai' => Yii::t('viLib', 'Type code'),
            'ten_loai' => Yii::t('viLib', 'Type name'),
            'sanPhams' => null,
        );
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
        $criteria->compare('ma_loai', $this->ma_loai, true);
        $criteria->compare('ten_loai', $this->ten_loai, true);

        /*$event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['LoaiSanPham'];
        $this->onAfterExport($event);*/

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }


}