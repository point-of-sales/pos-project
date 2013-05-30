<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Employee management') => array('nhanVien/danhsach'),
    Yii::t('viLib', 'Employee type') => array('loaiNhanVien/danhsach'),
    Yii::t('viLib', 'Detail') => array(),
    GxHtml::valueEx($model,"ten_loai"),
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Employee type'), 'url' => array('danhsach'),'visible'=>Yii::app()->user->checkAccess('Quanlynhanvien.LoaiNhanVien.DanhSach')),
    array('label' => Yii::t('viLib', 'Add') . ' ' . Yii::t('viLib', 'Employee type'), 'url' => array('them'),'visible'=>Yii::app()->user->checkAccess('Quanlynhanvien.LoaiNhanVien.Them')),
    array('label' => Yii::t('viLib', 'Update') . ' ' . Yii::t('viLib', 'Employee type'), 'url' => array('capnhat', 'id' => $model->id),'visible'=>Yii::app()->user->checkAccess('Quanlynhanvien.LoaiNhanVien.CapNhat')),
    array('label' => Yii::t('viLib', 'Delete') . ' ' . Yii::t('viLib', 'Employee type'), 'url' => '#', 'linkOptions' => array('submit' => array('xoa', 'id' => $model->id), 'confirm' => Yii::t('viLib', 'Are you sure you want to delete this item?')),'visible'=>Yii::app()->user->checkAccess('Quanlynhanvien.LoaiNhanVien.Xoa')),
);
?>


<h1><?php echo Yii::t('viLib', 'View') . ' ' . Yii::t('viLib', 'Employee type') . ' ' . GxHtml::encode(GxHtml::valueEx($model,"ten_loai")); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'ma_loai_nhan_vien',
        'ten_loai',
        'lop'
    ),
)); ?>