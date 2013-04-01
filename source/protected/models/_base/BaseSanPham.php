<?php

/**
 * This is the model base class for the table "tbl_SanPham".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "SanPham".
 *
 * Columns in table "tbl_SanPham" available as properties of the model,
 * followed by relations of table "tbl_SanPham" available as properties of the model.
 *
 * @property integer $id
 * @property string $ma_vach
 * @property string $ten_san_pham
 * @property string $ten_tieng_viet
 * @property integer $han_dung
 * @property string $don_vi_tinh
 * @property integer $ton_toi_thieu
 * @property string $huong_dan_su_dung
 * @property string $mo_ta
 * @property integer $trang_thai
 * @property integer $nha_cung_cap_id
 * @property integer $loai_san_pham_id
 *
 * @property HoaDonBanHang[] $tblHoaDonBanHangs
 * @property HoaDonTraHang[] $tblHoaDonTraHangs
 * @property PhieuNhap[] $tblPhieuNhaps
 * @property PhieuXuat[] $tblPhieuXuats
 * @property LoaiSanPham $loaiSanPham
 * @property NhaCungCap $nhaCungCap
 * @property ChiNhanh[] $tblChiNhanhs
 */
abstract class BaseSanPham extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tbl_SanPham';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'SanPham|SanPhams', $n);
	}

	public static function representingColumn() {
		return 'ma_vach';
	}

	public function rules() {
		return array(
			array('ma_vach, nha_cung_cap_id, loai_san_pham_id', 'required'),
			array('han_dung, ton_toi_thieu, trang_thai, nha_cung_cap_id, loai_san_pham_id', 'numerical', 'integerOnly'=>true),
			array('ma_vach', 'length', 'max'=>15),
			array('ten_san_pham, ten_tieng_viet', 'length', 'max'=>100),
			array('don_vi_tinh', 'length', 'max'=>50),
			array('huong_dan_su_dung, mo_ta', 'safe'),
			array('ten_san_pham, ten_tieng_viet, han_dung, don_vi_tinh, ton_toi_thieu, huong_dan_su_dung, mo_ta, trang_thai', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, ma_vach, ten_san_pham, ten_tieng_viet, han_dung, don_vi_tinh, ton_toi_thieu, huong_dan_su_dung, mo_ta, trang_thai, nha_cung_cap_id, loai_san_pham_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'tblHoaDonBanHangs' => array(self::MANY_MANY, 'HoaDonBanHang', 'tbl_ChiTietHoaDonBan(san_pham_id, hoa_don_ban_id)'),
			'tblHoaDonTraHangs' => array(self::MANY_MANY, 'HoaDonTraHang', 'tbl_ChiTietHoaDonTra(san_pham_id, hoa_don_tra_id)'),
			'tblPhieuNhaps' => array(self::MANY_MANY, 'PhieuNhap', 'tbl_ChiTietPhieuNhap(san_pham_id, phieu_nhap_id)'),
			'tblPhieuXuats' => array(self::MANY_MANY, 'PhieuXuat', 'tbl_ChiTietPhieuXuat(san_pham_id, phieu_xuat_id)'),
			'loaiSanPham' => array(self::BELONGS_TO, 'LoaiSanPham', 'loai_san_pham_id'),
			'nhaCungCap' => array(self::BELONGS_TO, 'NhaCungCap', 'nha_cung_cap_id'),
			'tblChiNhanhs' => array(self::MANY_MANY, 'ChiNhanh', 'tbl_SanPhamChiNhanh(san_pham_id, chi_nhanh_id)'),
		);
	}

	public function pivotModels() {
		return array(
			'tblHoaDonBanHangs' => 'ChiTietHoaDonBan',
			'tblHoaDonTraHangs' => 'ChiTietHoaDonTra',
			'tblPhieuNhaps' => 'ChiTietPhieuNhap',
			'tblPhieuXuats' => 'ChiTietPhieuXuat',
			'tblChiNhanhs' => 'SanPhamChiNhanh',
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'ma_vach' => Yii::t('app', 'Ma Vach'),
			'ten_san_pham' => Yii::t('app', 'Ten San Pham'),
			'ten_tieng_viet' => Yii::t('app', 'Ten Tieng Viet'),
			'han_dung' => Yii::t('app', 'Han Dung'),
			'don_vi_tinh' => Yii::t('app', 'Don Vi Tinh'),
			'ton_toi_thieu' => Yii::t('app', 'Ton Toi Thieu'),
			'huong_dan_su_dung' => Yii::t('app', 'Huong Dan Su Dung'),
			'mo_ta' => Yii::t('app', 'Mo Ta'),
			'trang_thai' => Yii::t('app', 'Trang Thai'),
			'nha_cung_cap_id' => null,
			'loai_san_pham_id' => null,
			'tblHoaDonBanHangs' => null,
			'tblHoaDonTraHangs' => null,
			'tblPhieuNhaps' => null,
			'tblPhieuXuats' => null,
			'loaiSanPham' => null,
			'nhaCungCap' => null,
			'tblChiNhanhs' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('ma_vach', $this->ma_vach, true);
		$criteria->compare('ten_san_pham', $this->ten_san_pham, true);
		$criteria->compare('ten_tieng_viet', $this->ten_tieng_viet, true);
		$criteria->compare('han_dung', $this->han_dung);
		$criteria->compare('don_vi_tinh', $this->don_vi_tinh, true);
		$criteria->compare('ton_toi_thieu', $this->ton_toi_thieu);
		$criteria->compare('huong_dan_su_dung', $this->huong_dan_su_dung, true);
		$criteria->compare('mo_ta', $this->mo_ta, true);
		$criteria->compare('trang_thai', $this->trang_thai);
		$criteria->compare('nha_cung_cap_id', $this->nha_cung_cap_id);
		$criteria->compare('loai_san_pham_id', $this->loai_san_pham_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}