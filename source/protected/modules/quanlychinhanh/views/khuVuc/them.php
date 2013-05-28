<?php

$this->breadcrumbs = array(
    Yii::t('viLib','Branch management')=>array('chiNhanh/danhsach'),
    Yii::t('viLib','Area')=>array('khuVuc/danhsach'),
	Yii::t('viLib', 'Create'),
);

$this->menu = array(
	array('label'=>Yii::t('viLib', 'List') . ' ' . Yii::t('viLib','Area'), 'url' => array('danhsach'),'visible'=>Yii::app()->user->checkAccess('Quanlychinhanh.KhuVuc.DanhSach')),
);
?>

<h1><?php echo Yii::t('viLib', 'Create') . ' ' . GxHtml::encode($model->label()); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
?>