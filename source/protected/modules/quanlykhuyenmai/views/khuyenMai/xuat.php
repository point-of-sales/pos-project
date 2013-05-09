
<?php
$this->widget('CPOSEExcelView', array(
    'dataProvider'=> $dataProvider,
    'title'=>'Sample_name' . time(),
    'autoWidth'=>true,
    'category'=>'',
    'documentTitle'=>'Sample_name',
    'columns'=>array(
        'ma_chuong_trinh',
        'ten_chuong_trinh',
        'gia_giam',
        'thoi_gian_bat_dau',

        'thoi_gian_ket_thuc',
        array('name' => Yii::t('viLib', 'Status'),
            'value' => '$data->layTenTrangThai()',
        ),

        array(
            'name' => 'chi_nhanh_id',
            'value' => '$data->chiNhanh->ten_chi_nhanh',
        ),
    ),
));
?>