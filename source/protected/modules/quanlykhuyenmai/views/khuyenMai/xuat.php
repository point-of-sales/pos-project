
<?php
$this->widget('CPOSEExcelView', array(
    'dataProvider'=> $dataProvider,
    'title'=>'Danh_sach_khuyen_mai_' . time(),
    'autoWidth'=>true,
    'category'=>'',
    'documentTitle'=>Yii::t('viLib','Promotion List'),
    'columns'=>array(
        'id',
        'ma_chuong_trinh',
        'ten_chuong_trinh',
        'gia_giam',
        'thoi_gian_bat_dau',

        'thoi_gian_ket_thuc',
        array('name' => Yii::t('viLib', 'Status'),
            'value' => '$data->layTenTrangThai()',
        ),

    ),
));
?>