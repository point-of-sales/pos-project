<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Customer management') => array('khachHang/danhsach'),
    Yii::t('viLib', 'Customer type') => array('loaiKhachHang/danhsach'),
    Yii::t('viLib', 'Update')=>array(),
    GxHtml::valueEx($model,"ten_loai")
);

$this->menu = array(
	array('label' => Yii::t('viLib', 'List') . ' ' . $model->label(2), 'url'=>array('danhsach')),
	array('label' => Yii::t('viLib', 'Create') . ' ' . $model->label(), 'url'=>array('them')),
	array('label' => Yii::t('viLib', 'View') . ' ' . $model->label(), 'url'=>array('chitiet', 'id' => GxActiveRecord::extractPkValue($model, true))),
);
?>

<h1><?php echo Yii::t('viLib', 'Update') . ' ' .  Yii::t('viLib', 'Customer type') . ' ' . GxHtml::encode(GxHtml::valueEx($model,"ten_loai")); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model));
?>