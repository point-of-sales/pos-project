<?php
/**
 * User: ${Cristazn}
 * Date: 5/9/13
 * Time: 12:58 AM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980
 */
$this->breadcrumbs = array(
    Yii::t('viLib', 'Promotion management') => array('khuyenMai/danhsach'),
    Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Promotion') . ' ' . Yii::t('viLib', 'Product') => array('khuyenMai/danhsach'),
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Promotion'), 'url' => array('them')),
    array('label' => Yii::t('viLib', 'Export') . ' ' . Yii::t('viLib', 'Promotion'), 'url' => array('xuat')),

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

    <h1><?php echo Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Promotion product'); ?></h1>


<?php

$this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'grid',
        'dataProvider' => $sanPhamProvider,
        'columns' => array(
            'ma_vach',
            'ten_san_pham',
            array('name' => Yii::t('viLib', 'Status'),
                'value' => '$data->layTenTrangThai()',
            ),
            array('name' => Yii::t('viLib', 'Supplier'),
                'value' => '$data->nhaCungCap->ten_nha_cung_cap',
            ),
            array('name'=>'khuyen_mai_id',
                  'value'=>'GxHtml::dropDownList($data->'
            ),

        ),

    )
);