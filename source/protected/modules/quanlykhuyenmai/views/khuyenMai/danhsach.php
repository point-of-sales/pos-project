<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Promotion management') => array('khuyenMai/danhsach'),
    Yii::t('viLib', 'Promotion') => array('khuyenMai/danhsach'),
    Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Promotion'),
);

if (RightsWeight::getRoleWeight(Yii::app()->user->id) == 999) {
    $this->menu = array(
        array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Promotion'), 'url' => array('them')),
        array('label' => Yii::t('viLib', 'Promotion') . ' ' . Yii::t('viLib', 'Product'), 'url' => array('khuyenmaisanpham')),
        array('label' => Yii::t('viLib', 'Export') . ' ' . Yii::t('viLib', 'Promotion'), 'url' => array('xuat')),

    );
}

Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('grid', {
data: $(this).serialize()
});
return false;
});
");
?>

    <h1><?php echo Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Promotion'); ?></h1>


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
        'ma_chuong_trinh',
        'ten_chuong_trinh',
        'gia_giam',
        'thoi_gian_bat_dau',

        'thoi_gian_ket_thuc',
        array('name' => Yii::t('viLib', 'Status'),
            'value' => '$data->layTenTrangThai()',
        ),

        array(
            'name' => Yii::t('viLib', 'Approve branch'),
            'value' => '$data->layDanhSachChiNhanh()',
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