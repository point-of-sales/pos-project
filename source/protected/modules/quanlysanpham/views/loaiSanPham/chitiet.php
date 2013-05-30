<?php if (Yii::app()->user->hasFlash('info-board')) { ?>
    <div class="response-msg error ui-corner-all info-board">
        <?php echo Yii::app()->user->getFlash('info-board'); ?>
    </div>
<?php } ?>


<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Product management') => array('sanPham/danhsach'),
    Yii::t('viLib', 'Product type') => array('loaiSanPham/danhsach'),
    Yii::t('viLib', 'Detail') => array(),
    GxHtml::valueEx($model, "ten_loai"),

);

$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Product type'), 'url' => array('danhsach'), 'visible' => Yii::app()->user->checkAccess('Quanlysanpham.LoaiSanPham.DanhSach')),
    array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Product type'), 'url' => array('them'), 'visible' => Yii::app()->user->checkAccess('Quanlysanpham.LoaiSanPham.Them')),
    array('label' => Yii::t('viLib', 'Update') . ' ' . Yii::t('viLib', 'Product type'), 'url' => array('capnhat', 'id' => $model->id), 'visible' => Yii::app()->user->checkAccess('Quanlysanpham.LoaiSanPham.CapNhat')),
    array('label' => Yii::t('viLib', 'Delete') . ' ' . Yii::t('viLib', 'Product type'), 'url' => '#', 'linkOptions' => array('submit' => array('xoa', 'id' => $model->id), 'confirm' => Yii::t('viLib', 'Are you sure you want to delete this item?')), 'visible' => Yii::app()->user->checkAccess('Quanlysanpham.LoaiSanPham.Xoa')),
);
?>


    <h1><?php echo Yii::t('viLib', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model, "ten_loai")); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'ma_loai',
        'ten_loai',
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