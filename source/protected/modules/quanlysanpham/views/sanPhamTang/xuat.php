<?php
$this->widget('CPOSEExcelView', array(
    'dataProvider' => $dataProvider,
    'title' => 'Sample_name' . time(),
    'autoWidth' => true,
    'category' => '',
    'documentTitle' => 'Sample_name',
    'columns' => array(
        array('name' => 'STT',
            'value' => ''
        ),
        'ma_vach',
        'ten_san_pham',
        'gia_tang',
        'thoi_gian_bat_dau',
        'thoi_gian_ket_thuc',
        array('name' => Yii::t('viLib', 'Status'),
            'value' => '$data->layTenTrangThai()',
        ),
    ),
));
?>