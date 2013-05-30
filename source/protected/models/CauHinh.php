<?php

Yii::import('application.models._base.BaseCauHinh');

class CauHinh extends BaseCauHinh
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function rules() {
        return array(
            array('so_muc_tin_tren_trang, so_luong_ton_canh_bao, so_ngay_canh_bao_sinh_nhat_khach_hang, email_ho_tro','required'),
            array('so_muc_tin_tren_trang, so_luong_ton_canh_bao, so_ngay_canh_bao_sinh_nhat_khach_hang', 'numerical', 'integerOnly'=>true),
            array('email_ho_tro', 'length', 'max'=>100),
            array('so_muc_tin_tren_trang, so_luong_ton_canh_bao, so_ngay_canh_bao_sinh_nhat_khach_hang, email_ho_tro', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, so_muc_tin_tren_trang, so_luong_ton_canh_bao, so_ngay_canh_bao_sinh_nhat_khach_hang, email_ho_tro', 'safe', 'on'=>'search'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => Yii::t('viLib', 'ID'),
            'so_muc_tin_tren_trang' => Yii::t('viLib', 'Quantity information on page'),
            'so_luong_ton_canh_bao' => Yii::t('viLib', 'Quantity instock warning'),
            'so_ngay_canh_bao_sinh_nhat_khach_hang' => Yii::t('viLib', 'Days warning customer\'s birthday'),
            'email_ho_tro' => Yii::t('viLib', 'Support Email'),
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
        $criteria->compare('so_san_pham_tren_trang', $this->so_san_pham_tren_trang);
        $criteria->compare('so_luong_ton_canh_bao', $this->so_luong_ton_canh_bao);
        $criteria->compare('so_ngay_canh_bao_sinh_nhat_khach_hang', $this->so_ngay_canh_bao_sinh_nhat_khach_hang);
        $criteria->compare('email_ho_tro', $this->email_ho_tro, true);

        /*$event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session[''];
        $this->onAfterExport($event);*/

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }


}