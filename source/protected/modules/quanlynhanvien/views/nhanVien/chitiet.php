<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('them')),
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('capnhat', 'id' => $model->id)),
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('danhsach')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'id',
'ma_nhan_vien',
'ho_ten',
'email',
'dien_thoai',
'dia_chi',
'gioi_tinh',
'ngay_sinh',
'trinh_do',
'luong_co_ban',
'chuyen_mon',
'trang_thai',
'mat_khau',
'ngay_vao_lam',
'lan_dang_nhap_cuoi',
array(
			'name' => 'loaiNhanVien',
			'type' => 'raw',
			'value' => $model->loaiNhanVien !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->loaiNhanVien)), array('loaiNhanVien/view', 'id' => GxActiveRecord::extractPkValue($model->loaiNhanVien, true))) : null,
			),
array(
			'name' => 'chiNhanh',
			'type' => 'raw',
			'value' => $model->chiNhanh !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->chiNhanh)), array('chiNhanh/view', 'id' => GxActiveRecord::extractPkValue($model->chiNhanh, true))) : null,
			),
	),
)); ?>

<h2><?php echo GxHtml::encode($model->getRelationLabel('chungTus')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->chungTus as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('chungTu/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?><h2><?php echo GxHtml::encode($model->getRelationLabel('tblQuyens')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->tblQuyens as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('quyen/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?>