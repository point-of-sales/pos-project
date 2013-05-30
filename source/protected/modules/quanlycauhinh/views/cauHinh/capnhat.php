<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Config management') => array('cauHinh/chitiet/id/1'),
    Yii::t('viLib', 'Config') => array('cauHinh/chitiet/id/1'),
    Yii::t('viLib', 'Update Config'),
);

$this->menu = array(
	array('label' => Yii::t('viLib', 'View') . ' ' . Yii::t('viLib','Config'), 'url'=>array('chitiet', 'id' => GxActiveRecord::extractPkValue($model, true)),'visible'=>Yii::app()->user->checkAccess('Quanlycauhinh.CauHinh.ChiTiet')),
);
?>

<h1><?php echo Yii::t('viLib', 'Update') . ' ' . Yii::t('viLib','Config') ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model));
?>