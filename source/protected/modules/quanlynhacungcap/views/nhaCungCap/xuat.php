
<?php
$this->widget('CPOSEExcelView', array(
    'dataProvider'=> $dataProvider,
    'title'=>'Danh_sach_nha_cung_cap_' . time(),
    'autoWidth'=>true,
    'category'=>'',
    'documentTitle'=>Yii::t('viLib','Supplier List'),
    'columns'=>array(
        'id',
        'ma_nha_cung_cap',
        'ten_nha_cung_cap',
        'fax',
        'dien_thoai',
        'email',
        'trang_thai'=>array(
            'name'=>'trang_thai',
            'value'=>'$data->layTenTrangThai()'
        ),
    )
));
?>