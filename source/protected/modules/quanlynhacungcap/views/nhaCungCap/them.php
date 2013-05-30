<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Supplier management') => array('nhaCungCap/danhsach'),
    Yii::t('viLib', 'Supplier') => array('nhaCungCap/danhsach'),
    Yii::t('viLib', 'Create'),

);

$this->menu = array(
	array('label'=>Yii::t('viLib', 'List') . ' ' . Yii::t('viLib','Supplier'), 'url' => array('danhsach'),'visible' => Yii::app()->user->checkAccess('Quanlynhacungcap.NhaCungCap.DanhSach')),
);
?>

<h1><?php echo Yii::t('viLib', 'Create') . ' ' . GxHtml::encode($model->label()); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
?>