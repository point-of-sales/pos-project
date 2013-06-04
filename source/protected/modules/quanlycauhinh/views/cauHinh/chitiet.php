<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Config management') => array('cauHinh/chitiet/id/1'),
    Yii::t('viLib', 'Config') => array('cauHinh/chitiet/id/1'),
    Yii::t('viLib', 'Current Config'),
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'Update') . ' ' . Yii::t('viLib','Config'), 'url' => array('capnhat', 'id' => $model->id),'visible'=>Yii::app()->user->checkAccess('Quanlycauhinh.CauHinh.CapNhat')),
    array('label' => Yii::t('viLib', 'View') . ' ' . Yii::t('viLib', 'Company Information'), 'url' => array('thongTinCongTy/chitiet', 'id' => 1),Yii::app()->user->checkAccess('Quanlycauhinh.ThongTinCongTy.ChiTiet')),
);
?>


<h1><?php echo Yii::t('viLib', 'View') . ' ' . Yii::t('viLib','Config'); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'so_muc_tin_tren_trang',
        'so_luong_ton_canh_bao',
        'so_ngay_canh_bao_sinh_nhat_khach_hang',
        'email_ho_tro',
    ),
)); ?>

