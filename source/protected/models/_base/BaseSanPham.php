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
 * @property integer $chi_nhanh_id
 * @property integer $san_pham_id
 * @property integer $khuyen_mai_id
 * @property integer $so_ton
 * @property integer $trang_thai
 *
 * @property MocGia[] $mocGias
 * @property MocGia[] $mocGias1
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
		return array(
			'chi_nhanh_id',
			'san_pham_id',
		);
	}

	public function rules() {
		return array(
			array('chi_nhanh_id, san_pham_id, khuyen_mai_id', 'required'),
			array('chi_nhanh_id, san_pham_id, khuyen_mai_id, so_ton, trang_thai', 'numerical', 'integerOnly'=>true),
			array('so_ton, trang_thai', 'default', 'setOnEmpty' => true, 'value' => null),
			array('chi_nhanh_id, san_pham_id, khuyen_mai_id, so_ton, trang_thai', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'mocGias' => array(self::HAS_MANY, 'MocGia', 'chi_nhanh_id'),
			'mocGias1' => array(self::HAS_MANY, 'MocGia', 'san_pham_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'chi_nhanh_id' => null,
			'san_pham_id' => null,
			'khuyen_mai_id' => null,
			'so_ton' => Yii::t('app', 'So Ton'),
			'trang_thai' => Yii::t('app', 'Trang Thai'),
			'mocGias' => null,
			'mocGias1' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('chi_nhanh_id', $this->chi_nhanh_id);
		$criteria->compare('san_pham_id', $this->san_pham_id);
		$criteria->compare('khuyen_mai_id', $this->khuyen_mai_id);
		$criteria->compare('so_ton', $this->so_ton);
		$criteria->compare('trang_thai', $this->trang_thai);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}