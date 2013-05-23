<?php

Yii::import('application.models._base.BaseLoaiNhanVien');

class LoaiNhanVien extends BaseLoaiNhanVien
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function rules()
    {
        return array(
            array('ma_loai_nhan_vien,lop', 'required'),
            array('ma_loai_nhan_vien', 'length', 'max' => 15),
            array('ten_loai', 'length', 'max' => 100),
            array('ten_loai', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, ma_loai_nhan_vien, ten_loai,lop', 'safe', 'on' => 'search'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('viLib', 'ID'),
            'ma_loai_nhan_vien' => Yii::t('viLib', 'Emploee type code'),
            'ten_loai' => Yii::t('viLib', 'Employee type name'),
            'nhanViens' => null,
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
        $criteria->compare('ma_loai_nhan_vien', $this->ma_loai_nhan_vien, true);
        $criteria->compare('ten_loai', $this->ten_loai, true);

        /*$event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['LoaiNhanVien'];
        $this->onAfterExport($event);*/

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function layDanhSachLoaiNhanVien()
    {
        $currentUserId = Yii::app()->user->id;
        if (RightsWeight::getRoleWeight($currentUserId) == 999) {
            $danhSachLoaiNhanVien = LoaiNhanVien::model()->findAll();
            return $danhSachLoaiNhanVien;
        } else {

            $nhanVien = NhanVien::model()->findByPk($currentUserId);
            $loaiNhanVien = $nhanVien->loaiNhanVien;
            if ($loaiNhanVien->lop == 1) { // manager
                $criteria = new CDbCriteria();
                $criteria->addCondition("lop<$loaiNhanVien->lop");;
                $danhSachLoaiNhanVien = LoaiNhanVien::model()->findAll($criteria);
                return $danhSachLoaiNhanVien;
            }
        }
    }

    public static function layDanhSachLop()
    {
        return array(Yii::t('viLib', 'Normal Employee'), Yii::t('viLib', 'Manager'), Yii::t('viLib', 'Administrator'));
    }

    public function layTenLop()
    {
        $danhSachLop = LoaiNhanVien::layDanhSachLop();
        return $danhSachLop[$this->lop];
    }


}