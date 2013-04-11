<?php

/**
 * This is the model base class for the table "tbl_ChiNhanh".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "ChiNhanh".
 *
 * Columns in table "tbl_ChiNhanh" available as properties of the model,
 * followed by relations of table "tbl_ChiNhanh" available as properties of the model.
 *
 * @property integer $id
 * @property string $ma_chi_nhanh
 * @property string $ten_chi_nhanh
 * @property string $dia_chi
 * @property string $dien_thoai
 * @property string $fax
 * @property string $mo_ta
 * @property integer $trang_thai
 * @property integer $truc_thuoc_id
 * @property integer $khu_vuc_id
 * @property integer $loai_chi_nhanh_id
 *
 * @property ChiNhanh $trucThuoc
 * @property ChiNhanh[] $chiNhanhs
 * @property KhuVuc $khuVuc
 * @property LoaiChiNhanh $loaiChiNhanh
 * @property ChungTu[] $chungTus
 * @property KhuyenMai[] $khuyenMais
 * @property KhuyenMai[] $tblKhuyenMais
 * @property MocGia[] $mocGias
 * @property NhanVien[] $nhanViens
 * @property PhieuNhap[] $phieuNhaps
 * @property PhieuXuat[] $phieuXuats
 * @property SanPham[] $tblSanPhams
 * @property SanPhamTang[] $tblSanPhamTangs
 */
abstract class BaseChiNhanh extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tbl_ChiNhanh';
	}

	public static function label($n = 1) {
        if($n <= 1 ) {
            return Yii::t('viLib', 'ChiNhanh');
        } else {
		    return Yii::t('viLib', 'ChiNhanhs');
        }
	}

	public static function representingColumn() {
		return 'ma_chi_nhanh';
	}

	public function rules() {
		return array(
			array('ma_chi_nhanh, ten_chi_nhanh, trang_thai, khu_vuc_id, loai_chi_nhanh_id', 'required'),
			array('trang_thai, truc_thuoc_id, khu_vuc_id, loai_chi_nhanh_id', 'numerical', 'integerOnly'=>true),
			array('ma_chi_nhanh, dien_thoai, fax', 'length', 'max'=>15),
			array('ten_chi_nhanh, dia_chi', 'length', 'max'=>100),
			array('mo_ta', 'safe'),
			array('dia_chi, dien_thoai, fax, mo_ta, truc_thuoc_id', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, ma_chi_nhanh, ten_chi_nhanh, dia_chi, dien_thoai, fax, mo_ta, trang_thai, truc_thuoc_id, khu_vuc_id, loai_chi_nhanh_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'trucThuoc' => array(self::BELONGS_TO, 'ChiNhanh', 'truc_thuoc_id'),
			'chiNhanhs' => array(self::HAS_MANY, 'ChiNhanh', 'truc_thuoc_id'),
			'khuVuc' => array(self::BELONGS_TO, 'KhuVuc', 'khu_vuc_id'),
			'loaiChiNhanh' => array(self::BELONGS_TO, 'LoaiChiNhanh', 'loai_chi_nhanh_id'),
			'chungTus' => array(self::HAS_MANY, 'ChungTu', 'chi_nhanh_id'),
			'khuyenMais' => array(self::HAS_MANY, 'KhuyenMai', 'chi_nhanh_id'),
			'tblKhuyenMais' => array(self::MANY_MANY, 'KhuyenMai', 'tbl_KhuyenMaiChiNhanh(chi_nhanh_id, khuyen_mai_id)'),
			'mocGias' => array(self::HAS_MANY, 'MocGia', 'chi_nhanh_id'),
			'nhanViens' => array(self::HAS_MANY, 'NhanVien', 'chi_nhanh_id'),
			'phieuNhaps' => array(self::HAS_MANY, 'PhieuNhap', 'chi_nhanh_xuat_id'),
			'phieuXuats' => array(self::HAS_MANY, 'PhieuXuat', 'chi_nhanh_nhap_id'),
			'tblSanPhams' => array(self::MANY_MANY, 'SanPham', 'tbl_SanPhamChiNhanh(chi_nhanh_id, san_pham_id)'),
			'tblSanPhamTangs' => array(self::MANY_MANY, 'SanPhamTang', 'tbl_SanPhamTangChiNhanh(chi_nhanh_id, san_pham_tang_id)'),
		);
	}

	public function pivotModels() {
		return array(
			'tblKhuyenMais' => 'KhuyenMaiChiNhanh',
			'tblSanPhams' => 'SanPhamChiNhanh',
			'tblSanPhamTangs' => 'SanPhamTangChiNhanh',
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'ma_chi_nhanh' => Yii::t('app', 'Ma Chi Nhanh'),
			'ten_chi_nhanh' => Yii::t('app', 'Ten Chi Nhanh'),
			'dia_chi' => Yii::t('app', 'Dia Chi'),
			'dien_thoai' => Yii::t('app', 'Dien Thoai'),
			'fax' => Yii::t('app', 'Fax'),
			'mo_ta' => Yii::t('app', 'Mo Ta'),
			'trang_thai' => Yii::t('app', 'Trang Thai'),
			'truc_thuoc_id' => null,
			'khu_vuc_id' => null,
			'loai_chi_nhanh_id' => null,
			'trucThuoc' => null,
			'chiNhanhs' => null,
			'khuVuc' => null,
			'loaiChiNhanh' => null,
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

	public function search() {
		$criteria = new CDbCriteria;

		//$criteria->compare('id', trim($this->id));
		$criteria->compare('ma_chi_nhanh', $this->ma_chi_nhanh, true);
		$criteria->compare('ten_chi_nhanh', $this->ten_chi_nhanh, true);
		//$criteria->compare('dia_chi', trim($this->dia_chi), true);
		//$criteria->compare('dien_thoai', trim($this->dien_thoai), true);
		//$criteria->compare('fax', trim($this->fax), true);
		//$criteria->compare('mo_ta', trim($this->mo_ta), true);
		$criteria->compare('trang_thai', $this->trang_thai);
		$criteria->compare('truc_thuoc_id', $this->truc_thuoc_id);
		$criteria->compare('khu_vuc_id', $this->khu_vuc_id);
		//$criteria->compare('loai_chi_nhanh_id', trim($this->loai_chi_nhanh_id));

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}