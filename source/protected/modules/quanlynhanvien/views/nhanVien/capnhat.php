<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Employee management') => array('nhanVien/danhsach'),
    Yii::t('viLib', 'Employee') => array('nhanVien/danhsach'),
    Yii::t('viLib', 'Update')=>array(),
	GxHtml::valueEx($model,"ho_ten"),

);

$this->menu = array(
	array('label' => Yii::t('viLib', 'List') . ' ' . $model->label(2), 'url'=>array('danhsach')),
	array('label' => Yii::t('viLib', 'Create') . ' ' . $model->label(), 'url'=>array('them')),
	array('label' => Yii::t('viLib', 'View') . ' ' . $model->label(), 'url'=>array('chitiet', 'id' => GxActiveRecord::extractPkValue($model, true))),
);
?>

<h1><?php echo Yii::t('viLib', 'Update') . ' ' . Yii::t('viLib', 'Employee') . ' ' . GxHtml::encode(GxHtml::valueEx($model,"ho_ten")); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model));
?>