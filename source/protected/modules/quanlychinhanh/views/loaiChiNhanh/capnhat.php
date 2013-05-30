<?php

$this->breadcrumbs = array(
    Yii::t('viLib','Branch management')=>array('chiNhanh/danhsach'),
    Yii::t('viLib','Branch type')=>array('loaiChiNhanh/danhsach'),
    Yii::t('viLib','Update')=>array(),
	GxHtml::valueEx($model),
);

$this->menu = array(
	array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib','Branch type'), 'url'=>array('danhsach'),'visible'=>Yii::app()->user->checkAccess('Quanlychinhanh.LoaiChiNhanh.DanhSach')),
	array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib','Branch type'), 'url'=>array('them'),'visible'=>Yii::app()->user->checkAccess('Quanlychinhanh.LoaiChiNhanh.Them')),
	array('label' => Yii::t('viLib', 'View') . ' ' . Yii::t('viLib','Branch type'), 'url'=>array('chitiet', 'id' => GxActiveRecord::extractPkValue($model, true)),'visible'=>Yii::app()->user->checkAccess('Quanlychinhanh.LoaiChiNhanh.ChiTiet')),
);
?>

<h1><?php echo Yii::t('viLib', 'Update') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model));
?>