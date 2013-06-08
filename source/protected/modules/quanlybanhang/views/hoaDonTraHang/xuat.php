
<?php
$this->widget('CPOSEExcelView', array(
    'dataProvider'=> $dataProvider,
    'title'=>'Hoa_Don_Tra_Hang_' . time(),
    'autoWidth'=>true,
    'category'=>'',
    'documentTitle'=>'Hóa đơn trả hàng',
    'template'=>'HoaDonTraHang',
    'columns' => array(

        array('name'=>'STT',
              'value'=>'',
        ),
        array(
            'name' => Yii::t('viLib', 'Barcode'),
            'value' => '$data->sanPham->ma_vach',
        ),
        array('name' => Yii::t('viLib', 'Product name'),
            'value' => '$data->sanPham->ten_san_pham'
        ),
        array(
            'name' => Yii::t('viLib', 'Quantity'),
            'value' => '$data->so_luong',
        ),
        array(
            'name' => 'Đơn giá',
            'value' => '$data->don_gia',
        ),
        array(
            'name' => 'Tổng cộng',
            'value' => '$data->don_gia*$data->so_luong',
        ),

    ),
));
?>