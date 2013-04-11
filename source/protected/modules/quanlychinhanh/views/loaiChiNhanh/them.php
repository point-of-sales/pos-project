<?php

$this->breadcrumbs = array(
    Yii::t('viLib','Branch management')=>array('chiNhanh/danhsach'),
    Yii::t('viLib','Branch type')=>array(),
	Yii::t('viLib', 'Create'),
);

$this->menu = array(
	array('label'=>Yii::t('viLib', 'List') . ' ' . $model->label(2), 'url' => array('danhsach')),
);
?>

<h1><?php echo Yii::t('viLib', 'Create') . ' ' . GxHtml::encode($model->label()); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
?>