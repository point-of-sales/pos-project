<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Employee management') => array('nhanVien/danhsach'),
    Yii::t('viLib', 'Employee type') => array('loaiNhanVien/danhsach'),
    Yii::t('viLib', 'Detail') => array(),
    GxHtml::valueEx($model),
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Employee type'), 'url' => array('danhsach')),
    array('label' => Yii::t('viLib', 'Add') . ' ' . Yii::t('viLib', 'Employee type'), 'url' => array('them')),
    array('label' => Yii::t('viLib', 'Update') . ' ' . Yii::t('viLib', 'Employee type'), 'url' => array('capnhat', 'id' => $model->id)),
    array('label' => Yii::t('viLib', 'Delete') . ' ' . Yii::t('viLib', 'Employee type'), 'url' => '#', 'linkOptions' => array('submit' => array('xoa', 'id' => $model->id), 'confirm' => Yii::t('viLib', 'Are you sure you want to delete this item?'))),
);
?>


<h1><?php echo Yii::t('viLib', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'ma_loai_nhan_vien',
        'ten_loai',
    ),
)); ?>