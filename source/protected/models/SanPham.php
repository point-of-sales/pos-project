<?php

Yii::import('application.models._base.BaseSanPham');

class SanPham extends BaseSanPham
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}