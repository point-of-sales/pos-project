<?php

$this->breadcrumbs = array(
	$model->label(1),
	Yii::t('viLib', 'List'),
);

$this->menu = array(
array('label'=>Yii::t('viLib', 'Create') . ' ' . $model->label(), 'url'=>array('them')),
array('label'=>Yii::t('viLib', 'Export') . ' ' . $model->label(), 'url'=>array('xuat')),
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
		'id',
		'ma_chung_tu',
		'ngay_lap',
		'tri_gia',
		'ghi_chu',
		array(
				'name'=>'nhan_vien_id',
				'value'=>'GxHtml::valueEx($data->nhanVien)',
				'filter'=>GxHtml::listDataEx(NhanVien::model()->findAllAttributes(null, true)),
				),
		/*
		array(
				'name'=>'chi_nhanh_id',
				'value'=>'GxHtml::valueEx($data->chiNhanh)',
				'filter'=>GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true)),
				),
		*/
array(
    'class' => 'CButtonColumn',
    'template'=>'{view}{update}{delete}',
    'buttons'=>array(
            'view'=>array(
            'url'=>'Helpers::urlRouting(Yii::app()->controller,"","chitiet",array("id"=>$data->id))',
            'label'=>Yii::t('viLib','View'),
            ),
            'update'=>array(
            'url'=>'Helpers::urlRouting(Yii::app()->controller,"","capnhat",array("id"=>$data->id))',
            'label'=>Yii::t('viLib','Update'),
            ),
            'delete'=>array(
            'url'=>'Helpers::urlRouting(Yii::app()->controller,"","xoagrid",array("id"=>$data->id))',
            'label'=>Yii::t('viLib','Delete'),
            'click' => Helpers::deleteButtonClick(),
            ),

    ),
    ),
),
)); ?>