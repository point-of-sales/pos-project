<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Employee management') => array('nhanVien/danhsach'),
    Yii::t('viLib', 'Employee') => array('nhanVien/danhsach'),
    Yii::t('viLib', 'Update') => array(),
    GxHtml::valueEx($model, "ho_ten"),

);

$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Employee'), 'url' => array('danhsach'), 'visible' => Yii::app()->user->checkAccess('Quanlynhanvien.NhanVien.DanhSach')),
    array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Employee'), 'url' => array('them'), 'visible' => Yii::app()->user->checkAccess('Quanlynhanvien.NhanVien.Them')),
    array('label' => Yii::t('viLib', 'View') . ' ' . Yii::t('viLib', 'Employee'), 'url' => array('chitiet', 'id' => GxActiveRecord::extractPkValue($model, true)), 'visible' => Yii::app()->user->checkAccess('Quanlynhanvien.NhanVien.ChiTiet')),
);
?>

    <h1><?php echo Yii::t('viLib', 'Update') . ' ' . Yii::t('viLib', 'Employee') . ' ' . GxHtml::encode(GxHtml::valueEx($model, "ho_ten")); ?></h1>

<?php
$this->renderPartial('_form', array(
    'model' => $model));
?>