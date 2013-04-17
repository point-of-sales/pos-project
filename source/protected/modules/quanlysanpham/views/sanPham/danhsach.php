<?php

$this->breadcrumbs = array(
	Yii::t('viLib', 'Product management')=>array('sanPham/danhsach'),
    Yii::t('viLib','Product')=>array('sanPham/danhsach'),
    Yii::t('viLib', 'List') . ' ' . Yii::t('viLib','Product'),
);

$this->menu = array(
array('label'=>Yii::t('viLib', 'List') . ' ' . Yii::t('viLib','Product type'), 'url'=>array('loaiSanPham/danhsach')),
array('label'=>Yii::t('viLib', 'Create') . ' ' . $model->label(), 'url'=>array('them')),
array('label'=>Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib','Product type'), 'url'=>array('loaiSanPham/them')),
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

<form action="xuat" method="get" id="hidden-form">
    <input type="hidden"  id="ma_vach" name="SanPham[ma_vach]">
    <input type="hidden"  id="ten_san_pham" name="SanPham[ten_san_pham]">
    <input type="hidden"  id="ten_tieng_viet" name="SanPham[ten_tieng_viet]">
    <input type="hidden"  id="trang_thai" name="SanPham[trang_thai]">
    <input type="hidden"  id="nha_cung_cap_id" name="SanPham[nha_cung_cap_id]">
    <input type="hidden"  id="loai_san_pham_id" name="SanPham[loai_san_pham_id]">
    <input type="hidden"  id="SanPham_tblChiNhanhs" name="SanPham[tblChiNhanhs]">
    <input type="submit"  class="button-no-style" value="Xuất sang Excel">
</form>

<?php $this->widget('zii.widgets.grid.CGridView', array(
'id' => 'grid',
'dataProvider' => $model->search(),
'columns' => array(
		'ma_vach',
		'ten_san_pham',
		'ten_tieng_viet',
        'trang_thai'=>array(
             'name'=>'trang_thai',
             'value'=>'$data->layTenTrangThai()',
        ),
        array(
            'name'=>'nha_cung_cap_id',
            'value'=>'GxHtml::valueEx($data->nhaCungCap)',
            'filter'=>GxHtml::listDataEx(NhaCungCap::model()->findAllAttributes(null, true)),
        ),
        array(
            'name'=>'loai_san_pham_id',
            'value'=>'GxHtml::valueEx($data->loaiSanPham)',
            'filter'=>GxHtml::listDataEx(LoaiSanPham::model()->findAllAttributes(null, true)),
        ),
        array('name'=>Yii::t('viLib','Current price'),
            'type'=>'raw',
            'value'=>'$data->layGiaHienTai()',
        ),


		/*
		'ton_toi_thieu',
		'huong_dan_su_dung',
		'mo_ta',


		*/
array(
    'class' => 'CButtonColumn',
    'template'=>'{view}{update}{delete}',
    'buttons'=>array(
            'view'=>array(
            'url'=>'Yii::app()->createUrl(Yii::app()->controller->module->id ."/". Yii::app()->controller->id ."/". "chitiet",array("id"=>$data->id))',
            'label'=>Yii::t('viLib','View'),
            ),
            'update'=>array(
            'url'=>'Yii::app()->createUrl(Yii::app()->controller->module->id ."/". Yii::app()->controller->id ."/". "capnhat",array("id"=>$data->id))',
            'label'=>Yii::t('viLib','Update'),
            ),
            'delete'=>array(
            'url'=>'Yii::app()->createUrl(Yii::app()->controller->module->id ."/". Yii::app()->controller->id ."/". "xoagrid",array("id"=>$data->id))',
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
            var a = $('#yw0 input[id=SanPham_ma_vach]').val();
            var b = $('#yw0 input[id=SanPham_ten_san_pham]').val();
            var c = $('#yw0 input[id=SanPham_ten_tieng_viet]').val();
            var d='';
            if($('#yw0 input[id=SanPham_trang_thai_0]').is(':checked')) {
                d = '0';
            }
            if($('#yw0 input[id=SanPham_trang_thai_1]').is(':checked')) {
                d = '1';
            }
            var e = $('#yw0 #SanPham_nha_cung_cap_id option:selected').val();
            var f = $('#yw0 #SanPham_loai_san_pham_id option:selected').val();
            var g = $('#yw0 #SanPham_tblChiNhanhs option:selected').val();

            //set default var
            $('#hidden-form input[id=ma_vach]').val('');
            $('#hidden-form input[id=ten_san_pham]').val('');
            $('#hidden-form input[id=ten_tieng_viet]').val('');
            $('#hidden-form input[id=trang_thai]').val('');
            $('#hidden-form input[id=nha_cung_cap_id]').val('');
            $('#hidden-form input[id=loai_san_pham_id]').val('');
            $('#hidden-form input[id=SanPham_tblChiNhanhs]').val('');

            if(a!='')
                $('#hidden-form input[id=ma_vach]').val($.trim(a));
            if(b!='')
                $('#hidden-form input[id=ten_san_pham]').val($.trim(b));
            if(c!='')
                $('#hidden-form input[id=ten_tieng_viet]').val($.trim(c));
            if(d!='')
                $('#hidden-form input[id=trang_thai]').val($.trim(d));
            if(e!='')
                $('#hidden-form input[id=nha_cung_cap_id]').val($.trim(e));
            if(f!='')
                $('#hidden-form input[id=loai_san_pham_id]').val($.trim(f));
            if(g!='') {
                $('#hidden-form input[id=SanPham_tblChiNhanhs]').val($.trim(g));
            }


        }
    );

</script>

