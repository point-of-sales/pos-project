<?php
$this->breadcrumbs = array(
	'Quản lý bán hàng' => array('hoaDonBanHang/danhsach'),
    'Danh sách hóa đơn bán',
);

$this->menu = array(
array('label'=>Yii::t('viLib', 'Create') . ' ' . 'Hóa đơn bán hàng', 'url'=>array('them')),
array('label'=>Yii::t('viLib', 'List') . ' ' . 'Hóa đơn trả hàng', 'url'=>array('hoaDonTraHang/danhsach')),
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

<h1><?php echo Yii::t('viLib', 'List') . ' ' . 'Hóa Đơn Bán Hàng' ?></h1>


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
				'name'=>'Mã chứng từ',
				'value'=>'GxHtml::valueEx($data->chungTu)',
				'filter'=>GxHtml::listDataEx(ChungTu::model()->findAllAttributes(null, true)),
				),
        array(
            'name'=>'Khách hàng',
            //'value'=>'GxHtml::valueEx($data->khachHang)." --- ".$data->khachHang["ho_ten"]',
			//'filter'=>GxHtml::listDataEx(KhachHang::model()->findAllAttributes(null, true)),
            'value'=>array($this,'gridKhachHang'),
            'type'=>'raw',
        ),
        array(
            'name'=>'Ngày lập',
            'value' => 'date("d/m/Y - h:i:s",strtotime($data->getBaseModel()->ngay_lap))',
        ),
        array(
            'name'=>'Số SP gốc',
            'value' => 'count($data->chiTietHoaDonBan)',
            'htmlOptions'=>array('class'=>'center'),
        ),
        array(
            'name'=>'Trị giá gốc',
            'value' => '$data->getBaseModel()->tri_gia'
        ),
        array(
            'name'=>'Số SP thực',
            'value' => array($this,'gridSoSanPhamThuc'),
            'htmlOptions'=>array('class'=>'center'),
        ),
        array(
            'name'=>'Trị giá thực',
            'value' => array($this,'gridTriGiaThuc'),
        ),
        array(
            'name'=>'Có HĐ trả',
            'type'=>'raw',
            'value'=>array($this,'gridCoHoaDonTra'),
            'htmlOptions'=>array('class'=>'center'),
        ),
    array(
        'class' => 'CButtonColumn',
        'template'=>'{view}{print}{return}',
        'buttons'=>array(
            'view'=>array(
                'url'=>'Helpers::urlRouting(Yii::app()->controller,"","chitiet",array("id"=>$data->id))',
                'label'=>Yii::t('viLib','View'),
            ),
            'print'=>array(
                'url'=>'Helpers::urlRouting(Yii::app()->controller,"","hoadon",array("id"=>$data->id))',
                //'url'=>'Yii::app()->createUrl("hoaDonBanHang/hoadon",array("id"=>$data->id,"target"=>"_blank"))',
                'imageUrl'=>Yii::app()->theme->baseUrl . '/images/icons/print.png',
                'options'=>array('target'=>'_blank'),
            ),
            'return'=>array(
                'url'=>'Helpers::urlRouting(Yii::app()->controller,"","trahang",array("id"=>$data->id))',
                'label'=>'Trả Hàng',
                'imageUrl'=>Yii::app()->theme->baseUrl . '/images/icons/return.png',
            ),
        ),
    ),
),
)); ?>

<script type="text/javascript">
$(document).ready(function(){
    var url = location.href;
    var index = url.indexOf('hoaDonBanHang');
    url = url.substring(0,index) + 'hoaDonTraHang/';
    $.ajax({
        url:url+'inhoadon',
        type:"POST",
        //async:false,
        success:function(data){
            if(data!='false'){
                window.open(url+'hoadontra/id/'+data);   
            }
        }
    });
});
</script>