<?php
$this->breadcrumbs = array(
    Yii::t('viLib', 'Import/Export management') => array('chiNhanh/danhsach'),
    Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Export form'),
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Export form'), 'url' => array('them')),

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

    <h1><?php echo Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Export form'); ?></h1>


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
        array(
            'name' => 'id',
            'value' => 'GxHtml::valueEx($data->chungTu)',
            'filter' => GxHtml::listDataEx(ChungTu::model()->findAllAttributes(null, true)),
        ),
        array(
            'name' => Yii::t('viLib','Created date'),
            'value' => '$data->getBaseModel()->ngay_lap'
        ),

        'loai_xuat_ra',
        array(
            'name' => 'chi_nhanh_nhap_id',
            'value' => 'GxHtml::valueEx($data->chiNhanhNhap)',
            'filter' => GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true)),
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}',
            'buttons' => array(
                'view' => array(
                    'url' => 'Helpers::urlRouting(Yii::app()->controller,"","chitiet",array("id"=>$data->id))',
                    'label' => Yii::t('viLib', 'View'),
                ),

            ),
        ),
    ),
)); ?>