<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Thêm chi nhánh'),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Danh sách chi nhánh'), 'url' => array('index')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'Thêm') . ' ' . GxHtml::encode($model->label()); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
?>