<?php

$this->breadcrumbs = array(
	$model->label(1),
	Yii::t('viLib', 'List'),
);

$this->menu = array(
array('label'=>Yii::t('viLib', 'Create') . ' ' . $model->label(), 'url'=>array('them')),
array('label'=>Yii::t('viLib', 'Create') . ' ' . LoaiNhanVien::label(), 'url'=>array('loainhanvien/them')),
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

<?php $this->widget('zii.widgets.grid.CGridView', array(
'id' => 'grid',
'dataProvider' => $model->search(),
'columns' => array(
		'ma_nhan_vien',
		'ho_ten',
		'email',
		'dien_thoai',
		'dia_chi',
        'trang_thai',
		/*
		'gioi_tinh',
		'ngay_sinh',
		'trinh_do',
		'luong_co_ban',
		'chuyen_mon',
		'trang_thai',
		'mat_khau',
		'ngay_vao_lam',
		'lan_dang_nhap_cuoi',
		array(
				'name'=>'loai_nhan_vien_id',
				'value'=>'GxHtml::valueEx($data->loaiNhanVien)',
				'filter'=>GxHtml::listDataEx(LoaiNhanVien::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'chi_nhanh_id',
				'value'=>'GxHtml::valueEx($data->chiNhanh)',
				'filter'=>GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true)),
				),
		*/
array(
    'class' => 'CButtonColumn',
    'template'=>'{view}{update}{delete}{active}',
    'buttons'=>array(
            'active' => array(
                    'label' => '',
                    'url' =>'Helpers::urlRouting(Yii::app()->controller,"","ajaxActive",array("id"=>$data->id))',
                    'options' => array('class' => 'active_button', 
                                        'title' =>'Enable/Disable visible this product',
                                        'id' => 'active_button'
                            ),
                    'imageUrl' => Yii::app()->request->baseUrl.'/themes/asia/images/icons/active.png',
                    'click' => Helpers::refreshGrid(),
                    ),
            'view'=>array(
                'url'=>'Helpers::urlRouting(Yii::app()->controller,"","chitiet",array("id"=>$data->id))',
                'label'=>Yii::t('viLib','View'),
            ),
            'update'=>array(
                'url'=>'Helpers::urlRouting(Yii::app()->controller,"","capnhat",array("id"=>$data->id))',
                'label'=>Yii::t('viLib','Update'),
            ),
            'delete'=>array(
                'url'=>'Helpers::urlRouting(Yii::app()->controller,"","xoagrid",array("id"=>$data->id))',
                'label'=>Yii::t('viLib','Delete'),
                'click' =>Helpers::deleteButtonClick(),
            ),

    ),
    ),
),
)); ?>