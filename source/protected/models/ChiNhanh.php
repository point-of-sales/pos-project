<?php

Yii::import('application.models._base.BaseChiNhanh');

class ChiNhanh extends BaseChiNhanh
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}


    public function relations() {
        return array(
            'loaiChiNhanh' => array(self::BELONGS_TO, 'LoaiChiNhanh', 'loai_chi_nhanh_id'),
            'trucThuoc' => array(self::BELONGS_TO, 'ChiNhanh', 'truc_thuoc_id'),
            'chiNhanhs' => array(self::HAS_MANY, 'ChiNhanh', 'truc_thuoc_id'),
            'khuVuc' => array(self::BELONGS_TO, 'KhuVuc', 'khu_vuc_id'),
            'chungTus' => array(self::HAS_MANY, 'ChungTu', 'chi_nhanh_id'),
            'khuyenMais' => array(self::HAS_MANY, 'KhuyenMai', 'chi_nhanh_id'),
            'tblKhuyenMais' => array(self::MANY_MANY, 'KhuyenMai', 'tbl_KhuyenMaiChiNhanh(chi_nhanh_id, khuyen_mai_id)'),
            'nhanViens' => array(self::HAS_MANY, 'NhanVien', 'chi_nhanh_id'),
            'phieuNhaps' => array(self::HAS_MANY, 'PhieuNhap', 'chi_nhanh_xuat_id'),
            'phieuXuats' => array(self::HAS_MANY, 'PhieuXuat', 'chi_nhanh_nhap_id'),
            'tblSanPhams' => array(self::MANY_MANY, 'SanPham', 'tbl_SanPhamChiNhanh(chi_nhanh_id, san_pham_id)'),
            'tblSanPhamTangs' => array(self::MANY_MANY, 'SanPhamTang', 'tbl_SanPhamTangChiNhanh(chi_nhanh_id, san_pham_tang_id)'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => Yii::t('app', 'ID'),
            'ma_chi_nhanh' => Yii::t('app','Mã chi nhánh'),
            'ten_chi_nhanh' => Yii::t('app','Tên chi nhánh'),
            'dia_chi' => Yii::t('app','Địa chỉ'),
            'dien_thoai' => Yii::t('app','Điện thoại'),
            'fax' => Yii::t('app','Fax'),
            'mo_ta' => Yii::t('app','Mô tả'),
            'trang_thai' => Yii::t('app','Trạng thái'),
            'truc_thuoc_id' => Yii::t('app','Trực thuộc'),
            'khu_vuc_id' => Yii::t('app','Khu vực'),
            'loai_chi_nhanh_id' => Yii::t('app','Loại chi nhánh'),
            'loaiChiNhanh' => Yii::t('app','Loại chi nhánh'),
            'trucThuoc' => Yii::t('app','Trực thuộc'),
            'chiNhanhs' => null,
            'khuVuc' => null,
            'chungTus' => null,
            'khuyenMais' => null,
            'tblKhuyenMais' => null,
            'nhanViens' => null,
            'phieuNhaps' => null,
            'phieuXuats' => null,
            'tblSanPhams' => null,
            'tblSanPhamTangs' => null,
        );
    }

}