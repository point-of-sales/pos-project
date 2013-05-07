
<?php
$this->widget('CPOSEExcelView', array(
    'dataProvider'=> $dataProvider,
    'title'=>'Sample_name_' . time(),
    'autoWidth'=>true,
    'category'=>'',
    'documentTitle'=>Yii::t('viLib','Export form'),
    'template'=>'PhieuXuat',
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
            'name' => Yii::t('viLib', 'Export price'),
            'value' => '$data->gia_xuat',
        ),
        array(
            'name' => Yii::t('viLib', 'Total'),
            'value' => '$data->gia_xuat * $data->so_luong',
        )


    ),
));
?>