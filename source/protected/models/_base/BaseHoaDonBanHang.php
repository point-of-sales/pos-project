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
 * @property integer $chiet_khau
 * @property integer $khach_hang_id
 *
 * @property SanPham[] $tblSanPhams
 * @property ChungTu $id0
 * @property HoaDonTraHang[] $hoaDonTraHangs
 */
abstract class BaseHoaDonBanHang extends ChungTu {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tbl_HoaDonBanHang';
	}

	public static function label($n = 1) {
        if($n <= 1 ) {
            return Yii::t('viLib', 'HoaDonBanHang');
        } else {
		    return Yii::t('viLib', 'HoaDonBanHangs');
        }
	}

	public static function representingColumn() {
		return 'id';
	}

	public function rules() {
		return array(
			array('id, khach_hang_id', 'required'),
			array('id, chiet_khau, khach_hang_id', 'numerical', 'integerOnly'=>true),
			array('chiet_khau', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, chiet_khau, khach_hang_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'tblSanPhams' => array(self::MANY_MANY, 'SanPham', 'tbl_ChiTietHoaDonBan(hoa_don_ban_id, san_pham_id)'),
			'id0' => array(self::BELONGS_TO, 'ChungTu', 'id'),
			'hoaDonTraHangs' => array(self::HAS_MANY, 'HoaDonTraHang', 'hoa_don_ban_id'),
		);
	}

	public function pivotModels() {
		return array(
			'tblSanPhams' => 'ChiTietHoaDonBan',
		);
	}

	public function attributeLabels() {
		return array(
			'id' => null,
			'chiet_khau' => Yii::t('app', 'Chiet Khau'),
			'khach_hang_id' => Yii::t('app', 'Khach Hang'),
			'tblSanPhams' => null,
			'id0' => null,
			'hoaDonTraHangs' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('chiet_khau', $this->chiet_khau);
		$criteria->compare('khach_hang_id', $this->khach_hang_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}