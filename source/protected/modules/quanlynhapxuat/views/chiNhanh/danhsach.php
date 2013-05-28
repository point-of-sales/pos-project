<?php


$this->breadcrumbs = array(
    Yii::t('viLib', 'Import/Export management') => array('chiNhanh/danhsach'),
    Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Branch'),
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Import form'), 'url' => array('phieuNhap/danhsach'), 'visible' => Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuNhap.DanhSach')),
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Export form'), 'url' => array('phieuXuat/danhsach'), 'visible' => Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuXuat.DanhSach')),
    array('label' => Yii::t('viLib', 'Import product'), 'url' => array('phieuNhap/them'), 'visible' => Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuNhap.Them')),
    array('label' => Yii::t('viLib', 'Import gift product'), 'url' => array('phieuNhap/nhapsanphamtang'), 'visible' => Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuNhap.NhapSanPhamTang')),
    array('label' => Yii::t('viLib', 'Export gift product'), 'url' => array('phieuXuat/xuatsanphamtang'), 'visible' => Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuXuat.XuatSanPhamTang')),
    array('label' => Yii::t('viLib', 'Export product'), 'url' => array('phieuXuat/them'), 'visible' => Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuXuat.Them')),
    array('label' => Yii::t('viLib', 'Export') . ' ' . Yii::t('viLib', 'File Excel'), 'url' => array('xuat'), 'visible' => Yii::app()->user->checkAccess('Quanlynhapxuat.ChiNhanh.Xuat')),

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



<h1><?php echo Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Branch'); ?></h1>

<div class="search-form">
    <?php $this->renderPartial('_search', array(
        'model' => $model,

    )); ?>
</div><!-- search-form -->


<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'grid',
    'dataProvider' => $model->searchChiNhanhKichHoat(),
    'columns' => array(
        'ma_chi_nhanh',
        'ten_chi_nhanh',
        'dia_chi',
        'dien_thoai',
        array('name' => 'khu_vuc_id',
            'value' => '$data->khuVuc->ten_khu_vuc'
        ),

        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{import}{export}',
            'visible' => RightsWeight::getRoleWeight(Yii::app()->user->id) == 999, // chi cho quan tri he thong dung tinh nang nay
            'buttons' => array(
                'view' => array(
                    'url' => 'Helpers::urlRouting(Yii::app()->controller,"chiNhanh","chitiet",array("id"=>$data->id))',
                    'label' => Yii::t('viLib', 'View'),
                ),
                'import' => array(
                    'url' => 'Helpers::urlRouting(Yii::app()->controller,"phieuNhap","them",array("id"=>$data->id))',
                    'label' => Yii::t('viLib', 'Import product'),
                    'imageUrl' => Yii::app()->theme->baseUrl . '/images/import_icon.png',
                ),
                'export' => array(
                    'url' => 'Helpers::urlRouting(Yii::app()->controller,"phieuXuat","them",array("id"=>$data->id))',
                    'label' => Yii::t('viLib', 'Export product'),
                    'imageUrl' => Yii::app()->theme->baseUrl . '/images/export_icon.png',
                ),

            ),
        ),
    ),
)); ?>



