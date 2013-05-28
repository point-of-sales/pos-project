<?php

Yii::import('application.models._base.BaseKhuVuc');

class KhuVuc extends BaseKhuVuc
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('viLib', 'ID'),
            'ma_khu_vuc' => Yii::t('viLib', 'Area Id'),
            'ten_khu_vuc' => Yii::t('viLib', 'Area Name'),
            'mo_ta' => Yii::t('viLib', 'Description'),
            'chiNhanhs' => null,
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

    public function xuatFileExcel() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('ma_khu_vuc', $this->ma_khu_vuc, true);
        $criteria->compare('ten_khu_vuc', $this->ten_khu_vuc, true);
        $criteria->compare('mo_ta', $this->mo_ta, true);

       /* $event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['KhuVuc'];
        $this->onAfterExport($event);*/

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function layDanhSachKhuVuc()
    {
        $khuVucModel = KhuVuc::model()->findAll();
        $danhSachKhuVuc = array();
        foreach ($khuVucModel as $khuVuc) {
            $danhSachKhuVuc[$khuVuc->id] = $khuVuc->ten_khu_vuc;
        }
        return $danhSachKhuVuc;
    }


}