<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('viLib', 'Manage'),
);

$this->menu = array(
		array('label'=>Yii::t('viLib', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
		array('label'=>Yii::t('viLib', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('hoa-don-ban-hang-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('viLib', 'Manage') . ' ' . GxHtml::encode($model->label(2)); ?></h1>

<p>
You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo GxHtml::link(Yii::t('viLib', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'hoa-don-ban-hang-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		array(
				'name'=>'id',
				'value'=>'GxHtml::valueEx($data->id0)',
				'filter'=>GxHtml::listDataEx(ChungTu::model()->findAllAttributes(null, true)),
				),
		'chiet_khau',
		'khach_hang_id',
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>