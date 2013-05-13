<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Product management') => array('sanPham/danhsach'),
    Yii::t('viLib', 'Product') => array('sanPham/danhsach'),
    Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Product'),
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Gift product'), 'url' => array('sanPhamTang/danhsach')),
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Product type'), 'url' => array('loaiSanPham/danhsach')),
    array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Product'), 'url' => array('them')),
    array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Gift product'), 'url' => array('sanPhamTang/them')),
    array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Product type'), 'url' => array('loaiSanPham/them')),
    array('label' => Yii::t('viLib', 'Export') . ' ' . Yii::t('viLib', 'File Excel'), 'url' => array('xuat')),
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

<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'grid',
    'dataProvider' => $model->search(),
    'columns' => array(
        'ma_vach',
        'ten_san_pham',
        array(
            'name' => 'nha_cung_cap_id',
            'value' => '$data->nhaCungCap->ten_nha_cung_cap',
        ),
        array(
            'name' => 'loai_san_pham_id',
            'value' => '$data->loaiSanPham->ten_loai',
        ),

        array('name' => Yii::t('viLib', 'Base price'),
            'type' => 'raw',
            'value' => '$data->gia_goc',
        ),

        array('name' => Yii::t('viLib', 'Current price'),
            'type' => 'raw',
            'value' => '$data->layGiaHienTai()',
        ),

        array('name' => Yii::t('viLib', 'Promotion'),
            'type' => 'raw',
            'value' => '($data->khuyen_mai_id!=null)?(CHtml::image(Yii::app()->theme->baseUrl . "/images/promo.png") ."  ".$data->khuyenMai->ten_chuong_trinh):null',
        ),
        'trang_thai' => array(
            'name' => 'trang_thai',
            'value' => '$data->layTenTrangThai()',
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



