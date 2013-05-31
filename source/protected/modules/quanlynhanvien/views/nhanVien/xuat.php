<?php
/**
 * User: ${Cristazn}
 * Date: 5/29/13
 * Time: 12:02 PM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */

$this->widget('CPOSEExcelView', array(
    'dataProvider'=> $dataProvider,
    'title'=>'Danh_sach_nhan_vien_' . time(),
    'autoWidth'=>true,
    'category'=>'',
    'documentTitle'=>Yii::t('viLib','Employee List'),
    'columns'=>array(
        'id',
        'ma_nhan_vien',
        'ho_ten',
        'gioi_tinh'=>array(
            'name'=>'gioi_tinh',
            'value'=>'$data->layTenGioiTinh()'
        ),
        'dien_thoai',
        'dia_chi',
        array(
            'name' => 'chi_nhanh_id',
            'value' => '$data->chiNhanh->ten_chi_nhanh',
            'filter' => GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true)),
        ),
        array(
            'name' => 'trang_thai',
            'value' => '$data->layTenTrangThai()',
        ),

    )
));

