<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Employee management') => array('nhanVien/danhsach'),
    Yii::t('viLib', 'Employee') => array('nhanVien/danhsach'),
    Yii::t('viLib', 'Add') . ' ' . Yii::t('viLib', 'Employee'),
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Employee'), 'url' => array('danhsach'), 'visible' => Yii::app()->user->checkAccess('Quanlynhanvien.NhanVien.DanhSach')),
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Employee type'), 'url' => array('loaiNhanVien/danhsach'), 'visible' => Yii::app()->user->checkAccess('Quanlynhanvien.LoaiNhanVien.DanhSach')),
    array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Employee type'), 'url' => array('loaiNhanVien/them'), 'visible' => Yii::app()->user->checkAccess('Quanlynhanvien.NhanVien.Them')),
);
?>

    <h1><?php echo Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Employee'); ?></h1>

<?php
$this->renderPartial('_form', array(
    'model' => $model,
    'buttons' => 'create'));
?>