<?php

Yii::import('application.models._base.BaseChiNhanh');

class ChiNhanh extends BaseChiNhanh
{
    public $ma_chi_nhanh;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        if ($n <= 1) {
            return Yii::t('viLib', 'Branch');
        } else {
            return Yii::t('viLib', 'Branchs');
        }
    }

    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('viLib', 'ID'),
            'ma_chi_nhanh' => Yii::t('viLib', 'Branch Id'),
            'ten_chi_nhanh' => Yii::t('viLib', 'Branch name'),
            'dia_chi' => Yii::t('viLib', 'Address'),
            'dien_thoai' => Yii::t('viLib', 'Phone'),
            'fax' => Yii::t('viLib', 'Fax'),
            'mo_ta' => Yii::t('viLib', 'Description'),
            'trang_thai' => Yii::t('viLib', 'Status'),
            'truc_thuoc_id' => Yii::t('viLib', 'Under'),
            'khu_vuc_id' => Yii::t('viLib', 'Area'),
            'loai_chi_nhanh_id' => Yii::t('viLib', 'Branch Type'),
            'trucThuoc' => null,
            'chiNhanhs' => null,
            'khuVuc' => null,
            'loaiChiNhanh' => Yii::t('viLib', 'Branch Type'),
            'chungTus' => null,
            'khuyenMais' => null,
            'tblKhuyenMais' => null,
            'mocGias' => null,
            'nhanViens' => null,
            'phieuNhaps' => null,
            'phieuXuats' => null,
            'tblSanPhams' => null,
            'tblSanPhamTangs' => null,
        );
    }

    public function them($params)
    {
        // kiem tra du lieu con bi trung hay chua

        if (!$this->kiemTraTonTai($params)) {
            //neu khoa chua ton tai
            $this->setAttributes($params);
            $relatedData = array(//'tblKhuyenMais' => $_POST['ChiNhanh']['tblKhuyenMais'] === '' ? null : $_POST['ChiNhanh']['tblKhuyenMais'],
                //'tblSanPhams' => $_POST['ChiNhanh']['tblSanPhams'] === '' ? null : $_POST['ChiNhanh']['tblSanPhams'],
                //'tblSanPhamTangs' => $_POST['ChiNhanh']['tblSanPhamTangs'] === '' ? null : $_POST['ChiNhanh']['tblSanPhamTangs'],
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
        $relatedData = array(//'tblKhuyenMais' => $_POST['ChiNhanh']['tblKhuyenMais'] === '' ? null : $_POST['ChiNhanh']['tblKhuyenMais'],
            //'tblSanPhams' => $_POST['ChiNhanh']['tblSanPhams'] === '' ? null : $_POST['ChiNhanh']['tblSanPhams'],
            //'tblSanPhamTangs' => $_POST['ChiNhanh']['tblSanPhamTangs'] === '' ? null : $_POST['ChiNhanh']['tblSanPhamTangs'],
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

    public function layDanhSachTrangThai()
    {
        return array('Chưa kích hoạt', 'Kích hoạt');
    }


    public function layDanhSachTrucThuoc()
    {
        $chiNhanhs = Yii::app()->db->createCommand()
            ->select('id, ten_chi_nhanh')
            ->from('tbl_ChiNhanh')
            ->queryAll();
        $danhSachChiNhanh[''] = 'Không trực thuộc';
        foreach ($chiNhanhs as $chiNhanh) {
            if ($chiNhanh['ten_chi_nhanh'] != $this->ten_chi_nhanh) {
                $danhSachChiNhanh[$chiNhanh['id']] = $chiNhanh['ten_chi_nhanh'];
            }
        }
        return $danhSachChiNhanh;
    }

    public function layDanhSachKhuVuc()
    {
        $khuVucs = Yii::app()->db->createCommand()
            ->select('id, ten_khu_vuc')
            ->from('tbl_KhuVuc')
            ->queryAll();
        foreach ($khuVucs as $khuVuc) {
            $danhSachKhuVuc[$khuVuc['id']] = $khuVuc['ten_khu_vuc'];
        }
        return $danhSachKhuVuc;
    }

    public function layDanhSachLoaiChiNhanh()
    {
        $loais = Yii::app()->db->createCommand()
            ->select('id, ten_loai_chi_nhanh')
            ->from('tbl_LoaiChiNhanh')
            ->queryAll();
        foreach ($loais as $loai) {
            $danhSachLoai[$loai['id']] = $loai['ten_loai_chi_nhanh'];
        }
        return $danhSachLoai;

    }

    public function layTenTrangThai()
    {
        $statusOptions = $this->layDanhSachTrangThai();
        return $statusOptions[$this->trang_thai];

    }

    public function layTenTrucThuoc()
    {
        $underOptions = $this->layDanhSachTrucThuoc();
        if ($this->truc_thuoc_id != '')
            return $underOptions[$this->truc_thuoc_id];
        else
            return 'Không trực thuộc';
    }

    public function layTenLoaiChiNhanh()
    {
        $typeOptions = $this->layDanhSachLoaiChiNhanh();
        return $typeOptions[$this->loai_chi_nhanh_id];
    }

    public function layTenKhuVuc()
    {
        $areaOptions = $this->layDanhSachKhuVuc();
        return $areaOptions[$this->khu_vuc_id];
    }

    public function coChiNhanhCon()
    {

        return ChiNhanh::model()->exists('truc_thuoc_id=:truc_thuoc_id', array(':truc_thuoc_id' => $this->id));
    }

    public function xuatFileExcel() {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('ma_chi_nhanh', $this->ma_chi_nhanh, true);
        $criteria->compare('ten_chi_nhanh', $this->ten_chi_nhanh, true);
        $criteria->compare('dia_chi', $this->dia_chi, true);
        $criteria->compare('dien_thoai', $this->dien_thoai, true);
        $criteria->compare('fax', $this->fax, true);
        $criteria->compare('mo_ta', $this->mo_ta, true);
        $criteria->compare('trang_thai', $this->trang_thai);
        $criteria->compare('truc_thuoc_id', $this->truc_thuoc_id);
        $criteria->compare('khu_vuc_id', $this->khu_vuc_id);
        $criteria->compare('loai_chi_nhanh_id', $this->loai_chi_nhanh_id);

        $event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['ChiNhanh'];
        $this->onAfterExport($event);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }


}