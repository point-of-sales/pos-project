<?php

$this->breadcrumbs = array(
    Yii::t('viLib','Branch management')=>array('chiNhanh/danhsach'),
    Yii::t('viLib','Branch')=>array('chiNhanh/danhsach'),
    Yii::t('viLib', 'List') . ' ' . Yii::t('viLib','Branch'),
);

$this->menu = array(
array('label'=>Yii::t('viLib', 'List') . ' ' . Yii::t('viLib','Areas') . ' ', 'url'=>array('khuVuc/danhsach')),
array('label'=>Yii::t('viLib', 'List') . ' ' . Yii::t('viLib','Branch Type') . ' ', 'url'=>array('loaiChiNhanh/danhsach')),
array('label'=>Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib',$model->label(1)), 'url'=>array('them')),
array('label'=>Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib','Area') . ' ', 'url'=>array('khuVuc/them')),
array('label'=>Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib','Branch Type') . ' ', 'url'=>array('loaiChiNhanh/them')),
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
		'ma_chi_nhanh',
		'ten_chi_nhanh',
		'dia_chi',
        'trang_thai'=>array(
        'name'=>'trang_thai',
        'value'=>'$data->layTenTrangThai()'
    ),
		/*
		'mo_ta',

		array(
				'name'=>'truc_thuoc_id',
				'value'=>'GxHtml::valueEx($data->trucThuoc)',
				'filter'=>GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'khu_vuc_id',
				'value'=>'GxHtml::valueEx($data->khuVuc)',
				'filter'=>GxHtml::listDataEx(KhuVuc::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'loai_chi_nhanh_id',
				'value'=>'GxHtml::valueEx($data->loaiChiNhanh)',
				'filter'=>GxHtml::listDataEx(LoaiChiNhanh::model()->findAllAttributes(null, true)),
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
            'click' =>Helpers::deleteButtonClick(),
        ),

    ),
    ),
),
)); ?>



