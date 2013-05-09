
<?php


$this->breadcrumbs = array(
    Yii::t('viLib','Import/Export management')=>array('chiNhanh/danhsach'),
    Yii::t('viLib', 'List') . ' ' . Yii::t('viLib','Branch'),
);

$this->menu = array(
array('label'=>Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Import form'),'url'=>array('phieuNhap/danhsach')),
array('label'=>Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Export form'),'url'=>array('phieuXuat/danhsach')),
array('label'=>Yii::t('viLib', 'Import product'), 'url'=>array('phieuNhap/them')),
array('label'=>Yii::t('viLib', 'Export product'), 'url'=>array('phieuXuat/them')),
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

array(
    'class' => 'CButtonColumn',
    'template'=>'{view}{import}{export}',
    'buttons'=>array(
        'view'=>array(
            'url'=>'Helpers::urlRouting(Yii::app()->controller,"chiNhanh","chitiet",array("id"=>$data->id))',
            'label'=>Yii::t('viLib','View'),
        ),
        'import'=>array(
            'url'=>'Helpers::urlRouting(Yii::app()->controller,"phieuNhap","them",array("id"=>$data->id))',
            'label'=>Yii::t('viLib','Import product'),
            'imageUrl'=>Yii::app()->theme->baseUrl . '/images/import_icon.png',
        ),
        'export'=>array(
            'url'=>'Helpers::urlRouting(Yii::app()->controller,"phieuXuat","them",array("id"=>$data->id))',
            'label'=>Yii::t('viLib','Export product'),
            'imageUrl'=>Yii::app()->theme->baseUrl . '/images/export_icon.png',
        ),

    ),
    ),
),
)); ?>



