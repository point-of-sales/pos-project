<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Product management') => array('sanPham/danhsach'),
    Yii::t('viLib', 'Update') => array(),
    GxHtml::valueEx($model),
);

$this->menu = array(
	array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib','Product'), 'url'=>array('danhsach'),'visible'=>Yii::app()->user->checkAccess('Quanlysanpham.SanPham.DanhSach')),
	array('label' => Yii::t('viLib', 'Create') . ' ' . $model->label(), 'url'=>array('them'),'visible'=>Yii::app()->user->checkAccess('Quanlysanpham.SanPham.Them')),
	array('label' => Yii::t('viLib', 'View') . ' ' . $model->label(), 'url'=>array('chitiet', 'id' => GxActiveRecord::extractPkValue($model, true)),'visible'=>Yii::app()->user->checkAccess('Quanlysanpham.SanPham.Them')),
);
?>

<h1><?php echo Yii::t('viLib', 'Update') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model));
?>