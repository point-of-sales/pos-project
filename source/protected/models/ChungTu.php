<?php

Yii::import('application.models._base.BaseChungTu');

class ChungTu extends BaseChungTu
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function attributeLabels() {
        return array(
            'id' => Yii::t('viLib', 'ID'),
            'ma_chung_tu' => Yii::t('viLib', 'Voucher code'),
            'ngay_lap' => Yii::t('viLib', 'Created date'),
            'tri_gia' => Yii::t('viLib', 'Worth'),
            'ghi_chu' => Yii::t('viLib', 'Notes'),
            'nhan_vien_id' => null,
            'chi_nhanh_id' => null,
            'nhanVien' => null,
            'chiNhanh' => null,
            'hoaDonBanHang' => null,
            'hoaDonTraHang' => null,
            'phieuNhap' => null,
            'phieuXuat' => null,
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
        $criteria->compare('ma_chung_tu', $this->ma_chung_tu, true);
        $criteria->compare('ngay_lap', $this->ngay_lap, true);
        $criteria->compare('tri_gia', $this->tri_gia);
        $criteria->compare('ghi_chu', $this->ghi_chu, true);
        $criteria->compare('nhan_vien_id', $this->nhan_vien_id);
        $criteria->compare('chi_nhanh_id', $this->chi_nhanh_id);

        /*$event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['ChungTu'];
        $this->onAfterExport($event);*/

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }


}