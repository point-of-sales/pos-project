<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->id)),
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'id',
'ma_vach',
'ten_san_pham',
'ten_tieng_viet',
'han_dung',
'don_vi_tinh',
'ton_toi_thieu',
'huong_dan_su_dung',
'mo_ta',
'trang_thai',
array(
			'name' => 'nhaCungCap',
			'type' => 'raw',
			'value' => $model->nhaCungCap !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->nhaCungCap)), array('nhaCungCap/view', 'id' => GxActiveRecord::extractPkValue($model->nhaCungCap, true))) : null,
			),
array(
			'name' => 'loaiSanPham',
			'type' => 'raw',
			'value' => $model->loaiSanPham !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->loaiSanPham)), array('loaiSanPham/view', 'id' => GxActiveRecord::extractPkValue($model->loaiSanPham, true))) : null,
			),
	),
)); ?>

<h2><?php echo GxHtml::encode($model->getRelationLabel('tblHoaDonBanHangs')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->tblHoaDonBanHangs as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('hoaDonBanHang/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?><h2><?php echo GxHtml::encode($model->getRelationLabel('tblHoaDonTraHangs')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->tblHoaDonTraHangs as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('hoaDonTraHang/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?><h2><?php echo GxHtml::encode($model->getRelationLabel('tblPhieuNhaps')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->tblPhieuNhaps as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('phieuNhap/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?><h2><?php echo GxHtml::encode($model->getRelationLabel('tblPhieuXuats')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->tblPhieuXuats as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('phieuXuat/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?><h2><?php echo GxHtml::encode($model->getRelationLabel('tblChiNhanhs')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->tblChiNhanhs as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('chiNhanh/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?>