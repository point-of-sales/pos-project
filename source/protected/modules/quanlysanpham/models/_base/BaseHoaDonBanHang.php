<?php

/**
 * This is the model base class for the table "tbl_HoaDonBanHang".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "HoaDonBanHang".
 *
 * Columns in table "tbl_HoaDonBanHang" available as properties of the model,
 * followed by relations of table "tbl_HoaDonBanHang" available as properties of the model.
 *
 * @property integer $id
 * @property integer $ma_chung_tu
 * @property string $ngay_lap
 * @property double $tri_gia
 * @property string $ghi_chu
 * @property integer $chiet_khau
 * @property integer $khach_hang_id
 * @property integer $nhan_vien_id
 * @property integer $chi_nhanh_id
 *
 * @property ThongTinSanPham[] $tblThongTinSanPhams
 * @property ChiNhanh $chiNhanh
 * @property NhanVien $nhanVien
 * @property KhachHang $khachHang
 * @property HoaDonTraHang[] $hoaDonTraHangs
 */
abstract class BaseHoaDonBanHang extends ThongTinSanPham {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tbl_HoaDonBanHang';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'HoaDonBanHang|HoaDonBanHangs', $n);
	}

	public static function representingColumn() {
		return 'ngay_lap';
	}

	public function rules() {
		return array(
			array('ma_chung_tu, khach_hang_id, nhan_vien_id, chi_nhanh_id', 'required'),
			array('ma_chung_tu, chiet_khau, khach_hang_id, nhan_vien_id, chi_nhanh_id', 'numerical', 'integerOnly'=>true),
			array('tri_gia', 'numerical'),
			array('ngay_lap, ghi_chu', 'safe'),
			array('ngay_lap, tri_gia, ghi_chu, chiet_khau', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, ma_chung_tu, ngay_lap, tri_gia, ghi_chu, chiet_khau, khach_hang_id, nhan_vien_id, chi_nhanh_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'tblThongTinSanPhams' => array(self::MANY_MANY, 'ThongTinSanPham', 'tbl_ChiTietHoaDonBan(hoa_don_ban_id, san_pham_id)'),
			'chiNhanh' => array(self::BELONGS_TO, 'ChiNhanh', 'chi_nhanh_id'),
			'nhanVien' => array(self::BELONGS_TO, 'NhanVien', 'nhan_vien_id'),
			'khachHang' => array(self::BELONGS_TO, 'KhachHang', 'khach_hang_id'),
			'hoaDonTraHangs' => array(self::HAS_MANY, 'HoaDonTraHang', 'hoa_don_ban_id'),
		);
	}

	public function pivotModels() {
		return array(
			'tblThongTinSanPhams' => 'ChiTietHoaDonBan',
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'ma_chung_tu' => Yii::t('app', 'Ma Chung Tu'),
			'ngay_lap' => Yii::t('app', 'Ngay Lap'),
			'tri_gia' => Yii::t('app', 'Tri Gia'),
			'ghi_chu' => Yii::t('app', 'Ghi Chu'),
			'chiet_khau' => Yii::t('app', 'Chiet Khau'),
			'khach_hang_id' => null,
			'nhan_vien_id' => null,
			'chi_nhanh_id' => null,
			'tblThongTinSanPhams' => null,
			'chiNhanh' => null,
			'nhanVien' => null,
			'khachHang' => null,
			'hoaDonTraHangs' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('ma_chung_tu', $this->ma_chung_tu);
		$criteria->compare('ngay_lap', $this->ngay_lap, true);
		$criteria->compare('tri_gia', $this->tri_gia);
		$criteria->compare('ghi_chu', $this->ghi_chu, true);
		$criteria->compare('chiet_khau', $this->chiet_khau);
		$criteria->compare('khach_hang_id', $this->khach_hang_id);
		$criteria->compare('nhan_vien_id', $this->nhan_vien_id);
		$criteria->compare('chi_nhanh_id', $this->chi_nhanh_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}