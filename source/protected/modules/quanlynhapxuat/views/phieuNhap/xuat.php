
<?php
$this->widget('CPOSEExcelView', array(
    'dataProvider'=> $dataProvider,
    'title'=>'Phieu_Nhap_' . time(),
    'autoWidth'=>true,
    'category'=>'',
    'documentTitle'=>Yii::t('viLib','Import form'),
    'template'=>'PhieuNhap',
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
            'name' => Yii::t('viLib', 'Import price'),
            'value' => '$data->gia_nhap',
        ),
        array(
            'name' => Yii::t('viLib', 'Total'),
            'value' => '$data->gia_nhap * $data->so_luong',
        )


    ),
));
?>