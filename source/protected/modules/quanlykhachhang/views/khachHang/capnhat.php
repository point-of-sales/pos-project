<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Customer management') => array('khachHang/danhsach'),
    Yii::t('viLib', 'Customer') => array('khachHang/danhsach'),
    Yii::t('viLib', 'Update')=>array(),
    GxHtml::valueEx($model,"ho_ten"),
);

$this->menu = array(
	array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib','Customer'), 'url'=>array('danhsach'),'visible'=>Yii::app()->user->checkAccess('Quanlykhachhang.KhachHang.DanhSach')),
	array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib','Customer'), 'url'=>array('them'),'visible'=>Yii::app()->user->checkAccess('Quanlykhachhang.KhachHang.Them')),
	array('label' => Yii::t('viLib', 'View') . ' ' . Yii::t('viLib','Customer'), 'url'=>array('chitiet', 'id' => GxActiveRecord::extractPkValue($model, true)),'visible'=>Yii::app()->user->checkAccess('Quanlykhachhang.KhachHang.ChiTiet')),
);
?>

<h1><?php echo Yii::t('viLib', 'Update') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model,"ho_ten")); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model));
?>