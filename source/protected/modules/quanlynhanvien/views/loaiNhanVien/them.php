<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Employee management') => array('nhanVien/danhsach'),
    Yii::t('viLib', 'Employee type') => array('loaiNhanVien/danhsach'),
    Yii::t('viLib', 'Create'),

);

$this->menu = array(
	array('label'=>Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Employee type'), 'url' => array('danhsach')),
);
?>

<h1><?php echo Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Employee type'); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
?>