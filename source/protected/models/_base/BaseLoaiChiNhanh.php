<?php

/**
 * This is the model base class for the table "tbl_LoaiChiNhanh".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "LoaiChiNhanh".
 *
 * Columns in table "tbl_LoaiChiNhanh" available as properties of the model,
 * followed by relations of table "tbl_LoaiChiNhanh" available as properties of the model.
 *
 * @property integer $id
 * @property string $ma_loai_chi_nhanh
 * @property string $ten_loai_chi_nhanh
 *
 * @property ChiNhanh[] $chiNhanhs
 */
abstract class BaseLoaiChiNhanh extends CPOSActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tbl_LoaiChiNhanh';
	}

	public static function label($n = 1) {
        if($n <= 1 ) {
            return Yii::t('viLib', 'Branch type');
        } else {
		    return Yii::t('viLib', 'Branch types');
        }
	}

	public static function representingColumn() {
		return 'ma_loai_chi_nhanh';
	}

	public function rules() {
		return array(
			array('ma_loai_chi_nhanh', 'required'),
			array('ma_loai_chi_nhanh', 'length', 'max'=>15),
			array('ten_loai_chi_nhanh', 'length', 'max'=>100),
			array('ten_loai_chi_nhanh', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, ma_loai_chi_nhanh, ten_loai_chi_nhanh', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'chiNhanhs' => array(self::HAS_MANY, 'ChiNhanh', 'loai_chi_nhanh_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('viLib', 'ID'),
			'ma_loai_chi_nhanh' => Yii::t('viLib', 'Ma Loai Chi Nhanh'),
			'ten_loai_chi_nhanh' => Yii::t('viLib', 'Ten Loai Chi Nhanh'),
			'chiNhanhs' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;
		//$criteria->compare('id', $this->id);
		$criteria->compare('ma_loai_chi_nhanh', $this->ma_loai_chi_nhanh, true);
		$criteria->compare('ten_loai_chi_nhanh', $this->ten_loai_chi_nhanh, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}