<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Customer management') => array('khachHang/danhsach'),
    Yii::t('viLib', 'Customer') => array('khachHang/danhsach'),
    Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Customer'),
);

$this->menu = array(
	array('label'=>Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Customer'), 'url' => array('danhsach'),'visible'=>Yii::app()->user->checkAccess('Quanlykhachhang.KhachHang.DanhSach')),
    array('label'=>Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Customer type'), 'url'=>array('loaiKhachHang/them'),'visible'=>Yii::app()->user->checkAccess('Quanlykhachhang.LoaiKhachHang.Them')),
);
?>

<h1><?php echo Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Customer'); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
?>