
<?php
$this->widget('CPOSEExcelView', array(
    'dataProvider'=> $dataProvider,
    'title'=>'Danh_sach_moc_gia_' . time(),
    'autoWidth'=>true,
    'category'=>'',
    'documentTitle'=>Yii::t('viLib','Price checkpoint'),
    'columns'=>array(
        'id',
        'thoi_gian_bat_dau',
        'gia_ban'
    ),
));
?>