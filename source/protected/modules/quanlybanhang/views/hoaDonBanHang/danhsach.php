<?php
$this->breadcrumbs = array(
	$model->label(1),
	Yii::t('viLib', 'List'),
);

$this->menu = array(
array('label'=>Yii::t('viLib', 'Create') . ' ' . $model->label(), 'url'=>array('them')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1><?php echo Yii::t('viLib', 'List') . ' ' . GxHtml::encode($model->label(2)); ?></h1>


<div class="search-form">
    <?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
'id' => 'grid',
'dataProvider' => $model->search(),
'columns' => array(
		array(
				'name'=>'Mã chứng từ',
				'value'=>'GxHtml::valueEx($data->chungTu)',
				'filter'=>GxHtml::listDataEx(ChungTu::model()->findAllAttributes(null, true)),
				),
        array(
            'name'=>'Khách hàng',
            'value'=>'GxHtml::valueEx($data->khachHang)." --- ".$data->khachHang["ho_ten"]',
			'filter'=>GxHtml::listDataEx(KhachHang::model()->findAllAttributes(null, true)),
        ),
        array(
            'name'=>'Ngày lập',
            'value' => '$data->getBaseModel()->ngay_lap'
        ),
        array(
            'name'=>'Trị giá',
            'value' => '$data->getBaseModel()->tri_gia'
        ),
array(
    'class' => 'CButtonColumn',
    'template'=>'{view}',
    'buttons'=>array(
        'view'=>array(
            'url'=>'Helpers::urlRouting(Yii::app()->controller,"","chitiet",array("id"=>$data->id))',
            'label'=>Yii::t('viLib','View'),
        ),
    ),
    ),
),
)); ?>