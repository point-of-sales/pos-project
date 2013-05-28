<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Customer management') => array('khachHang/danhsach'),
    Yii::t('viLib', 'Customer type') => array('loaiKhachHang/danhsach'),
    Yii::t('viLib', 'Detail') => array(),
    GxHtml::valueEx($model,"ten_loai"),
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Customer type'), 'url' => array('danhsach'),'visible'=>Yii::app()->user->checkAccess('Quanlykhachhang.LoaiKhachHang.DanhSach')),
    array('label' => Yii::t('viLib', 'Add') . ' ' . Yii::t('viLib', 'Customer type'), 'url' => array('them'),'visible'=>Yii::app()->user->checkAccess('Quanlykhachhang.LoaiKhachHang.Them')),
    array('label' => Yii::t('viLib', 'Update') . ' ' . Yii::t('viLib', 'Customer type'), 'url' => array('capnhat', 'id' => $model->id),'visible'=>Yii::app()->user->checkAccess('Quanlykhachhang.LoaiKhachHang.CapNhat')),
    array('label' => Yii::t('viLib', 'Delete') . ' ' . Yii::t('viLib', 'Customer type'), 'url' => '#', 'linkOptions' => array('submit' => array('xoa', 'id' => $model->id), 'confirm' => Yii::t('viLib', 'Are you sure you want to delete this item?')),'visible'=>Yii::app()->user->checkAccess('Quanlykhachhang.LoaiKhachHang.Xoa')),
);
?>


    <h1><?php echo Yii::t('viLib', 'View') . ' ' . Yii::t('viLib', 'Customer type') . ' ' . GxHtml::encode(GxHtml::valueEx($model,"ten_loai")); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'ma_loai_khach_hang',
        'ten_loai',
    ),
)); ?>

    <!--<h2><?php /*echo GxHtml::encode($model->getRelationLabel('khachHangs')); */?></h2>
--><?php
/*	echo GxHtml::openTag('ul');
	foreach($model->khachHangs as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('khachHang/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
*/
?>