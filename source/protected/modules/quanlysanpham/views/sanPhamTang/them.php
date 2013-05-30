<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Product management')=>array('sanPham/danhsach'),
    Yii::t('viLib','Gift product')=>array('sanPhamTang/danhsach'),
    Yii::t('viLib', 'Create'),
);

$this->menu = array(
	array('label'=>Yii::t('viLib', 'List') . ' ' . Yii::t('viLib','Gift Product'), 'url' => array('danhsach'),'visible'=>Yii::app()->user->checkAccess('Quanlysanpham.SanPhamTang.DanhSach')),
);
?>

<h1><?php echo Yii::t('viLib', 'Create') . ' ' . GxHtml::encode($model->label()); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
?>