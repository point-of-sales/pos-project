<?php

$this->breadcrumbs = array(
    Yii::t('viLib','Branch management')=>array('chiNhanh/danhsach'),
    Yii::t('viLib','List')=>array('loaiChiNhanh/danhsach'),
    Yii::t('viLib','List') . ' ' . Yii::t('viLib','Branch type'),

);

$this->menu = array(
array('label'=>Yii::t('viLib', 'Create') . ' ' . $model->label(), 'url'=>array('them')),
    array('label'=>Yii::t('viLib', 'Export') . ' ' . Yii::t('viLib','File Excel'), 'url'=>array('xuat')),
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

<h1><?php echo Yii::t('viLib', 'List') . ' ' . GxHtml::encode($model->label(1)); ?></h1>


<div class="search-form">
    <?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->


<?php $this->widget('zii.widgets.grid.CGridView', array(
'id' => 'grid',
'dataProvider' => $model->search(),
'columns' => array(
		'ma_loai_chi_nhanh',
		'ten_loai_chi_nhanh',
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
            'click' =>Helpers::deleteButtonClick(),
        ),

    ),
    ),
),
)); ?>
