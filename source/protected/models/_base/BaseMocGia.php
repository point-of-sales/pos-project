<?php

/**
 * This is the model base class for the table "tbl_MocGia".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "MocGia".
 *
 * Columns in table "tbl_MocGia" available as properties of the model,
 * followed by relations of table "tbl_MocGia" available as properties of the model.
 *
 * @property integer $id
 * @property double $gia_ban
 * @property string $thoi_gian_bat_dau
 * @property string $thoi_gian_ket_thuc
 * @property integer $chi_nhanh_id
 * @property integer $san_pham_id
 *
 * @property ChiNhanh $chiNhanh
 * @property SanPhamChiNhanh $sanPham
 */
abstract class BaseMocGia extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tbl_MocGia';
	}

	public static function label($n = 1) {
        if($n <= 1 ) {
            return Yii::t('viLib', 'MocGia');
        } else {
		    return Yii::t('viLib', 'MocGias');
        }
	}

	public static function representingColumn() {
		return 'thoi_gian_bat_dau';
	}

	public function rules() {
		return array(
			array('gia_ban, thoi_gian_bat_dau, thoi_gian_ket_thuc, chi_nhanh_id, san_pham_id', 'required'),
			array('chi_nhanh_id, san_pham_id', 'numerical', 'integerOnly'=>true),
			array('gia_ban', 'numerical'),
			array('id, gia_ban, thoi_gian_bat_dau, thoi_gian_ket_thuc, chi_nhanh_id, san_pham_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'chiNhanh' => array(self::BELONGS_TO, 'ChiNhanh', 'chi_nhanh_id'),
			'sanPham' => array(self::BELONGS_TO, 'SanPhamChiNhanh', 'san_pham_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'gia_ban' => Yii::t('app', 'Gia Ban'),
			'thoi_gian_bat_dau' => Yii::t('app', 'Thoi Gian Bat Dau'),
			'thoi_gian_ket_thuc' => Yii::t('app', 'Thoi Gian Ket Thuc'),
			'chi_nhanh_id' => null,
			'san_pham_id' => null,
			'chiNhanh' => null,
			'sanPham' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('gia_ban', $this->gia_ban);
		$criteria->compare('thoi_gian_bat_dau', $this->thoi_gian_bat_dau, true);
		$criteria->compare('thoi_gian_ket_thuc', $this->thoi_gian_ket_thuc, true);
		$criteria->compare('chi_nhanh_id', $this->chi_nhanh_id);
		$criteria->compare('san_pham_id', $this->san_pham_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}