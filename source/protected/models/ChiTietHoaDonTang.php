<?php

Yii::import('application.models._base.BaseChiTietHoaDonTang');

class ChiTietHoaDonTang extends BaseChiTietHoaDonTang
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
    
    public function relations()
    {
        return array(
            'sanPhamTang' => array(self::BELONGS_TO, 'SanPhamTang', 'san_pham_tang_id'),
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

        $criteria->compare('san_pham_tang_id', $this->san_pham_tang_id);
        $criteria->compare('hoa_don_ban_id', $this->hoa_don_ban_id);
        $criteria->compare('so_luong', $this->so_luong);

        /*$event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session[''];
        $this->onAfterExport($event);*/

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }


}