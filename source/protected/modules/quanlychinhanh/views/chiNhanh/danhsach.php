<?php

$this->breadcrumbs = array(
	$model->label(1),
	Yii::t('viLib', 'List'),
);

$this->menu = array(
array('label'=>Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib',$model->label(1)), 'url'=>array('them')),
//array('label'=>Yii::t('viLib', 'Export') . ' ' . Yii::t('viLib','list') . ' ' . $model->label(), 'url'=>array('xuat')),


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

<form action="xuat" method="post" id="hidden-form">
    <input type="hidden"  id="ma_chi_nhanh" name="ma_chi_nhanh">
    <input type="hidden"  id="ten_chi_nhanh" name="ten_chi_nhanh">
    <input type="hidden"  id="trang_thai" name="trang_thai">
    <input type="hidden"  id="truc_thuoc_id" name="truc_thuoc_id">
    <input type="hidden"  id="khu_vuc_id" name="khu_vuc_id">
    <input type="submit"  class="button-no-style" value="Xuất sang Excel">
</form>


<?php $this->widget('zii.widgets.grid.CGridView', array(
'id' => 'grid',
'dataProvider' => $model->search(),
'columns' => array(
		'id',
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
            'url'=>'Yii::app()->createUrl(Yii::app()->controller->module->id .DIRECTORY_SEPARATOR. Yii::app()->controller->id .DIRECTORY_SEPARATOR. "chitiet",array("id"=>$data->id))',
            'label'=>Yii::t('viLib','View'),
            ),
            'update'=>array(
            'url'=>'Yii::app()->createUrl(Yii::app()->controller->module->id .DIRECTORY_SEPARATOR. Yii::app()->controller->id .DIRECTORY_SEPARATOR. "capnhat",array("id"=>$data->id))',
            'label'=>Yii::t('viLib','Update'),
            ),
            'delete'=>array(
            'url'=>'Yii::app()->createUrl(Yii::app()->controller->module->id .DIRECTORY_SEPARATOR. Yii::app()->controller->id .DIRECTORY_SEPARATOR. "xoagrid",array("id"=>$data->id))',
            'label'=>Yii::t('viLib','Delete'),
            'click' => "js:function(){

                    var r = confirm('Bạn có muốn xóa không ?');
                    if(r) {
                        var url = $(this).attr('href');
                         $.fn.yiiGridView.update('grid', {  //change my-grid to your grid's name
                         type:'POST',
                         url:$(this).attr('href'),
                         success:function(data) {
                            if(jQuery.type(data) == 'string' && data!='') {
                                $('.search-form').after(
                                    '<div class=error>'+data+'</div>'
                            );
                            $('.error').addClass('response-msg');
                            $('.error').addClass('ui-corner-all')
                            $('.error').fadeOut(5000);
                         }

                         $.fn.yiiGridView.update('grid'); //change my-grid to your grid's name
                    }
                    })
                        return false;
                    } else {
                        return false;
                        }
                    }",
            ),

    ),
    ),
),
)); ?>


<script>
    $('#yw0').submit(function(){
        var a = $('#yw0 input[id=ChiNhanh_ma_chi_nhanh]').val();
        var b = $('#yw0 input[id=ChiNhanh_ten_chi_nhanh]').val();
        var c='';
        if($('#yw0 input[id=ChiNhanh_trang_thai_0]').is(':checked')) {
            c = '0';
        } else {
            c = '1';
        }
        var d = $('#yw0 #ChiNhanh_truc_thuoc_id option:selected').val();
        var e = $('#yw0 #ChiNhanh_khu_vuc_id option:selected').val();

        //set default var
        $('#hidden-form input[id=ma_chi_nhanh]').val('');
        $('#hidden-form input[id=ten_chi_nhanh]').val('');
        $('#hidden-form input[id=trang_thai]').val('');
        $('#hidden-form input[id=truc_thuoc_id]').val('');
        $('#hidden-form input[id=khu_vuc_id]').val('');
        if(a!='')
            $('#hidden-form input[id=ma_chi_nhanh]').val($.trim(a));
        if(b!='')
            $('#hidden-form input[id=ten_chi_nhanh]').val($.trim(b));
        if(c!='')
            $('#hidden-form input[id=trang_thai]').val($.trim(c));
        if(d!='')
            $('#hidden-form input[id=truc_thuoc_id]').val($.trim(d));
        if(e!='')
            $('#hidden-form input[id=khu_vuc_id]').val($.trim(e));
        }
    );

</script>

