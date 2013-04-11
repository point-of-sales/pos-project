<?php

$this->breadcrumbs = array(
    Yii::t('viLib','Branch management')=>array('chiNhanh/danhsach'),
    Yii::t('viLib','List')=>array('loaiChiNhanh/danhsach'),
    Yii::t('viLib','List') . ' ' . Yii::t('viLib','Branch type'),

);

$this->menu = array(
array('label'=>Yii::t('viLib', 'Create') . ' ' . $model->label(), 'url'=>array('them')),
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

<h1><?php echo Yii::t('viLib', 'List') . ' ' . GxHtml::encode($model->label(1)); ?></h1>


<div class="search-form">
    <?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<form action="xuat" method="get" id="hidden-form" name="hidden-form">
    <input type="hidden"  id="ma_loai_chi_nhanh" name="LoaiChiNhanh[ma_loai_chi_nhanh]">
    <input type="hidden"  id="ten_loai_chi_nhanh" name="LoaiChiNhanh[ten_loai_chi_nhanh]">
    <input type="submit"  class="button-no-style" value="Xuất sang Excel">
</form>


<?php $this->widget('zii.widgets.grid.CGridView', array(
'id' => 'grid',
'dataProvider' => $model->search(),
'columns' => array(
		'ma_loai_chi_nhanh',
		'ten_loai_chi_nhanh',
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


            var a = $('#yw0 input[id=LoaiChiNhanh_ma_loai_chi_nhanh]').val();
            var b = $('#yw0 input[id=LoaiChiNhanh_ten_loai_chi_nhanh]').val();


            //set default var
            $('#hidden-form input[id=ma_loai_chi_nhanh]').val('');
            $('#hidden-form input[id=ten_loai_chi_nhanh]').val('');
            if(a!='')
                $('#hidden-form input[id=ma_loai_chi_nhanh]').val($.trim(a));
            if(b!='')
                $('#hidden-form input[id=ten_loai_chi_nhanh]').val($.trim(b));


        }
    );

</script>
