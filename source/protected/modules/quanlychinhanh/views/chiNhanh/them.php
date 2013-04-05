<?php

$this->breadcrumbs = array(
	$model->label(2) => array('danhsach'),
	Yii::t('viLib', 'Add branch'),
);

$this->menu = array(
	array('label'=>Yii::t('viLib', 'Branchs List'), 'url' => array('danhsach')),
    array('label'=>Yii::t('viLib','Add Area'),'url'=>array('khuVuc/them'))

);
?>

<h1><?php echo Yii::t('viLib', 'Add') . ' ' . GxHtml::encode($model->label()); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
?>