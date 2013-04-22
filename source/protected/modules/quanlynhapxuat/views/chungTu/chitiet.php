<?php

$this->breadcrumbs = array(
	$model->label(2) => array('danhsach'),
	GxHtml::valueEx($model),
);

$this->menu=array(
array('label'=>Yii::t('viLib', 'List') . ' ' . $model->label(2), 'url'=>array('danhsach')),
array('label'=>Yii::t('viLib', 'Add') . ' ' . $model->label(), 'url'=>array('them')),
array('label'=>Yii::t('viLib', 'Update') . ' ' . $model->label(), 'url'=>array('capnhat', 'id' => $model->id)),
array('label'=>Yii::t('viLib', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('xoa', 'id' => $model->id), 'confirm'=>Yii::t('viLib','Are you sure you want to delete this item?'))),
);
?>


<h1><?php echo Yii::t('viLib', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'id',
'ma_chung_tu',
'ngay_lap',
'tri_gia',
'ghi_chu',
array(
			'name' => 'nhanVien',
			'type' => 'raw',
			'value' => $model->nhanVien !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->nhanVien)), array('nhanVien/view', 'id' => GxActiveRecord::extractPkValue($model->nhanVien, true))) : null,
			),
array(
			'name' => 'chiNhanh',
			'type' => 'raw',
			'value' => $model->chiNhanh !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->chiNhanh)), array('chiNhanh/view', 'id' => GxActiveRecord::extractPkValue($model->chiNhanh, true))) : null,
			),
	),
)); ?>

