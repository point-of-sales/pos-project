<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Employee management') => array('nhanVien/danhsach'),
    Yii::t('viLib', 'Employee type') => array('loaiNhanVien/danhsach'),
    Yii::t('viLib', 'Update') => array(),
    GxHtml::valueEx($model,"ten_loai"),
);

$this->menu = array(
	array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Employee type'), 'url'=>array('danhsach'),'visible'=>Yii::app()->user->checkAccess('Quanlynhanvien.LoaiNhanVien.DanhSach')),
	array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Employee type'), 'url'=>array('them'),'visible'=>Yii::app()->user->checkAccess('Quanlynhanvien.LoaiNhanVien.Them')),
	array('label' => Yii::t('viLib', 'View') . ' ' . Yii::t('viLib', 'Employee type'), 'url'=>array('chitiet', 'id' => GxActiveRecord::extractPkValue($model, true)),'visible'=>Yii::app()->user->checkAccess('Quanlynhanvien.LoaiNhanVien.ChiTiet')),
);
?>

<h1><?php echo Yii::t('viLib', 'Update') . ' ' . Yii::t('viLib', 'Employee type') . ' ' . GxHtml::encode(GxHtml::valueEx($model,"ten_loai")); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model));
?>