<?php

/**
 * This is the model base class for the table "tbl_PhanQuyen".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "PhanQuyen".
 *
 * Columns in table "tbl_PhanQuyen" available as properties of the model,
 * followed by relations of table "tbl_PhanQuyen" available as properties of the model.
 *
 * @property integer $vai_tro_id
 * @property integer $quyen_id
 *
 * @property Quyen $quyen
 * @property Quyen $vaiTro
 */
abstract class BasePhanQuyen extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tbl_PhanQuyen';
	}

	public static function label($n = 1) {
        if($n <= 1 ) {
            return Yii::t('viLib', 'PhanQuyen');
        } else {
		    return Yii::t('viLib', 'PhanQuyens');
        }
	}

	public static function representingColumn() {
		return array(
			'vai_tro_id',
			'quyen_id',
		);
	}

	public function rules() {
		return array(
			array('vai_tro_id, quyen_id', 'required'),
			array('vai_tro_id, quyen_id', 'numerical', 'integerOnly'=>true),
			array('vai_tro_id, quyen_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'quyen' => array(self::BELONGS_TO, 'Quyen', 'quyen_id'),
			'vaiTro' => array(self::BELONGS_TO, 'Quyen', 'vai_tro_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'vai_tro_id' => null,
			'quyen_id' => null,
			'quyen' => null,
			'vaiTro' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('vai_tro_id', $this->vai_tro_id);
		$criteria->compare('quyen_id', $this->quyen_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}