<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Product management') => array('sanPham/danhsach'),
    Yii::t('viLib', 'Gift product') => array('sanPhamTang/danhsach'),
    Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Product'),
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'Create') . ' ' .Yii::t('viLib','Gift Product'), 'url' => array('them'),'visible'=>Yii::app()->user->checkAccess('Quanlysanpham.SanPhamTang.Them')),
    array('label' => Yii::t('viLib', 'Export') . ' ' . Yii::t('viLib', 'File Excel'), 'url' => array('xuat'),'visible'=>Yii::app()->user->checkAccess('Quanlysanpham.SanPhamTang.Them')),
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

    <h1><?php echo Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Gift product'); ?></h1>


    <div class="search-form">
        <?php $this->renderPartial('_search', array(
            'model' => $model,
        )); ?>
    </div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'grid',
    'dataProvider' => $model->search(),
    'columns' => array(
        'ma_vach',
        'ten_san_pham',
        array(
            'name'=>'gia_tang',
            'value'=>'number_format(floatval($data->gia_tang),0,".",",")',
        ),
        'thoi_gian_bat_dau',
        'thoi_gian_ket_thuc',
        array('name' => Yii::t('viLib', 'Instock'),
            'value' => 'number_format(floatval($data->layTongSoLuongTon()),0,".",",")',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => array(
                'view' => array(
                    'url' => 'Helpers::urlRouting(Yii::app()->controller,"","chitiet",array("id"=>$data->id))',
                    'label' => Yii::t('viLib', 'View'),
                ),
                'update' => array(
                    'url' => 'Helpers::urlRouting(Yii::app()->controller,"","capnhat",array("id"=>$data->id))',
                    'label' => Yii::t('viLib', 'Update'),
                ),
                'delete' => array(
                    'url' => 'Helpers::urlRouting(Yii::app()->controller,"","xoagrid",array("id"=>$data->id))',
                    'label' => Yii::t('viLib', 'Delete'),
                    'click' => Helpers::deleteButtonClick(),
                ),

            ),
        ),
    ),
)); ?>