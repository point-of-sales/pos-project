<?php

Yii::import('application.models._base.BaseNhaCungCap');

class NhaCungCap extends BaseNhaCungCap
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function attributeLabels() {
        return array(
            'id' => Yii::t('viLib', 'ID'),
            'ma_nha_cung_cap' => Yii::t('viLib', 'Supplier code'),
            'ten_nha_cung_cap' => Yii::t('viLib', 'Supplier name'),
            'mo_ta' => Yii::t('viLib', 'Description'),
            'dien_thoai' => Yii::t('viLib', 'Phone'),
            'email' => Yii::t('viLib', 'Email'),
            'fax' => Yii::t('viLib', 'Fax'),
            'trang_thai' => Yii::t('viLib', 'Status'),
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

    public function search() {
        $criteria = new CDbCriteria;
        $cauHinh = CauHinh::model()->findByPk(1);
        $criteria->compare('ma_nha_cung_cap', $this->ma_nha_cung_cap, true);
        $criteria->compare('ten_nha_cung_cap', $this->ten_nha_cung_cap, true);
        $criteria->compare('trang_thai', $this->trang_thai);

        $numberRecords = $cauHinh->so_muc_tin_tren_trang;

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>$numberRecords,
            ),
        ));
    }

    public function xuatFileExcel()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('ma_nha_cung_cap', $this->ma_nha_cung_cap, true);
        $criteria->compare('ten_nha_cung_cap', $this->ten_nha_cung_cap, true);
        $criteria->compare('mo_ta', $this->mo_ta, true);
        $criteria->compare('dien_thoai', $this->dien_thoai, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('fax', $this->fax, true);
        $criteria->compare('trang_thai', $this->trang_thai);

        /*$event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['NhaCungCap'];
        $this->onAfterExport($event);*/

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }


}