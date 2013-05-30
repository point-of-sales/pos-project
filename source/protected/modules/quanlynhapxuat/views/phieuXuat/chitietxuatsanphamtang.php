<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Import/Export management') => array('chiNhanh/danhsach'),
    Yii::t('viLib', 'Export form detail') => array(),
    Yii::t('viLib', 'Gift product') => array(),
    GxHtml::valueEx($model),
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Export form'), 'url' => array('danhsach'),'visible'=>Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuXuat.DanhSach')),
    array('label' => Yii::t('viLib', 'Add') . ' ' . Yii::t('viLib', 'Export gift product'), 'url' => array('phieuXuat/xuatsanphamtang'),'visible'=>Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuXuat.XuatSanPhamTang')),
    array('label' => Yii::t('viLib', 'Export') . ' ' . Yii::t('viLib', 'File Excel'), 'url' => array('xuat', 'id' => $model->id),'visible'=>Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuXuat.Xuat')),
);
?>


    <h1><?php echo Yii::t('viLib', 'View') . ' ' . Yii::t('viLib','Export form') . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => Yii::t('viLib', 'Voucher code'),
            'type' => 'raw',
            'value' => $model->baseModel->ma_chung_tu,
        ),
        array(
            'name' => Yii::t('viLib', 'Created date'),
            'type' => 'raw',
            'value' => $model->baseModel->ngay_lap,
        ),

        array(
            'name' => Yii::t('viLib', 'Created employee'),
            'type' => 'raw',
            'value' => $model->baseModel->nhanVien->ho_ten,
        ),
        array(
            'name' => Yii::t('viLib', 'Import branch'),
            'type' => 'raw',
            'value' => $model->baseModel->chiNhanh->ten_chi_nhanh,
        ),
        array(
            'name' => Yii::t('viLib', 'Import type'),
            'type' => 'raw',
            'value' => $model->layTenLoaiXuatSanPhamTang(),
        ),
        array(
            'name' => 'chiNhanhNhap',
            'type' => 'raw',
            'value' => $model->chiNhanhNhap->ten_chi_nhanh,
        ),
        array(
            'name' => Yii::t('viLib', 'Total'),
            'type' => 'raw',
            'value' => $model->baseModel->tri_gia,
        ),
    ),
)); ?>

<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'grid',
    'dataProvider' => $dataProvider,
    'columns' => array(
        array(
            'name' => Yii::t('viLib', 'Barcode'),
            'value' => '$data->sanPhamTang->ma_vach',
        ),
        array('name' => Yii::t('viLib', 'Product name'),
            'value' => '$data->sanPhamTang->ten_san_pham'
        ),
        array(
            'name' => Yii::t('viLib', 'Quantity'),
            'value' => '$data->so_luong',
        ),
        array(
            'name' => Yii::t('viLib', 'Bill value for offering'),
            'value' => '$data->sanPhamTang->gia_tang',
        )
    )
)); ?>
    <h2><?php //echo GxHtml::encode($model->getRelationLabel('tblSanPhams')); ?></h2>
<?php
/*echo GxHtml::openTag('ul');
foreach($model->tblSanPhams as $relatedModel) {
    echo GxHtml::openTag('li');
    echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('sanPham/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
    echo GxHtml::closeTag('li');
}
echo GxHtml::closeTag('ul');*/
?>