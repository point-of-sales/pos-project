<?php
/**
 * User: ${Cristazn}
 * Date: 5/29/13
 * Time: 4:08 PM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980
 */

$this->widget('CPOSEExcelView', array(
    'dataProvider'=> $dataProvider,
    'title'=>'Danh_sach_san_pham_top_' . time(),
    'autoWidth'=>true,
    'category'=>'',
    'fromDate'=>$khoangThoiGian['thoi_gian_bat_dau'],
    'toDate'=>$khoangThoiGian['thoi_gian_ket_thuc'],
    'template'=>'BanHangTop',
    'documentTitle'=>Yii::t('viLib','Top Product List'),
    'columns'=>array(
        'id',
        'ma_vach',
        'ten_san_pham',
        'don_vi_tinh',
        array(
            'name'=>'nha_cung_cap_id',
            'value'=>'$data->nhaCungCap->ten_nha_cung_cap',
        ),
        'trang_thai'=>array(
            'name'=>'trang_thai',
            'value'=>'$data->layTenTrangThai()',
        ),
        array(
           'name'=>Yii::t('viLib','Sales'),
           'value'=>'array_sum($data->layDanhSachDoanhSo())'
        ),

    )
));