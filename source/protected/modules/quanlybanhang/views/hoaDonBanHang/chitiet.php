<?php
$this->breadcrumbs = array(
    'Quản lý bán hàng' => array('hoaDonBanHang/danhsach'),
    'Chi tiết hóa đơn bán' => array(),
    GxHtml::valueEx($model),
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . 'Hóa đơn bán', 'url' => array('danhsach')),
    array('label' => Yii::t('viLib', 'Add') . ' ' . 'Hóa đơn bán', 'url' => array('them')),
    array('label' => Yii::t('viLib', 'Export') . ' ' . Yii::t('viLib', 'File Excel'), 'url'=>array('xuat', 'id' => $model->id)),
);
?>


    <h1><?php echo Yii::t('viLib', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('ext.custom-widgets.DetailView4Col', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'Tên khách hàng',
            'type' => 'raw',
            'value' => $model->khachHang->ho_ten,
        ),
        array(
            'name' =>Yii::t('viLib','Voucher code'),
            'type' => 'raw',
            'value' => $model->baseModel->ma_chung_tu,
        ),
        array(
            'name' => 'Điện thoại',
            'type' => 'raw',
            'value' => $model->khachHang->dien_thoai,
        ),
        array(
            'name' => Yii::t('viLib','Created date'),
            'type' => 'raw',
            'value' => date('d/m/Y - h:i:s',strtotime($model->baseModel->ngay_lap)),
        ),
        array(
            'name' => 'Địa chỉ',
            'type' => 'raw',
            'value' => $model->khachHang->dia_chi,
        ),
        array(
            'name' => Yii::t('viLib','Created employee'),
            'type' => 'raw',
            'value' => $model->baseModel->nhanVien->ho_ten,
        ),
        array(
            'name' => 'Loại khách hàng',
            'type' => 'raw',
            'value' => $model->khachHang->loaiKhachHang->ten_loai,
        ),
        array(
            'name' =>'Chi nhánh bán',
            'type' => 'raw',
            'value' => $model->baseModel->chiNhanh->ten_chi_nhanh,
        ),
        array(
            'name' => 'Giảm giá',
            'type' => 'raw',
            'value' => $model->chiet_khau.'%',
        ),
        array(
            'name' => 'Trị giá',
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
            'value' => '$data->sanPham->ma_vach',
        ),
        array('name' => Yii::t('viLib', 'Product name'),
            'value' => '$data->sanPham->ten_san_pham'
        ),
        array('name' => 'Đơn vị tính',
            'value' => '$data->sanPham->don_vi_tinh'
        ),
        array(
            'name' => Yii::t('viLib', 'Quantity'),
            'value' => '$data->so_luong',
        ),
        array(
            'name' => 'Đơn giá',
            'value' => '$data->don_gia',
        ),
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