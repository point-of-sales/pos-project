<?php
/**
 * User: ${Cristazn}
 * Date: 5/29/13
 * Time: 10:13 AM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */


$this->widget('CPOSEExcelView', array(
    'dataProvider'=> $dataProvider,
    'title'=>'Danh_sach_khach_hang_' . time(),
    'autoWidth'=>true,
    'category'=>'',
    'documentTitle'=>Yii::t('viLib','Customer List'),
    'columns'=>array(
        'id',
        'ma_khach_hang',
        'ho_ten',
        'dia_chi',
        'dien_thoai',
        'diem_tich_luy',
        'loai_khach_hang'=>array(
            'name'=>'loai_khach_hang',
            'value'=>'$data->loaiKhachHang->ten_loai',
        )
    )
));