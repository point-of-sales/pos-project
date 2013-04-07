<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('app', 'Manage'),
    );

$this->menu = array(
    array('label' => Yii::t('app', 'List') . ' ' . $model->label(2), 'url' => array
            ('index')),
    array('label' => Yii::t('app', 'Create') . ' ' . $model->label(), 'url' => array
            ('them')),
    );

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('nhan-vien-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' =>
'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search', array('model' => $model, )); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'nhan-vien-grid',
    'dataProvider' => $model->search(),
    //'filter' => $model,
    'columns' => array(
        'id',
        'ma_nhan_vien',
        'ho_ten',
        'email',
        'dien_thoai',
        'dia_chi',
        'trang_thai',
        array(
            'class' => 'CButtonColumn',
            'header' => 'Trạng thái',
            'template' => '{active}',
            'buttons' => array(
            'active' => array(
                    'label' => '',
                    'url' => 'Yii::app()->createUrl("/quanlynhanvien/nhanvien/ajaxActive", array("id"=>$data->id))',
                    'options' => array('class' => 'active_button', 
                                        'title' =>'Enable/Disable visible this product',
                                        'id' => 'active_button'
                            ),
                    'imageUrl' => Yii::app()->request->baseUrl.'/themes/asia/images/icons/active.png',
                    'click' => "js:function(){
                                        var url = $(this).attr('href');
                                        $.fn.yiiGridView.update('nhan-vien-grid', {  //change my-grid to your grid's name
                                            type:'POST',
                                            url:$(this).attr('href'),
                                            success:function(data) {
                                              $.fn.yiiGridView.update('nhan-vien-grid'); //change my-grid to your grid's name
                                            }
                                        })
                                        return false;
                                      }
                                    ",
                    ),
                    )
        ),
        /*
        'gioi_tinh',
        'ngay_sinh',
        'trinh_do',
        'luong_co_ban',
        'chuyen_mon',
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
            'template' => '{view}{update}{delete}',
            'buttons' => array(
                'view' => array(
                    'url' => 'Yii::app()->createUrl("/quanlynhanvien/nhanvien/chitiet",array("id"=>$data->id))',
                    'label' => 'Xem chi tiết',
                    ),

                'update' => array(
                    'url' => 'Yii::app()->createUrl("/quanlynhanvien/nhanvien/capnhat",array("id"=>$data->id))',
                    'label' => 'Cập nhật',
                    ),
                'delete' => array('url' =>
                        'Yii::app()->createUrl("/quanlynhanvien/nhanvien/xoa",array("id"=>$data->id))',
                        'label' => 'Xóa'),
                )),
        ),
    )); ?>