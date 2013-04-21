<?php

Yii::import('application.models._base.BaseSanPhamTang');

class SanPhamTang extends BaseSanPhamTang
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    public static function label($n = 1) {
        if($n <= 1 ) {
            return Yii::t('viLib', 'Gift product');
        } else {
            return Yii::t('viLib', 'Gift products');
        }
    }

    public function rules() {
        return array(
            array('ma_vach, ten_san_pham, gia_tang, thoi_gian_bat_dau, thoi_gian_ket_thuc, trang_thai', 'required'),
            array('trang_thai', 'numerical', 'integerOnly'=>true),
            array('gia_tang', 'numerical'),
            array('ma_vach', 'length', 'max'=>15),
            array('ten_san_pham', 'length', 'max'=>100),
            array('mo_ta', 'safe'),
            array('mo_ta', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, ma_vach, ten_san_pham, gia_tang, thoi_gian_bat_dau, thoi_gian_ket_thuc, mo_ta, trang_thai', 'safe', 'on'=>'search'),
            array('thoi_gian_bat_dau', 'ext.custom-validator.CPOSDateTimeValidator','on'=>'them'),
            array('thoi_gian_ket_thuc', 'ext.custom-validator.CPOSDateTimeValidator','on'=>'them'),
            array('thoi_gian_ket_thuc','compare','compareAttribute'=>'thoi_gian_bat_dau','operator'=>'>','allowEmpty'=>false,'message'=>Yii::t('viLib','End time have to greater start time')),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => Yii::t('viLib', 'ID'),
            'ma_vach' => Yii::t('viLib', 'Barcode'),
            'ten_san_pham' => Yii::t('viLib', 'Product name'),
            'gia_tang' => Yii::t('viLib', 'Bill value for offering'),
            'thoi_gian_bat_dau' => Yii::t('viLib', 'Start date'),
            'thoi_gian_ket_thuc' => Yii::t('viLib', 'End date'),
            'mo_ta' => Yii::t('viLib', 'Description'),
            'trang_thai'=>Yii::t('viLib', 'Status'),
            'tblChiNhanhs' => null,
        );
    }

    public function them($params)
    {
        // kiem tra du lieu con bi trung hay chua
        $this->scenario = 'them';
        if (!$this->kiemTraTonTai($params)) {
            //neu khoa chua ton tai
            $this->setAttributes($params);
            $relatedData = array(
                //'tblChiNhanhs' => $_POST['SanPhamTang']['tblChiNhanhs'] === '' ? null : $_POST['SanPhamTang']['tblChiNhanhs'],
            );
            if ($this->saveWithRelated($relatedData))
                return 'ok';
            else
                return 'fail';
        } else
            return 'dup-error';
    }

    public function capNhat($params)
    {
        $this->scenario = 'capnhat';
        // kiem tra du lieu con bi trung hay chua
        $relatedData = array(
            //'tblChiNhanhs' => $_POST['SanPhamTang']['tblChiNhanhs'] === '' ? null : $_POST['SanPhamTang']['tblChiNhanhs'],
        );
        if (!$this->kiemTraTonTai($params)) {
            $this->setAttributes($params);
            if ($this->saveWithRelated($relatedData))
                return 'ok';
            else
                return 'fail';
        } else {

            // so sanh ma cu == ma moi
            if ($this->soKhopMa($params)) {
                $this->setAttributes($params);
                if ($this->saveWithRelated($relatedData))
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
        $criteria->compare('ma_vach', $this->ma_vach, true);
        $criteria->compare('ten_san_pham', $this->ten_san_pham, true);
        $criteria->compare('gia_tang', $this->gia_tang);
        $criteria->compare('thoi_gian_bat_dau', $this->thoi_gian_bat_dau, true);
        $criteria->compare('thoi_gian_ket_thuc', $this->thoi_gian_ket_thuc, true);
        $criteria->compare('mo_ta', $this->mo_ta, true);

        $event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['SanPhamTang'];
        $this->onAfterExport($event);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }



}