<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Config management') => array('cauHinh/chitiet/id/1'),
    Yii::t('viLib', 'Company Information') => array('thongTinCongTy/chitiet/id/1'),
    GxHtml::valueEx($model),
);

$this->menu = array(
	array('label' => Yii::t('viLib', 'View') . ' ' . Yii::t('viLib','Company Information'), 'url'=>array('chitiet', 'id' => GxActiveRecord::extractPkValue($model, true)),'visible'=>Yii::app()->user->checkAccess('Quanlycauhinh.ThongTinCongTy.ChiTiet')),
);
?>

<h1><?php echo Yii::t('viLib', 'Update') . ' ' .Yii::t('viLib','Company Information') . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model));
?>