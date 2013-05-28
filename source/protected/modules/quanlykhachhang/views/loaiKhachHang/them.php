<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Customer management') => array('khachHang/danhsach'),
    Yii::t('viLib', 'Customer type') => array('loaiKhachHang/danhsach'),
    Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Customer type'),
);

$this->menu = array(
	array('label'=>Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Customer type'), 'url' => array('danhsach'),'visible'=>Yii::app()->user->checkAccess('Quanlykhachhang.LoaiKhachHang.DanhSach')),
);
?>

<h1><?php echo Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Customer type'); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
?>