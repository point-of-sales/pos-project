<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Config management') => array('cauHinh/chitiet/id/1'),
    Yii::t('viLib', 'Company Information') => array('thongTinCongTy/chitiet/id/1'),
    GxHtml::valueEx($model),
);

$this->menu = array(

    array('label' => Yii::t('viLib', 'Update') . ' ' . Yii::t('viLib','Company Information'), 'url' => array('capnhat', 'id' => $model->id),'visible'=>Yii::app()->user->checkAccess('Quanlycauhinh.ThongTinCongTy.CapNhat')),
    array('label' => Yii::t('viLib', 'View') . ' ' . Yii::t('viLib','Config'), 'url'=>array('cauHinh/chitiet', 'id' => GxActiveRecord::extractPkValue($model, true)),'visible'=>Yii::app()->user->checkAccess('Quanlycauhinh.CauHinh.ChiTiet')),

);
?>


<h1><?php echo Yii::t('viLib', 'View') . ' ' . Yii::t('viLib','Company Information') . ' ' . $model->ten_cong_ty; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'ten_cong_ty',
        'dia_chi',
        'dien_thoai',
        'fax',
        'email',
        'website',
    ),
)); ?>

