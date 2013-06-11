
<?php
$this->widget('CPOSEExcelView', array(
    'dataProvider'=> $dataProvider,
    'title'=>'Phieu_Nhap_San_Pham_Tang_' . time(),
    'autoWidth'=>true,
    'category'=>'',
    'documentTitle'=>Yii::t('viLib','Import form'),
    'template'=>'PhieuNhapSanPhamTang',
    'columns' => array(

        array('name'=>'STT',
            'value'=>'',
        ),
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

    ),
));
?>