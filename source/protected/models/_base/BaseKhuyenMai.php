<?php

/**
 * This is the model base class for the table "tbl_KhuyenMai".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "KhuyenMai".
 *
 * Columns in table "tbl_KhuyenMai" available as properties of the model,
 * followed by relations of table "tbl_KhuyenMai" available as properties of the model.
 *
 * @property integer $id
 * @property string $ma_chuong_trinh
 * @property string $ten_chuong_trinh
 * @property string $mo_ta
 * @property integer $gia_giam
 * @property string $thoi_gian_bat_dau
 * @property string $thoi_gian_ket_thuc
 * @property integer $trang_thai
 * @property integer $chi_nhanh_id
 *
 * @property ChiNhanh $chiNhanh
 * @property ChiNhanh[] $tblChiNhanhs
 */
abstract class BaseKhuyenMai extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tbl_KhuyenMai';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'KhuyenMai|KhuyenMais', $n);
	}

	public static function representingColumn() {
		return 'ma_chuong_trinh';
	}

	public function rules() {
		return array(
			array('ma_chuong_trinh, trang_thai, chi_nhanh_id', 'required'),
			array('gia_giam, trang_thai, chi_nhanh_id', 'numerical', 'integerOnly'=>true),
			array('ma_chuong_trinh', 'length', 'max'=>15),
			array('ten_chuong_trinh', 'length', 'max'=>200),
			array('mo_ta, thoi_gian_bat_dau, thoi_gian_ket_thuc', 'safe'),
			array('ten_chuong_trinh, mo_ta, gia_giam, thoi_gian_bat_dau, thoi_gian_ket_thuc', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, ma_chuong_trinh, ten_chuong_trinh, mo_ta, gia_giam, thoi_gian_bat_dau, thoi_gian_ket_thuc, trang_thai, chi_nhanh_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'chiNhanh' => array(self::BELONGS_TO, 'ChiNhanh', 'chi_nhanh_id'),
			'tblChiNhanhs' => array(self::MANY_MANY, 'ChiNhanh', 'tbl_KhuyenMaiChiNhanh(khuyen_mai_id, chi_nhanh_id)'),
		);
	}

	public function pivotModels() {
		return array(
			'tblChiNhanhs' => 'KhuyenMaiChiNhanh',
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'ma_chuong_trinh' => Yii::t('app', 'Ma Chuong Trinh'),
			'ten_chuong_trinh' => Yii::t('app', 'Ten Chuong Trinh'),
			'mo_ta' => Yii::t('app', 'Mo Ta'),
			'gia_giam' => Yii::t('app', 'Gia Giam'),
			'thoi_gian_bat_dau' => Yii::t('app', 'Thoi Gian Bat Dau'),
			'thoi_gian_ket_thuc' => Yii::t('app', 'Thoi Gian Ket Thuc'),
			'trang_thai' => Yii::t('app', 'Trang Thai'),
			'chi_nhanh_id' => null,
			'chiNhanh' => null,
			'tblChiNhanhs' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('ma_chuong_trinh', $this->ma_chuong_trinh, true);
		$criteria->compare('ten_chuong_trinh', $this->ten_chuong_trinh, true);
		$criteria->compare('mo_ta', $this->mo_ta, true);
		$criteria->compare('gia_giam', $this->gia_giam);
		$criteria->compare('thoi_gian_bat_dau', $this->thoi_gian_bat_dau, true);
		$criteria->compare('thoi_gian_ket_thuc', $this->thoi_gian_ket_thuc, true);
		$criteria->compare('trang_thai', $this->trang_thai);
		$criteria->compare('chi_nhanh_id', $this->chi_nhanh_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}