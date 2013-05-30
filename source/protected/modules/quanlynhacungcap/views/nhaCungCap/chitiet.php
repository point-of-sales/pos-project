<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Supplier management') => array('nhaCungCap/danhsach'),
    Yii::t('viLib', 'Supplier') => array('nhaCungCap/danhsach'),
    Yii::t('viLib', 'Detail') => array(),
    GxHtml::valueEx($model, "ten_nha_cung_cap"),

);

$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Supplier'), 'url' => array('danhsach'), 'visible' => Yii::app()->user->checkAccess('Quanlynhacungcap.NhaCungCap.DanhSach')),
    array('label' => Yii::t('viLib', 'Add') . ' ' . Yii::t('viLib', 'Supplier'), 'url' => array('them'), 'visible' => Yii::app()->user->checkAccess('Quanlynhacungcap.NhaCungCap.Them')),
    array('label' => Yii::t('viLib', 'Update') . ' ' . Yii::t('viLib', 'Supplier'), 'url' => array('capnhat', 'id' => $model->id), 'visible' => Yii::app()->user->checkAccess('Quanlynhacungcap.NhaCungCap.CapNhat')),
    array('label' => Yii::t('viLib', 'Delete') . ' ' . Yii::t('viLib', 'Supplier'), 'url' => '#', 'linkOptions' => array('submit' => array('xoa', 'id' => $model->id), 'confirm' => Yii::t('viLib', 'Are you sure you want to delete this item?')), 'visible' => Yii::app()->user->checkAccess('Quanlynhacungcap.NhaCungCap.ChiTiet')),
);
?>


    <h1><?php echo Yii::t('viLib', 'View') . ' ' . Yii::t('viLib', 'Supplier') . ' ' . GxHtml::encode(GxHtml::valueEx($model, "ten_nha_cung_cap")); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'ma_nha_cung_cap',
        'ten_nha_cung_cap',
        'mo_ta',
        'dien_thoai',
        'email',
        'fax',
        array(
            'name' => 'trang_thai',
            'value' => $model->layTenTrangThai(),
        )
    ),
)); ?>

    <!--<h2><?php /*echo GxHtml::encode($model->getRelationLabel('sanPhams')); */?></h2>
--><?php
/*	echo GxHtml::openTag('ul');
	foreach($model->sanPhams as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('sanPham/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
*/
?>