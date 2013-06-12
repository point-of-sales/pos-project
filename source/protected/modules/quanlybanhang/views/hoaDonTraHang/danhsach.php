<?php

$this->breadcrumbs = array(
	'Quản lý bán hàng' => array('hoaDonBanHang/danhsach'),
	'Danh sách hóa đơn trả',
);

$this->menu = array(
array('label'=>Yii::t('viLib', 'Export') . ' ' . $model->label(), 'url'=>array('xuatfileexceldanhsachhoadontra')),
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

<h1><?php echo Yii::t('viLib', 'List') . ' ' . 'Hóa Đơn Trả Hàng'; ?></h1>


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
				'name'=>'Mã HĐ trả',
				'value'=>'GxHtml::valueEx($data->id0)',
				'filter'=>GxHtml::listDataEx(ChungTu::model()->findAllAttributes(null, true)),
				),
        array(
            'name'=>'Mã HĐ bán',
            'value' => '$data->hoaDonBan->getBaseModel()->ma_chung_tu',
        ),
        array(
            'name'=>'Khách hàng',
            'value'=>array($this,'gridKhachHang'),
            'type'=>'raw',
        ),
        array(
            'name'=>'Lý do trả hàng',
            'value'=>'$data->ly_do_tra_hang',
        ),
        array(
            'name'=>'Ngày lập',
            'value' => 'date("d/m/Y - h:i:s",strtotime($data->getBaseModel()->ngay_lap))',
        ),
array(
    'class' => 'CButtonColumn',
    'template'=>'{view}{print}',
    'buttons'=>array(
            'view'=>array(
            'url'=>'Helpers::urlRouting(Yii::app()->controller,"","chitiet",array("id"=>$data->id))',
            'label'=>Yii::t('viLib','View'),
            ),
            'print'=>array(
                'url'=>'Helpers::urlRouting(Yii::app()->controller,"","hoadontra",array("id"=>$data->id,"p"=>"false"))',
                //'url'=>'Yii::app()->createUrl("hoaDonBanHang/hoadon",array("id"=>$data->id,"target"=>"_blank"))',
                'imageUrl'=>Yii::app()->theme->baseUrl . '/images/icons/print.png',
                'options'=>array('target'=>'_blank'),
            ),
    ),
    ),
),
)); ?>