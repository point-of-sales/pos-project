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
'thoi_gian_bat_dau',
'thoi_gian_ket_thuc',
'gia_ban',
array(
			'name' => 'sanPham',
			'type' => 'raw',
			'value' => $model->sanPham !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->sanPham)), array('sanPham/view', 'id' => GxActiveRecord::extractPkValue($model->sanPham, true))) : null,
			),
	),
)); ?>

