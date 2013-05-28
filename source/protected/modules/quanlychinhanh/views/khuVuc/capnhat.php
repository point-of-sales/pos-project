<?php

$this->breadcrumbs = array(
    Yii::t('viLib','Branch management')=>array('chiNhanh/danhsach'),
    Yii::t('viLib','Area')=>array('khuVuc/danhsach'),
    Yii::t('viLib', 'Update')=>array(),
    GxHtml::valueEx($model,"ten_khu_vuc"),
);

$this->menu = array(
	array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib','Branch type') , 'url'=>array('danhsach'),'visible'=>Yii::app()->user->checkAccess('Quanlychinhanh.KhuVuc.DanhSach')),
	array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib','Branch type'), 'url'=>array('them'),'visible'=>Yii::app()->user->checkAccess('Quanlychinhanh.KhuVuc.Them')),
	array('label' => Yii::t('viLib', 'View') . ' ' .Yii::t('viLib','Branch type'), 'url'=>array('chitiet', 'id' => GxActiveRecord::extractPkValue($model, true)),'visible'=>Yii::app()->user->checkAccess('Quanlychinhanh.KhuVuc.ChiTiet')),
);
?>

<h1><?php echo Yii::t('viLib', 'Update') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model,"ten_khu_vuc")); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model));
?>