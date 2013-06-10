<?php
$this->breadcrumbs = array(
    'Quản lý bán hàng' => array('hoaDonBanHang/danhsach'),
    'Chi tiết hóa đơn trả '.$model->getBaseModel()->ma_chung_tu,
);

$this->menu = array(
    array('label'=>Yii::t('viLib', 'List') . ' ' . 'Hóa đơn trả hàng', 'url'=>array('hoaDonTraHang/danhsach')),
    //array('label' => Yii::t('viLib', 'Export') . ' ' . Yii::t('viLib', 'File Excel'), 'url'=>array('xuat', 'id' => $model->id)),
);
?>


    <h1><?php echo 'Hóa Đơn Trả' . ' ' . $model->getBaseModel()->ma_chung_tu; ?></h1>
<div class="xuat-file-menu">
    <ul>
        <li>
            <a href="<?php echo Yii::app()->createUrl('quanlybanhang/hoaDonTraHang/hoadontra',array('id'=>$model->id,'p'=>'false'))?>" title="print" target="_blank">
                <img alt="print" src="<?php echo Yii::app()->theme->baseUrl?>/images/icons/print.png"/>
            </a>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('quanlybanhang/hoaDonTraHang/xuatfileexcel',array('id'=>$model->id))?>" title="excel" target="_blank">
                <img alt="excel" src="<?php echo Yii::app()->theme->baseUrl?>/images/icons/excel.png"/>
            </a>
        </li>
    </ul>
</div>
<?php 
$this->widget('ext.custom-widgets.DetailView4Col', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' =>Yii::t('viLib','Voucher code'),
            'type' => 'raw',
            'value' => $model->getBaseModel()->ma_chung_tu,
        ),
        array(
            'name' => Yii::t('viLib','Created date'),
            'type' => 'raw',
            'value' => date('d/m/Y - h:i:s',strtotime($model->ngay_lap)),
        ),
        array(
            'name' => Yii::t('viLib','Created employee'),
            'type' => 'raw',
            'value' => $model->baseModel->nhanVien->ho_ten,
        ),
        array(
            'name' => 'Trị giá',
            'type' => 'raw',
            'value' => number_format($model->tri_gia,0,".",","),
        ),
        array(
            'name' => 'Lý do trả hàng',
            'type' => 'raw',
            'value' => $model->ly_do_tra_hang,
        ),
        array(
            'value' => '',
        ),
    ),
)); 
?>

<?php
//echo '<h2>Chi tiết hóa đơn bán</h2>';
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'grid',
    'dataProvider' => $chiTietHangTraProvider,
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
            'value' => 'number_format($data->don_gia,0,".",",")',
        ),
    )
));
?>
<h2>Hóa đơn bán gốc</h2>

<?php 
$this->widget('ext.custom-widgets.DetailView4Col', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'Tên khách hàng',
            'type' => 'raw',
            'value' => $model->hoaDonBan->khachHang->ho_ten,
        ),
        array(
            'name' =>Yii::t('viLib','Voucher code'),
            'type' => 'raw',
            'value' => $model->hoaDonBan->getBaseModel()->ma_chung_tu,
        ),
        array(
            'name' => 'Điện thoại',
            'type' => 'raw',
            'value' => $model->hoaDonBan->khachHang->dien_thoai,
        ),
        array(
            'name' => Yii::t('viLib','Created date'),
            'type' => 'raw',
            'value' => date('d/m/Y - h:i:s',strtotime($model->hoaDonBan->getBaseModel()->ngay_lap)),
        ),
        array(
            'name' => 'Địa chỉ',
            'type' => 'raw',
            'value' => $model->hoaDonBan->khachHang->dia_chi,
        ),
        array(
            'name' => Yii::t('viLib','Created employee'),
            'type' => 'raw',
            'value' => $model->hoaDonBan->getBaseModel()->nhanVien->ho_ten,
        ),
        array(
            'name' => 'Loại khách hàng',
            'type' => 'raw',
            'value' => $model->hoaDonBan->khachHang->loaiKhachHang->ten_loai,
        ),
        array(
            'name' =>'Chi nhánh bán',
            'type' => 'raw',
            'value' => $model->hoaDonBan->getBaseModel()->chiNhanh->ten_chi_nhanh,
        ),
        array(
            'name' => 'Giảm giá',
            'type' => 'raw',
            'value' => $model->hoaDonBan->chiet_khau.'%',
        ),
        array(
            'name' => 'Trị giá',
            'type' => 'raw',
            'value' => number_format($model->hoaDonBan->getBaseModel()->tri_gia,0,".",","),
        ),
    ),
)); 
?>

<?php
//echo '<h2>Chi tiết hóa đơn bán</h2>';
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'grid',
    'dataProvider' => $chiTietHangBanProvider,
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
            'value' => 'number_format($data->don_gia,0,".",",")',
        ),
    )
));
?>