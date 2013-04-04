<?php

$this->breadcrumbs = array(
	ChiNhanh::label(1),
	Yii::t('viLib', 'Branchs List'),
);

$this->menu = array(
	array('label'=>Yii::t('viLib', 'Add branch'), 'url' => array('them')),

);

?>

<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo GxHtml::encode(ChiNhanh::label(2)); ?></h1>

<div class="search-form">
    <?php $this->renderPartial('_search', array(
        'model' => $model,
    )); ?>

</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'grid',
    'dataProvider'=>$model->search(),
    'columns'=>array(
        'id',
        'ma_chi_nhanh',
        'ten_chi_nhanh',
        'dia_chi',
        'mo_ta',
        'trang_thai'=>array(
                        'name'=>'trang_thai',
                        'value'=>'$data->getStatusText()'
        ),
        'truc_thuoc_id'=>array(
                        'name'=>'truc_thuoc_id',
                        'value'=>'$data->getUnderText()'
        ),
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
                                  }

                                ",
                ),

            ),
        ),
    )
));
?>