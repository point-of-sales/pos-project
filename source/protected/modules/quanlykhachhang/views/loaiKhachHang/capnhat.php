<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Customer management') => array('khachHang/danhsach'),
    Yii::t('viLib', 'Customer type') => array('loaiKhachHang/danhsach'),
    Yii::t('viLib', 'Update')=>array(),
    GxHtml::valueEx($model,"ten_loai")
);

$this->menu = array(
	array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib','Customer type'), 'url'=>array('danhsach'),'visible'=>Yii::app()->user->checkAccess('Quanlykhachhang.LoaiKhachHang.DanhSach')),
	array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib','Customer type'), 'url'=>array('them'),'visible'=>Yii::app()->user->checkAccess('Quanlykhachhang.LoaiKhachHang.Them')),
	array('label' => Yii::t('viLib', 'View') . ' ' . Yii::t('viLib','Customer type'), 'url'=>array('chitiet', 'id' => GxActiveRecord::extractPkValue($model, true)),'visible'=>Yii::app()->user->checkAccess('Quanlykhachhang.LoaiKhachHang.Them')),
);
?>

<h1><?php echo Yii::t('viLib', 'Update') . ' ' .  Yii::t('viLib', 'Customer type') . ' ' . GxHtml::encode(GxHtml::valueEx($model,"ten_loai")); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model));
?>