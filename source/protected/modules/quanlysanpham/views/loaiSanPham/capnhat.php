<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Product management')=>array('sanPham/danhsach'),
    Yii::t('viLib','Product type')=>array('sanPham/danhsach'),
    Yii::t('viLib', 'List')=>array(),
    GxHtml::valueEx($model,"ten_loai")
);

$this->menu = array(
	array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib','Product type'), 'url'=>array('danhsach'),'visible'=>Yii::app()->user->checkAccess('Quanlysanpham.LoaiSanPham.DanhSach')),
	array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib','Product type'), 'url'=>array('them'),'visible'=>Yii::app()->user->checkAccess('Quanlysanpham.LoaiSanPham.Them')),
	array('label' => Yii::t('viLib', 'View') . ' ' . Yii::t('viLib','Product type'), 'url'=>array('chitiet', 'id' => GxActiveRecord::extractPkValue($model, true)),'visible'=>Yii::app()->user->checkAccess('Quanlysanpham.LoaiSanPham.ChiTiet')),

);
?>

<h1><?php echo Yii::t('viLib', 'Update') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model,"ten_loai")); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model));
?>