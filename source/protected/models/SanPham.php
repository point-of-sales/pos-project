<?php

Yii::import('application.models._base.BaseSanPham');

class SanPham extends BaseSanPham
{
    public $chi_nhanh_id;
    public $danhSachMocGia;
    public $ton_dau_ky = 0;
    public $so_luong_nhap = 0;
    public $so_luong_xuat = 0;
    public $so_luong_ban = 0;
    public $so_luong_tra = 0;
    public $so_luong_thuc_ton = 0;
    public $doanh_so = array();

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function rules()
    {
        return array(
            array('ma_vach, ten_san_pham, han_dung ,nha_cung_cap_id, loai_san_pham_id,trang_thai,ton_toi_thieu,gia_goc', 'required'),
            array('han_dung, ton_toi_thieu, trang_thai, nha_cung_cap_id, loai_san_pham_id', 'numerical', 'integerOnly' => true),
            array('ma_vach', 'length', 'max' => 15),
            array('ten_san_pham, ten_tieng_viet', 'length', 'max' => 100),
            array('don_vi_tinh', 'length', 'max' => 50),
            array('huong_dan_su_dung, mo_ta', 'safe'),
            array('ten_san_pham, ten_tieng_viet, han_dung, don_vi_tinh, ton_toi_thieu, huong_dan_su_dung, mo_ta, trang_thai', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, ma_vach, ten_san_pham, ten_tieng_viet, han_dung, don_vi_tinh, ton_toi_thieu, huong_dan_su_dung, mo_ta, trang_thai, nha_cung_cap_id, loai_san_pham_id,ma_chi_nhanh', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'tblHoaDonBanHangs' => array(self::MANY_MANY, 'HoaDonBanHang', 'tbl_ChiTietHoaDonBan(san_pham_id, hoa_don_ban_id)'),
            'tblHoaDonTraHangs' => array(self::MANY_MANY, 'HoaDonTraHang', 'tbl_ChiTietHoaDonTra(san_pham_id, hoa_don_tra_id)'),
            'tblPhieuNhaps' => array(self::MANY_MANY, 'PhieuNhap', 'tbl_ChiTietPhieuNhap(san_pham_id, phieu_nhap_id)'),
            'tblPhieuXuats' => array(self::MANY_MANY, 'PhieuXuat', 'tbl_ChiTietPhieuXuat(san_pham_id, phieu_xuat_id)'),
            'nhaCungCap' => array(self::BELONGS_TO, 'NhaCungCap', 'nha_cung_cap_id'),
            'loaiSanPham' => array(self::BELONGS_TO, 'LoaiSanPham', 'loai_san_pham_id'),
            'tblChiNhanhs' => array(self::MANY_MANY, 'ChiNhanh', 'tbl_SanPhamChiNhanh(san_pham_id, chi_nhanh_id)'),
            'mocGias' => array(self::HAS_MANY, 'MocGia', 'san_pham_id'),
            'khuyenMai' => array(self::BELONGS_TO, 'KhuyenMai', 'khuyen_mai_id'),
            'sanPhamChiNhanh' => array(self::HAS_MANY, 'SanPhamChiNhanh', 'san_pham_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('viLib', 'ID'),
            'ma_vach' => Yii::t('viLib', 'Barcode'),
            'ten_san_pham' => Yii::t('viLib', 'Product name'),
            'ten_tieng_viet' => Yii::t('viLib', 'Vietnamese name'),
            'han_dung' => Yii::t('viLib', 'Expiration'),
            'don_vi_tinh' => Yii::t('viLib', 'Unit'),
            'ton_toi_thieu' => Yii::t('viLib', 'Store limit'),
            'huong_dan_su_dung' => Yii::t('viLib', 'Manual'),
            'mo_ta' => Yii::t('viLib', 'Description'),
            'trang_thai' => Yii::t('viLib', 'Status'),
            'gia_goc' => Yii::t('viLib', 'Base price'),
            'nha_cung_cap_id' => null,
            'loai_san_pham_id' => null,
            'tblHoaDonBanHangs' => null,
            'tblHoaDonTraHangs' => null,
            'tblPhieuNhaps' => null,
            'tblPhieuXuats' => null,
            'nhaCungCap' => null,
            'loaiSanPham' => null,
            'tblChiNhanhs' => null,
        );
    }

    public function them($params)
    {
        // kiem tra du lieu con bi trung hay chua

        if (!$this->kiemTraTonTai($params)) {
            //neu khoa chua ton tai
            $this->setAttributes($params);
            $relatedData = array( /*'tblHoaDonBanHangs' => $_POST['SanPham']['tblHoaDonBanHangs'] === '' ? null : $_POST['SanPham']['tblHoaDonBanHangs'],
				'tblHoaDonTraHangs' => $_POST['SanPham']['tblHoaDonTraHangs'] === '' ? null : $_POST['SanPham']['tblHoaDonTraHangs'],
				'tblPhieuNhaps' => $_POST['SanPham']['tblPhieuNhaps'] === '' ? null : $_POST['SanPham']['tblPhieuNhaps'],
				'tblPhieuXuats' => $_POST['SanPham']['tblPhieuXuats'] === '' ? null : $_POST['SanPham']['tblPhieuXuats'],
				'tblChiNhanhs' => $_POST['SanPham']['tblChiNhanhs'] === '' ? null : $_POST['SanPham']['tblChiNhanhs'],*/
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
        $uniqueKeyLabel = $this->timKhoaUnique($this->getAttributes());
        // lay ma_ cu

        $relatedData = array( /*'tblHoaDonBanHangs' => $_POST['SanPham']['tblHoaDonBanHangs'] === '' ? null : $_POST['SanPham']['tblHoaDonBanHangs'],
				'tblHoaDonTraHangs' => $_POST['SanPham']['tblHoaDonTraHangs'] === '' ? null : $_POST['SanPham']['tblHoaDonTraHangs'],
				'tblPhieuNhaps' => $_POST['SanPham']['tblPhieuNhaps'] === '' ? null : $_POST['SanPham']['tblPhieuNhaps'],
				'tblPhieuXuats' => $_POST['SanPham']['tblPhieuXuats'] === '' ? null : $_POST['SanPham']['tblPhieuXuats'],
				'tblChiNhanhs' => $_POST['SanPham']['tblChiNhanhs'] === '' ? null : $_POST['SanPham']['tblChiNhanhs'],*/
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

    public function layDanhSachTrangThaiKhuyenMai()
    {
        return array('Chưa khuyến mãi', 'Khuyến mãi');
    }

    /*
     * custom search method to return result of searching with related data
     */

    public function search()
    {

        $criteria = new CDbCriteria;
        $cauHinh = CauHinh::model()->findByPk(1);

        $criteria->compare('ma_vach', $this->ma_vach, true);
        $criteria->compare('ten_san_pham', $this->ten_san_pham, true);
        $criteria->compare('ten_tieng_viet', $this->ten_tieng_viet, true);
        $criteria->compare('t.trang_thai', $this->trang_thai);
        $criteria->compare('nha_cung_cap_id', $this->nha_cung_cap_id);
        $criteria->compare('loai_san_pham_id', $this->loai_san_pham_id);

        if (!empty($this->chi_nhanh_id)) {
            //search with related data
            // connect SanPham Model with it own relations
            $criteria->with = 'tblChiNhanhs';
            $criteria->together = true;
            $criteria->compare('tblChiNhanhs.id', $this->chi_nhanh_id, true);
        }
        $numberRecords = $cauHinh->so_muc_tin_tren_trang;

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>$numberRecords,
            ),
        ));
    }

    /*
     * Lay danh sach cac moc gia cua san pham
     */
    public function layDanhSachMocGia()
    {
        $criteria = new CDbCriteria();
        $cauHinh = CauHinh::model()->findByPk(1);
        $criteria->compare('san_pham_id', $this->id);
        $criteria->order = 'thoi_gian_bat_dau ASC';
        $numberRecords = $cauHinh->so_muc_tin_tren_trang;

        $this->danhSachMocGia = new CActiveDataProvider('MocGia',
            array('criteria' => $criteria,
                  'pagination'=>array(
                    'pageSize'=>$numberRecords,
                  ),
            ));
        return $this->danhSachMocGia;

    }

    /*
     * Lay moc gia cua san pham.
     * Neu Thoi gian bat dau <= Now < Thoi gian ket thuc.
     *      return CActiveRecord MocGia
     * Neu Now < Thoi_gian_ket_thuc
     *      return NULL (san pham chua co Moc gia)
     */
    public function layMocGiaHienTai()
    {
        $hien_tai = time();
        $i = 0;
        if ($this->danhSachMocGia == null)
            $this->layDanhSachMocGia();
        $danhSachMocGia = $this->danhSachMocGia->getData();

        if (count($danhSachMocGia) == 0) // san pham chua co set moc gia
        return null;
        $thoiGianBatDau = strtotime($danhSachMocGia[0]->getAttribute('thoi_gian_bat_dau'));

        if ($thoiGianBatDau > $hien_tai)
            return 'no-price'; // san pham chua co gia trong thoi diem hien tai

        if (count($danhSachMocGia) == 1 && $thoiGianBatDau <= $hien_tai)
            return $danhSachMocGia[0];

        foreach ($danhSachMocGia as $mocGia) {
            $thoiGianBatDau = strtotime($mocGia->getAttribute('thoi_gian_bat_dau'));
            if ($thoiGianBatDau <= $hien_tai)
                $i++;
            else
                return $danhSachMocGia[$i - 1];
        }
        return $danhSachMocGia[$i - 1];
    }

    public function layGiaHienTai()
    {
        $mocGiaHienTai = $this->layMocGiaHienTai();

        if ($mocGiaHienTai == null)
            return Yii::t('viLib', 'No price level set');
        if ($mocGiaHienTai == 'no-price')
            return Yii::t('viLib', 'No price at this time');
        if ($mocGiaHienTai instanceof CActiveRecord)
            return $mocGiaHienTai->getAttribute('gia_ban');
    }


    public function layDanhSachChiNhanh()
    {
        $chiNhanh = new ChiNhanh();
        $chiNhanh->san_pham_id = $this->id;
        $dataProvider = $chiNhanh->search();
        $danhSachChiNhanh = $dataProvider->getData();
        foreach ($danhSachChiNhanh as $chiNhanhCon)
            $chiNhanhCon->san_pham_id = $this->id;
        return $dataProvider;
    }

    public function layTongSoLuongTon()
    {
        return Yii::app()->db->createCommand()
            ->select('sum(so_ton)')
            ->from('tbl_SanPhamChiNhanh')
            ->where('san_pham_id=:san_pham_id', array(':san_pham_id' => $this->id))
            ->queryScalar();
    }


    public function xuatFileExcel()
    {

        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('ma_vach', $this->ma_vach, true);
        $criteria->compare('ten_san_pham', $this->ten_san_pham, true);
        $criteria->compare('ten_tieng_viet', $this->ten_tieng_viet, true);
        $criteria->compare('t.trang_thai', $this->trang_thai);
        $criteria->compare('nha_cung_cap_id', $this->nha_cung_cap_id);
        $criteria->compare('loai_san_pham_id', $this->loai_san_pham_id);
        if (!empty($this->chi_nhanh_id)) {
            //search with related data
            // connect SanPham Model with it own relations
            $criteria->with = 'tblChiNhanhs';
            $criteria->together = true;
            $criteria->compare('tblChiNhanhs.id', $this->chi_nhanh_id, true);
        }

        /*$event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['SanPham'];
        $this->onAfterExport($event);*/

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }


    public function laySoLuongTonHienTai()
    {
        return Yii::app()->db->createCommand()
            ->select("so_ton")
            ->from('tbl_SanPhamChiNhanh')
            ->where('san_pham_id=:san_pham_id AND chi_nhanh_id=:chi_nhanh_id', array(':san_pham_id' => $this->id, ':chi_nhanh_id' => $this->chi_nhanh_id))
            ->queryScalar();
    }


    public function layGiaHienTaiKemKhuyenMai()
    {

        $giaHienTai = $this->layGiaHienTai();
        if ($this->khuyen_mai_id != '') {
            $khuyenMai = $this->khuyenMai->gia_giam;
            return round($giaHienTai - ($giaHienTai * ($khuyenMai / 100)));
        }
        return $giaHienTai;

    }

    public function tinhNhapXuatTon($thoi_gian_bat_dau, $thoi_gian_ket_thuc)
    {
        $criteria = new CDbCriteria();
        $criteria->with = 'chungTu';
        $criteria->together = true;
        $criteria->addBetweenCondition('chungTu.ngay_lap', date('Y-m-d', strtotime($thoi_gian_bat_dau)), date('Y-m-d', strtotime($thoi_gian_ket_thuc)));
        $criteria->compare('chungTu.chi_nhanh_id', $this->chi_nhanh_id);
        $danhSachPhieuNhapTrongKy = PhieuNhap::model()->findAll($criteria);
        $danhSachPhieuXuatTrongKy = PhieuXuat::model()->findAll($criteria);
        $danhSachHoaDonBan = HoaDonBanHang::model()->findAll($criteria);
        $danhSachHoaDonTra = HoaDonTraHang::model()->findAll($criteria);

        $criteria2 = new CDbCriteria();
        $criteria2->with = 'chungTu';
        $criteria2->together = true;
        $criteria2->compare('chungTu.chi_nhanh_id', $this->chi_nhanh_id);
        $criteria2->addCondition('chungTu.ngay_lap' . '<' . "'" . date('Y-m-d', strtotime($thoi_gian_bat_dau)) . "'");
        $danhSachPhieuNhapDauKy = PhieuNhap::model()->findAll($criteria2);

        foreach ($danhSachPhieuNhapDauKy as $phieuNhapDauKy) {
            $so_luong_nhap_dau_ky = Yii::app()->db->createCommand()
                ->select('so_luong')
                ->from('tbl_ChiTietPhieuNhap')
                ->where('phieu_nhap_id=:phieu_nhap_id AND san_pham_id=:san_pham_id', array(':phieu_nhap_id' => $phieuNhapDauKy->id, ':san_pham_id' => $this->id))
                ->queryScalar();
            $this->ton_dau_ky = $this->ton_dau_ky + $so_luong_nhap_dau_ky;
        }
        foreach ($danhSachPhieuNhapTrongKy as $phieuNhap) {
            $so_luong_nhap = Yii::app()->db->createCommand()
                ->select('so_luong')
                ->from('tbl_ChiTietPhieuNhap')
                ->where('phieu_nhap_id=:phieu_nhap_id AND san_pham_id=:san_pham_id', array(':phieu_nhap_id' => $phieuNhap->id, ':san_pham_id' => $this->id))
                ->queryScalar();
            $this->so_luong_nhap = $this->so_luong_nhap + $so_luong_nhap;
        }
        foreach ($danhSachPhieuXuatTrongKy as $phieuXuat) {
            $so_luong_xuat = Yii::app()->db->createCommand()
                ->select('so_luong')
                ->from('tbl_ChiTietPhieuXuat')
                ->where('phieu_xuat_id=:phieu_xuat_id AND san_pham_id=:san_pham_id', array(':phieu_xuat_id' => $phieuXuat->id, ':san_pham_id' => $this->id))
                ->queryScalar();
            $this->so_luong_xuat = $this->so_luong_xuat + $so_luong_xuat;
        }
        foreach ($danhSachHoaDonBan as $hoaDonBan) {
            $so_luong_ban = Yii::app()->db->createCommand()
                ->select('so_luong')
                ->from('tbl_ChiTietHoaDonBan')
                ->where('hoa_don_ban_id=:hoa_don_ban_id AND san_pham_id=:san_pham_id', array(':hoa_don_ban_id' => $hoaDonBan->id, ':san_pham_id' => $this->id))
                ->queryScalar();
            $this->so_luong_ban = $this->so_luong_ban + $so_luong_ban;

        }

        foreach ($danhSachHoaDonTra as $hoaDonTra) {
            $so_luong_tra = Yii::app()->db->createCommand()
                ->select('so_luong')
                ->from('tbl_ChiTietHoaDonTra')
                ->where('hoa_don_tra_id=:hoa_don_tra_id AND san_pham_id=:san_pham_id', array(':hoa_don_tra_id' => $hoaDonTra->id, ':san_pham_id' => $this->id))
                ->queryScalar();
            $this->so_luong_tra = $this->so_luong_tra + $so_luong_tra;

        }

        $this->so_luong_thuc_ton = ($this->ton_dau_ky + $this->so_luong_nhap) - ($this->so_luong_ban + $this->so_luong_xuat) + $this->so_luong_tra;

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
            $criteria->compare('chungTu.chi_nhanh_id', $this->chi_nhanh_id);
            $danhSachHoaDonTrongMoc = HoaDonBanHang::model()->findAll($criteria);
            $tri_gia = 0;
            foreach ($danhSachHoaDonTrongMoc as $hoaDonBan) {
                $sanPhamRow = Yii::app()->db->createCommand()
                    ->select('so_luong,don_gia')
                    ->from('tbl_ChiTietHoaDonBan')
                    ->where('hoa_don_ban_id=:hoa_don_ban_id AND san_pham_id=:san_pham_id', array(':hoa_don_ban_id' => $hoaDonBan->id, ':san_pham_id' => $this->id))
                    ->queryRow();
                $tri_gia = $tri_gia + ($sanPhamRow['so_luong'] * $sanPhamRow['don_gia']);
            }
            $this->doanh_so[] = array($thoi_gian_ket_thuc_moc, $tri_gia);
            $thoi_gian_bat_dau = $thoi_gian_ket_thuc_moc;
        } while (strtotime($thoi_gian_ket_thuc_moc) < strtotime($thoi_gian_ket_thuc));
    }

    public function tinhDoanhSoSanPhamTheoKhoangThoiGianTrenCacChiNhanh($thoi_gian_bat_dau, $thoi_gian_ket_thuc)
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
            $danhSachHoaDonTrongMoc = HoaDonBanHang::model()->findAll($criteria);
            $tri_gia = 0;
            foreach ($danhSachHoaDonTrongMoc as $hoaDonBan) {
                $sanPhamRow = Yii::app()->db->createCommand()
                    ->select('so_luong,don_gia')
                    ->from('tbl_ChiTietHoaDonBan')
                    ->where('hoa_don_ban_id=:hoa_don_ban_id AND san_pham_id=:san_pham_id', array(':hoa_don_ban_id' => $hoaDonBan->id, ':san_pham_id' => $this->id))
                    ->queryRow();
                $tri_gia = $tri_gia + ($sanPhamRow['so_luong'] * $sanPhamRow['don_gia']);
            }
            $this->doanh_so[] = array($thoi_gian_ket_thuc_moc, $tri_gia);
            $thoi_gian_bat_dau = $thoi_gian_ket_thuc_moc;
        } while (strtotime($thoi_gian_ket_thuc_moc) < strtotime($thoi_gian_ket_thuc));
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

    // thoi gian cac moc cua doanh so
    public function layDanhSachThoiGian()
    {
        $doanhSo = $this->doanh_so;
        $danhSachThoiGian = array();
        foreach ($doanhSo as $tg) {
            $danhSachThoiGian[] = $tg[0];
        }
        return $danhSachThoiGian;
    }

    public static function layDanhSachDoanhSoTongCacSanPham($danhSachSanPham)
    {
        $danhSachDoanhSoTong = array();
        foreach ($danhSachSanPham as $sp) {
            $danhSachDoanhSoTong[] = array_sum($sp->layDanhSachDoanhSo());
        }
        return $danhSachDoanhSoTong;
    }

    // ap dung cho CActiveDataProvider
    public static function layDanhSachThoiGianCacSanPham($danhSachSanPham)
    {
        $sp = $danhSachSanPham[0];
        return $sp->layDanhSachThoiGian();
    }

    public static function layDanhSachTenSanPham($danhSachSanPham)
    {
        $danhSachTen = array();
        foreach ($danhSachSanPham as $sp) {
            $danhSachTen[] = $sp->ten_san_pham;
        }
        return $danhSachTen;
    }

}