<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Employee management') => array('nhanVien/danhsach'),
    Yii::t('viLib', 'Employee') => array('nhanVien/danhsach'),
    Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Employee'),
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Employee type'), 'url' => array('loaiNhanVien/danhsach')),
    array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Employee'), 'url' => array('them')),
    array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Employee type'), 'url' => array('loaiNhanVien/them')),
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

    <h1><?php echo Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Employee'); ?></h1>


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
        array(
            'name' => 'gioi_tinh',
            'value' => '$data->layTenGioiTinh()',
        ),
        'dien_thoai',
        'dia_chi',
        array(
            'name' => 'chi_nhanh_id',
            'value' => '$data->chiNhanh->ten_chi_nhanh',
            'filter' => GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true)),
        ),
        array(
            'name' => 'trang_thai',
            'value' => '$data->layTenTrangThai()',
        ),

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
            'template' => '{view}{update}{delete}{active}',
            'htmlOptions' => array('style' => 'width:80px'),

            'buttons' => array(
                'active' => array(
                    'label' => '',
                    'url' => 'Helpers::urlRouting(Yii::app()->controller,"","ajaxActive",array("id"=>$data->id))',
                    'options' => array('class' => 'active_button',
                        'title' => Yii::t('viLib', 'Active/Deactive this item'),
                        'id' => 'active_button'
                    ),
                    'imageUrl' => Yii::app()->request->baseUrl . '/themes/asia/images/icons/active.png',
                    'click' => Helpers::refreshGrid(),

                ),
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