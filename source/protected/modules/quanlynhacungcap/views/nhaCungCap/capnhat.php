<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Supplier management') => array('nhaCungCap/danhsach'),
    Yii::t('viLib', 'Supplier') => array('nhaCungCap/danhsach'),
    Yii::t('viLib', 'Update')=>array(),
    GxHtml::valueEx($model,"ten_nha_cung_cap"),

);

$this->menu = array(
	array('label' => Yii::t('viLib', 'List') . ' ' . $model->label(2), 'url'=>array('danhsach')),
	array('label' => Yii::t('viLib', 'Create') . ' ' . $model->label(), 'url'=>array('them')),
	array('label' => Yii::t('viLib', 'View') . ' ' . $model->label(), 'url'=>array('chitiet', 'id' => GxActiveRecord::extractPkValue($model, true))),
	array('label' => Yii::t('viLib', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('viLib', 'Update') . ' ' .  Yii::t('viLib', 'Supplier') . ' ' . GxHtml::encode(GxHtml::valueEx($model,"ten_nha_cung_cap")); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model));
?>