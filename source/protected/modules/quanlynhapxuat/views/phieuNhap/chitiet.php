<?php
$this->breadcrumbs = array(
    Yii::t('viLib', 'Import/Export management') => array('chiNhanh/danhsach'),
    Yii::t('viLib', 'Import form detail') => array(),
    $model->chungTu->ma_chung_tu,
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Import form'), 'url' => array('danhsach'),'visible'=>Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuNhap.DanhSach')),
    array('label' => Yii::t('viLib', 'Add') . ' ' . Yii::t('viLib', 'Import form'), 'url' => array('them'),'visible'=>Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuNhap.Them')),
    array('label' => Yii::t('viLib', 'Export') . ' ' . Yii::t('viLib', 'File Excel'), 'url'=>array('xuat', 'id' => $model->id),'visible'=>Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuNhap.Xuat')),
);
?>


    <h1><?php echo Yii::t('viLib', 'View') . ' ' . Yii::t('viLib','Import form') . ' ' . $model->chungTu->ma_chung_tu; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' =>Yii::t('viLib','Voucher code'),
            'type' => 'raw',
            'value' => $model->baseModel->ma_chung_tu,
        ),
        array(
            'name' => Yii::t('viLib','Created date'),
            'type' => 'raw',
            'value' => date('d-m-Y',strtotime($model->baseModel->ngay_lap)),
        ),

        array(
            'name' => Yii::t('viLib','Created employee'),
            'type' => 'raw',
            'value' => $model->baseModel->nhanVien->ho_ten,
        ),
        array(
            'name' =>Yii::t('viLib','Import branch'),
            'type' => 'raw',
            'value' => $model->baseModel->chiNhanh->ten_chi_nhanh,
        ),
        array(
            'name' =>Yii::t('viLib','Import type'),
            'type' => 'raw',
            'value' => $model->loaiNhapXuat->ten_loai_nhap_xuat,
        ),
        array(
            'name' => 'chiNhanhXuat',
            'type' => 'raw',
            'value' => $model->chiNhanhXuat->ten_chi_nhanh,
        ),
        /*array(
            'name' => Yii::t('viLib','Total'),
            'value' => number_format(floatval($model->baseModel->tri_gia),0,".",","),
        ),*/
    ),
)); ?>

<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'grid',
    'dataProvider' => $dataProvider,
    'columns' => array(
        array(
            'name' => Yii::t('viLib', 'Barcode'),
            'value' => '($data instanceof ChiTietPhieuNhapSanPhamTang)?$data->sanPhamTang->ma_vach:$data->sanPham->ma_vach',
        ),
        array('name' => Yii::t('viLib', 'Product name'),
            'value' => '($data instanceof ChiTietPhieuNhapSanPhamTang)?$data->sanPhamTang->ten_san_pham:$data->sanPham->ten_san_pham'
        ),
        array(
            'name' => Yii::t('viLib', 'Quantity'),
            'value' => 'number_format(floatval($data->so_luong),0,".",",")',
        ),
        array(
            'name' => Yii::t('viLib', 'Import price'),
            'value' => '($data instanceof ChiTietPhieuNhapSanPhamTang)?"":number_format(floatval($data->gia_nhap),0,".",",")',
            'visible'=>($dataProvider->modelClass=='ChiTietPhieuNhap')?true:false,
        )
    )
)); ?>
    <!--
<h2><?php /*echo GxHtml::encode($model->getRelationLabel('tblSanPhams')); */?></h2>
--><?php
/*	echo GxHtml::openTag('ul');
	foreach($model->tblSanPhams as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('sanPham/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
*/
?>