<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Customer management') => array('khachHang/danhsach'),
    Yii::t('viLib', 'Customer') => array('khachHang/danhsach'),
    Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Customer'),
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' .  Yii::t('viLib', 'Customer type'), 'url' => array('loaiKhachHang/danhsach'),'visible'=>Yii::app()->user->checkAccess('Quanlykhachhang.LoaiKhachHang.DanhSach')),
    array('label' => Yii::t('viLib', 'Create') . ' ' .  Yii::t('viLib', 'Customer'), 'url' => array('them'),'visible'=>Yii::app()->user->checkAccess('Quanlykhachhang.KhachHang.Them')),
    array('label' => Yii::t('viLib', 'Create') . ' ' .  Yii::t('viLib', 'Customer type') , 'url' => array('loaiKhachHang/them'),'visible'=>Yii::app()->user->checkAccess('Quanlykhachhang.LoaiKhachHang.Them')),
    array('label' => Yii::t('viLib', 'Export') . ' ' .  Yii::t('viLib', 'Customer') , 'url' => array('xuat'),'visible'=>Yii::app()->user->checkAccess('Quanlykhachhang.KhachHang.Xuat')),
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

    <h1><?php echo Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Customer'); ?></h1>


    <div class="search-form">
        <?php $this->renderPartial('_search', array(
            'model' => $model,
        )); ?>
    </div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'grid',
    'dataProvider' => $model->search(),
    'columns' => array(
        'ma_khach_hang',
        'ho_ten',
        array(
            'name'=>'loai_khach_hang_id',
            'value'=>'$data->loaiKhachHang->ten_loai',
        ),
        'ngay_sinh',
        'dia_chi',
        'thanh_pho',
        'diem_tich_luy'=>array(
            'name'=>'diem_tich_luy',
            'value'=>'number_format(floatval($data->diem_tich_luy),0,".",",")'
        ),

        /*
        'dien_thoai',
        'email',
        'mo_ta',


        */
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => array(
                'view' => array(
                    'url' => 'Helpers::urlRouting(Yii::app()->controller,"","chitiet",array("id"=>$data->id))',
                    'label' => Yii::t('viLib', 'View'),
                ),
                'update' => array(
                    'url' => 'Helpers::urlRouting(Yii::app()->controller,"","capnhat",array("id"=>$data->id))',
                    'label' => Yii::t('viLib', 'Update'),
                ),
                'delete' => array(
                    'url' => 'Helpers::urlRouting(Yii::app()->controller,"","xoagrid",array("id"=>$data->id))',
                    'label' => Yii::t('viLib', 'Delete'),
                    'click' => Helpers::deleteButtonClick(),
                ),

            ),
        ),
    ),
)); ?>