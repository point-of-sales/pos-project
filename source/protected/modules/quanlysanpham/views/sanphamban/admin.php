<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
		array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
		array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('san-pham-ban-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)); ?></h1>

<p>
You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'san-pham-ban-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
		'ma_vach',
		'ten_san_pham',
		'ten_tieng_viet',
		'han_dung',
		'don_vi_tinh',
		/*
		'ton_toi_thieu',
		'huong_dan_su_dung',
		'mo_ta',
		'trang_thai',
		array(
				'name'=>'nha_cung_cap_id',
				'value'=>'GxHtml::valueEx($data->nhaCungCap)',
				'filter'=>GxHtml::listDataEx(NhaCungCap::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'loai_san_pham_id',
				'value'=>'GxHtml::valueEx($data->loaiSanPham)',
				'filter'=>GxHtml::listDataEx(LoaiSanPham::model()->findAllAttributes(null, true)),
				),
		*/
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>