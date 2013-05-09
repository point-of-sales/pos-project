
<?php
$this->widget('CPOSEExcelView', array(
    'dataProvider'=> $dataProvider,
    'title'=>'Sample_name' . time(),
    'autoWidth'=>true,
    'category'=>'',
    'documentTitle'=>'Sample_name',
    'columns'=>array(
        array(
            'name'=>'STT',
            'value'=>'',
        ),
        'ma_vach',
        'ten_san_pham',
        'han_dung',
        array(
            'name'=>'nha_cung_cap_id',
            'value'=>'$data->nhaCungCap->ten_nha_cung_cap',
        ),
        'gia_goc',
        array(
            'name'=>'trang_thai',
            'value'=>'$data->layTenTrangThai()'
        ),
        array(
            'name'=>Yii::t('viLib','Promotion'),
            'value'=>'($data->khuyen_mai_id=="")?Yii::t("viLib","Promotion not available"):$data->khuyenMai->ten_chuong_trinh'
        )
    )

));
?>