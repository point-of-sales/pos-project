<?php

$this->breadcrumbs = array(
    Yii::t('viLib','Branch management')=>array('chiNhanh/danhsach'),
    Yii::t('viLib','Area')=>array('khuVuc/danhsach'),
    Yii::t('viLib','List') . ' ' . Yii::t('viLib','Area'),
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

<h1><?php echo Yii::t('viLib', 'List') . ' ' . GxHtml::encode($model->label(2)); ?></h1>


<div class="search-form">
    <?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<form action="xuat" method="get" id="hidden-form">
    <input type="hidden"  id="ma_khu_vuc" name="KhuVuc[ma_khu_vuc]">
    <input type="hidden"  id="ten_khu_vuc" name="KhuVuc[ten_khu_vuc]">
    <input type="submit"  class="button-no-style" value="Xuất sang Excel">
</form>

<?php $this->widget('zii.widgets.grid.CGridView', array(
'id' => 'grid',
'dataProvider' => $model->search(),
'columns' => array(
		'ma_khu_vuc',
		'ten_khu_vuc',
		'mo_ta',
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
            var a = $('#yw0 input[id=KhuVuc_ma_khu_vuc]').val();
            var b = $('#yw0 input[id=KhuVuc_ten_khu_vuc]').val();

            //set default var
            $('#hidden-form input[id=ma_khu_vuc]').val('');
            $('#hidden-form input[id=ten_khu_vuc]').val('');
            if(a!='')
                $('#hidden-form input[id=ma_khu_vuc]').val($.trim(a));
            if(b!='')
                $('#hidden-form input[id=ten_khu_vuc]').val($.trim(b));

        }
    );

</script>
