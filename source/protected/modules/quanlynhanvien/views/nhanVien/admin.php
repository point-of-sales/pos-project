<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('viLib', 'Manage'),
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
	$.fn.yiiGridView.update('nhan-vien-grid', {
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
	'id' => 'nhan-vien-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
		'ma_nhan_vien',
		'ho_ten',
		'email',
		'dien_thoai',
		'dia_chi',
		/*
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
				'name'=>'loai_nhan_vien_id',
				'value'=>'GxHtml::valueEx($data->loaiNhanVien)',
				'filter'=>GxHtml::listDataEx(LoaiNhanVien::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'chi_nhanh_id',
				'value'=>'GxHtml::valueEx($data->chiNhanh)',
				'filter'=>GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true)),
				),
		*/
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>