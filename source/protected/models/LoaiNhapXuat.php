<?php

Yii::import('application.models._base.BaseLoaiNhapXuat');

class LoaiNhapXuat extends BaseLoaiNhapXuat
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

        $criteria->compare('id', $this->id);
        $criteria->compare('ma_loai_nhap_xuat', $this->ma_loai_nhap_xuat, true);
        $criteria->compare('ten_loai_nhap_xuat', $this->ten_loai_nhap_xuat, true);
        $criteria->compare('loai', $this->loai);

        /*$event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session[''];
        $this->onAfterExport($event);*/

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function layDanhSachLoaiNhapSanPhamBan(){
        $danhSachLoaiNhapSanPhamBan = array();
        $danhSach = LoaiNhapXuat::model()->findAllByAttributes(array("loai"=>0));

        foreach($danhSach as $loaiNhap) {
            $danhSachLoaiNhapSanPhamBan[$loaiNhap->id] = $loaiNhap->ten_loai_nhap_xuat;
        }


        return $danhSachLoaiNhapSanPhamBan;
    }

    public static function layDanhSachLoaiNhapSanPhamTang(){
        $danhSachLoaiNhapSanPhamTang = array();
        $danhSach = LoaiNhapXuat::model()->findAllByAttributes(array("loai"=>1));
        foreach($danhSach as $loaiNhap) {
            $danhSachLoaiNhapSanPhamTang[$loaiNhap->id] = $loaiNhap->ten_loai_nhap_xuat;
        }
        return $danhSachLoaiNhapSanPhamTang;
    }

    public static function layDanhSachLoaiXuatSanPhamBan(){
        $danhSachLoaiXuatSanPhamBan = array();
        $danhSach = LoaiNhapXuat::model()->findAllByAttributes(array("loai"=>2));
        foreach($danhSach as $loaiNhap) {
            $danhSachLoaiXuatSanPhamBan[$loaiNhap->id] = $loaiNhap->ten_loai_nhap_xuat;
        }
        return $danhSachLoaiXuatSanPhamBan;
    }

    public static function layDanhSachLoaiXuatSanPhamTang(){
        $danhSachLoaiXuatSanPhamTang = array();
        $danhSach = LoaiNhapXuat::model()->findAllByAttributes(array("loai"=>3));
        foreach($danhSach as $loaiNhap) {
            $danhSachLoaiXuatSanPhamTang[$loaiNhap->id] = $loaiNhap->ten_loai_nhap_xuat;
        }
        return $danhSachLoaiXuatSanPhamTang;
    }

    // bao gom ban va hang tang
    public static function layDanhSachLoaiNhap() {
        $danhSachLoaiNhapSanPhamBan = LoaiNhapXuat::layDanhSachLoaiNhapSanPhamBan();
        $danhSachLoaiNhapSanPhamTang = LoaiNhapXuat::layDanhSachLoaiNhapSanPhamTang();
        return $danhSachLoaiNhapSanPhamBan + $danhSachLoaiNhapSanPhamTang;
    }

    public static function layDanhSachLoaiXuat() {
        $danhSachLoaiXuatSanPhamBan = LoaiNhapXuat::layDanhSachLoaiXuatSanPhamBan();
        $danhSachLoaiXuatSanPhamTang = LoaiNhapXuat::layDanhSachLoaiXuatSanPhamTang();
        return $danhSachLoaiXuatSanPhamBan + $danhSachLoaiXuatSanPhamTang;
    }




}