<?php

/**
 * This is the model base class for the table "tbl_ChiTietHoaDonTra".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "ChiTietHoaDonTra".
 *
 * Columns in table "tbl_ChiTietHoaDonTra" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $san_pham_id
 * @property integer $hoa_don_tra_id
 * @property integer $so_luong
 * @property double $don_gia
 *
 */
abstract class BaseChiTietHoaDonTra extends CPOSActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tbl_ChiTietHoaDonTra';
	}

	public static function label($n = 1) {
        if($n <= 1 ) {
            return Yii::t('viLib', 'ChiTietHoaDonTra');
        } else {
		    return Yii::t('viLib', 'ChiTietHoaDonTras');
        }
	}

	public static function representingColumn() {
		return array(
			'san_pham_id',
			'hoa_don_tra_id',
		);
	}

	public function rules() {
		return array(
			array('san_pham_id, hoa_don_tra_id', 'required'),
			array('san_pham_id, hoa_don_tra_id, so_luong', 'numerical', 'integerOnly'=>true),
			array('don_gia', 'numerical'),
			array('so_luong, don_gia', 'default', 'setOnEmpty' => true, 'value' => null),
			array('san_pham_id, hoa_don_tra_id, so_luong, don_gia', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'san_pham_id' => null,
			'hoa_don_tra_id' => null,
			'so_luong' => Yii::t('app', 'So Luong'),
			'don_gia' => Yii::t('app', 'Don Gia'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('san_pham_id', $this->san_pham_id);
		$criteria->compare('hoa_don_tra_id', $this->hoa_don_tra_id);
		$criteria->compare('so_luong', $this->so_luong);
		$criteria->compare('don_gia', $this->don_gia);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}