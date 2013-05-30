<?php

Yii::import('application.models._base.BaseChiNhanh');

class ChiNhanh extends BaseChiNhanh

{
    public $san_pham_id;
    public $doanh_so = array();

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
            $relatedData = array( //'tblKhuyenMais' => $_POST['ChiNhanh']['tblKhuyenMais'] === '' ? null : $_POST['ChiNhanh']['tblKhuyenMais'],
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
        $relatedData = array( //'tblKhuyenMais' => $_POST['ChiNhanh']['tblKhuyenMais'] === '' ? null : $_POST['ChiNhanh']['tblKhuyenMais'],
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


    public function layDanhSachTrucThuoc()
    {
        $danhSachChiNhanhModel = ChiNhanh::model()->findAll();
        $danhSachChiNhanh[''] = 'Không trực thuộc';
        foreach ($danhSachChiNhanhModel as $chiNhanh) {
            if ($chiNhanh->ten_chi_nhanh != $this->ten_chi_nhanh) {
                $danhSachChiNhanh[$chiNhanh->id] = $chiNhanh->ten_chi_nhanh;
            }
        }
        return $danhSachChiNhanh;
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
        $danhSachLoaiChiNhanh = LoaiChiNhanh::layDanhSachLoaiChiNhanh();

        return $danhSachLoaiChiNhanh[$this->loai_chi_nhanh_id];
    }

    public function layTenKhuVuc()
    {
        $areaOptions = KhuVuc::layDanhSachKhuVuc();
        return $areaOptions[$this->khu_vuc_id];
    }

    public function coChiNhanhCon()
    {

        return ChiNhanh::model()->exists('truc_thuoc_id=:truc_thuoc_id', array(':truc_thuoc_id' => $this->id));
    }


    /*
     * dem so luong ton cua 1 san pham cua tai chi nhanh
     * Su dung CDbCommand cho ket qua query nhanh.
     */

    public function laySoLuongTonSanPham()
    {
        $soLuongTon = $command = Yii::app()->db->createCommand()
            ->select('so_ton')
            ->from('tbl_ChiNhanh,tbl_SanPhamChiNhanh')
            ->where('tbl_ChiNhanh.id=tbl_SanPhamChiNhanh.chi_nhanh_id')
            ->andWhere('tbl_ChiNhanh.id=:id', array(':id' => $this->id))
            ->andWhere('tbl_SanPhamChiNhanh.san_pham_id=:san_pham_id', array(':san_pham_id' => $this->san_pham_id))
            ->queryScalar();
        return ($soLuongTon == '') ? 0 : $soLuongTon;
    }

    /*
     * Kiem tra chi nhanh co khuyen mai hay khong
     */


    public function search()
    {
        $criteria = new CDbCriteria;
        $cauHinh = CauHinh::model()->findByPk(1);

        $criteria->compare('ma_chi_nhanh', $this->ma_chi_nhanh, true);
        $criteria->compare('ten_chi_nhanh', $this->ten_chi_nhanh, true);

        $criteria->compare('trang_thai', $this->trang_thai);
        $criteria->compare('truc_thuoc_id', $this->truc_thuoc_id);
        $criteria->compare('khu_vuc_id', $this->khu_vuc_id);

        if (!empty($this->san_pham_id)) {
            $criteria->with = 'tblSanPhams';
            $criteria->together = true;
            $criteria->compare('tblSanPhams.id', $this->san_pham_id, true);
        }
        $numberRecords = $cauHinh->so_muc_tin_tren_trang;

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>$numberRecords,
            ),
        ));
    }

    public function searchChiNhanhKichHoat()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('ma_chi_nhanh', $this->ma_chi_nhanh, true);
        $criteria->compare('ten_chi_nhanh', $this->ten_chi_nhanh, true);

        $criteria->compare('trang_thai', 1);
        $criteria->compare('truc_thuoc_id', $this->truc_thuoc_id);
        $criteria->compare('khu_vuc_id', $this->khu_vuc_id);
        $criteria->addCondition('id>1');

        if (!empty($this->san_pham_id)) {
            $criteria->with = 'tblSanPhams';
            $criteria->together = true;
            $criteria->compare('tblSanPhams.id', $this->san_pham_id, true);
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function xuatFileExcel()
    {
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
        $criteria->addCondition('id>1');
        /*$event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->CPOSSessionManager->getItem('ChiNhanh');
        $this->onAfterExport($event);*/

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function layDanhSachChiNhanhKichHoat()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('trang_thai=1');
        $criteria->order = 'id DESC';
        return ChiNhanh::model()->findAll($criteria);
    }

    public function layTenTrangThaiSanPhamOChiNhanh()
    {
        $danhSachTrangThaiSanPhamOChiNhanh = $this->layDanhSachTrangThai();
        $index = Yii::app()->db->createCommand()
            ->select('trang_thai')
            ->from('tbl_SanPhamChiNhanh')
            ->where('san_pham_id=:san_pham_id AND chi_nhanh_id=:chi_nhanh_id', array(':san_pham_id' => $this->san_pham_id, ':chi_nhanh_id' => $this->id))
            ->queryScalar();
        return $danhSachTrangThaiSanPhamOChiNhanh[$index];

    }


    public static function layDanhSachChiNhanhKichHoatTrongHeThong()
    {
        $currentUserId = Yii::app()->user->id;
        if (RightsWeight::getRoleWeight($currentUserId) == 999) {
            $criteria = new CDbCriteria();
            $criteria->addCondition('trang_thai=1');
            $criteria->addCondition('id>1');
            return ChiNhanh::model()->findAll($criteria);
        } else {
            $nhanVien = NhanVien::model()->findByPk($currentUserId);
            $chiNhanhId = $nhanVien->chiNhanh->id;
            $criteria = new CDbCriteria();
            $criteria->addCondition('trang_thai=1');
            $criteria->addCondition("id=$chiNhanhId");

            return ChiNhanh::model()->findAll($criteria);
        }
    }


    public function tinhDoanhSoTheoKhoangThoiGian($thoi_gian_bat_dau, $thoi_gian_ket_thuc)
    {
        $this->doanh_so[] = array($thoi_gian_bat_dau, 0); // first init

        do {
            $thoi_gian_ket_thuc_moc = date('d-m-Y', strtotime('last day of this month', strtotime($thoi_gian_bat_dau)) + 24 * 60 * 60);
            if (strtotime($thoi_gian_ket_thuc_moc) > strtotime($thoi_gian_ket_thuc))
                $thoi_gian_ket_thuc_moc = $thoi_gian_ket_thuc;

            $criteria = new CDbCriteria();
            $criteria->with = 'chungTu';
            $criteria->together = true;
            $criteria->addBetweenCondition('chungTu.ngay_lap', date('Y-m-d', strtotime($thoi_gian_bat_dau)), date('Y-m-d', strtotime($thoi_gian_ket_thuc_moc)));
            $criteria->compare('chungTu.chi_nhanh_id', $this->id);
            $danhSachHoaDonTrongMoc = HoaDonBanHang::model()->findAll($criteria);
            $tri_gia = 0;
            foreach ($danhSachHoaDonTrongMoc as $hoaDon)
                $tri_gia = $tri_gia + $hoaDon->getBaseModel()->tri_gia;

            $this->doanh_so[] = array($thoi_gian_ket_thuc_moc, $tri_gia);
            $thoi_gian_bat_dau = $thoi_gian_ket_thuc_moc;
        } while (strtotime($thoi_gian_ket_thuc_moc) < strtotime($thoi_gian_ket_thuc));
    }

    public function tinhTongDoanhSo()
    {
        $tongDoanhSo = 0;
        if (!empty($this->doanh_so)) {
            foreach ($this->doanh_so as $ds)
                $tongDoanhSo = $tongDoanhSo + $ds[1];
        }
        return $tongDoanhSo;
    }

    public function layDanhSachDoanhSo()
    {
        $doanhSo = $this->doanh_so;
        $danhSachDoanhSo = array();
        foreach ($doanhSo as $ds) {
            $danhSachDoanhSo[] = $ds[1];
        }
        return $danhSachDoanhSo;
    }

    public function layDanhSachThoiGianDoanhSo()
    {
        $doanhSo = $this->doanh_so;
        $danhSachThoiGianDoanhSo = array();
        foreach ($doanhSo as $ds) {
            $danhSachThoiGianDoanhSo[] = $ds[0];
        }
        return $danhSachThoiGianDoanhSo;
    }

    public static function layDanhSachDoanhSoCacChiNhanh($danhSachChiNhanh)
    {
        foreach ($danhSachChiNhanh as $chiNhanh)
            $danhSachDoanhSo[] = $chiNhanh->tinhTongDoanhSo();
        return $danhSachDoanhSo;
    }

    public static function layDanhSachThoiGianCacChiNhanh($danhSachChiNhanh)
    {
        $chiNhanh = $danhSachChiNhanh[0];
        foreach ($chiNhanh->doanh_so as $ds)
            $danhSachThoiGian[] = $ds[0];
        return $danhSachThoiGian;
    }

}