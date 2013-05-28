<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Product management')=>array('sanPham/danhsach'),
    Yii::t('viLib','Product type')=>array('loaiSanPham/danhsach'),
    Yii::t('viLib', 'Create'),
);

$this->menu = array(
	array('label'=>Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Product type'), 'url' => array('danhsach'),'visible' => Yii::app()->user->checkAccess('Quanlysanpham.LoaiSanPham.DanhSach')),
);
?>

<h1><?php echo Yii::t('viLib', 'Create') . ' ' . GxHtml::encode($model->label()); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
?>