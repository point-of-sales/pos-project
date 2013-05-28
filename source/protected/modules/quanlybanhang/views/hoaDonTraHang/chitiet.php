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
array(
			'name' => 'id0',
			'type' => 'raw',
			'value' => $model->id0 !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->id0)), array('chungTu/view', 'id' => GxActiveRecord::extractPkValue($model->id0, true))) : null,
			),
'ly_do_tra_hang',
array(
			'name' => 'hoaDonBan',
			'type' => 'raw',
			'value' => $model->hoaDonBan !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->hoaDonBan)), array('hoaDonBanHang/view', 'id' => GxActiveRecord::extractPkValue($model->hoaDonBan, true))) : null,
			),
	),
)); ?>

<h2><?php echo GxHtml::encode($model->getRelationLabel('tblSanPhams')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->tblSanPhams as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('sanPham/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?>