<?php

Yii::import('application.models._base.BaseNhanVien');

class NhanVien extends BaseNhanVien
{
    public function getSex()
    {
        return array('Nam', 'Nữ');
    }

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
            $relatedData = array( //'tblQuyens' => $_POST['NhanVien']['tblQuyens'] === '' ? null : $_POST['NhanVien']['tblQuyens'],
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
        // kiem tra du lieu con bi trung hay chua
        $relatedData = array( /*'tblQuyens' => $_POST['NhanVien']['tblQuyens'] === '' ? null : $_POST['NhanVien']['tblQuyens'],*/);
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

    public function getOptions($id = 1)
    {
        switch ($id) {
            case 1:
            {
                return array('Kích hoạt', 'Chưa kích hoạt');
            }
                break;
            case 2:
            {
                return array('Nam', 'Nữ');
            }
        }
    }

    public function xuatFileExcel()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('ma_nhan_vien', $this->ma_nhan_vien, true);
        $criteria->compare('ho_ten', $this->ho_ten, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('dien_thoai', $this->dien_thoai, true);
        $criteria->compare('dia_chi', $this->dia_chi, true);
        $criteria->compare('gioi_tinh', $this->gioi_tinh);
        $criteria->compare('ngay_sinh', $this->ngay_sinh, true);
        $criteria->compare('trinh_do', $this->trinh_do, true);
        $criteria->compare('luong_co_ban', $this->luong_co_ban);
        $criteria->compare('chuyen_mon', $this->chuyen_mon, true);
        $criteria->compare('trang_thai', $this->trang_thai);
        $criteria->compare('mat_khau', $this->mat_khau, true);
        $criteria->compare('ngay_vao_lam', $this->ngay_vao_lam, true);
        $criteria->compare('lan_dang_nhap_cuoi', $this->lan_dang_nhap_cuoi, true);
        $criteria->compare('loai_nhan_vien_id', $this->loai_nhan_vien_id);
        $criteria->compare('chi_nhanh_id', $this->chi_nhanh_id);

        $event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['NhanVien'];
        $this->onAfterExport($event);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }


}