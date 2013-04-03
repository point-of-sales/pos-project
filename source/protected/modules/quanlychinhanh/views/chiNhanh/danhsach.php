<?php

$this->breadcrumbs = array(
	ChiNhanh::label(2),
	Yii::t('app', 'Danh sách các chi nhánh'),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Thêm chi nhánh'), 'url' => array('them')),

);
?>

<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('chi-nhanh-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo GxHtml::encode(ChiNhanh::label(2)); ?></h1>

<div class="error">
    <?php
        if(Yii::app()->user->hasFlash('del-error')) {
            echo Yii::app()->user->getFlash('del-error');
        }
    ?>
</div>

<div class="search-form">
    <?php $this->renderPartial('_search', array(
        'model' => $model,
    )); ?>

</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'chi-nhanh-grid',
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
                    'url'=>'Yii::app()->createUrl("/quanlychinhanh/chiNhanh/chitiet",array("id"=>$data->id))',
                    'label'=>'Xem chi tiết',
                ),

                'update'=>array(
                     'url'=>'Yii::app()->createUrl("/quanlychinhanh/chiNhanh/capnhat",array("id"=>$data->id))',
                     'label'=>'Cập nhật',
                ),
                'delete'=>array(
                    'url'=>'Yii::app()->createUrl("/quanlychinhanh/chiNhanh/xoa",array("id"=>$data->id))',
                    'label'=>'Xóa'

                ),

            ),
        ),
    )
));
?>