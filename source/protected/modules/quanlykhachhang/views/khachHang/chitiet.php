<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Customer management') => array('khachHang/danhsach'),
    Yii::t('viLib', 'Customer') => array('khachHang/danhsach'),
    Yii::t('viLib', 'Detail') . ' ' . Yii::t('viLib', 'Customer')=>array(),
    GxHtml::valueEx($model,"ho_ten"),

);

$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' .  Yii::t('viLib', 'Customer'), 'url' => array('danhsach')),
    array('label' => Yii::t('viLib', 'Add') . ' ' .  Yii::t('viLib', 'Customer'), 'url' => array('them')),
    array('label' => Yii::t('viLib', 'Update') . ' ' .  Yii::t('viLib', 'Customer'), 'url' => array('capnhat', 'id' => $model->id)),
    array('label' => Yii::t('viLib', 'Delete') . ' ' .  Yii::t('viLib', 'Customer'), 'url' => '#', 'linkOptions' => array('submit' => array('xoa', 'id' => $model->id), 'confirm' => Yii::t('viLib', 'Are you sure you want to delete this item?'))),
);
?>


<h1><?php echo Yii::t('viLib', 'View') . ' ' .  Yii::t('viLib', 'Customer') . ' ' . GxHtml::encode(GxHtml::valueEx($model,"ho_ten")); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'ma_khach_hang',
        'ho_ten',
        'ngay_sinh',
        'dia_chi',
        'thanh_pho',
        'dien_thoai',
        'email',
        'mo_ta',
        'diem_tich_luy',
        array(
            'name' => 'loaiKhachHang',
            'type' => 'raw',
            'value' => $model->loaiKhachHang->ten_loai,
        ),
    ),
)); ?>

