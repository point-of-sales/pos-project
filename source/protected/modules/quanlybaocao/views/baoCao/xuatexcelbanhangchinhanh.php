<?php
/**
 * User: ${Cristazn}
 * Date: 5/29/13
 * Time: 4:08 PM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980
 */

$this->widget('CPOSEExcelView', array(
    'dataProvider'=> $dataProvider,
    'title'=>'Danh_sach_doanh_so_ban_hang_chi_nhanh_' . time(),
    'autoWidth'=>true,
    'category'=>'',
    'template'=>'BanHangChiNhanh',
    'documentTitle'=>Yii::t('viLib','Sale Branch Status List Report'),
    'columns'=>array(
        'id',
        'ma_chi_nhanh',
        'ten_chi_nhanh',
        'dia_chi',
        'trang_thai'=>array(
            'name'=>'trang_thai',
            'value'=>'$data->layTenTrangThai()',
        ),
        'khu_vuc'=>array(
            'name'=>Yii::t('viLib','Area'),
            'value'=>'$data->layTenKhuVuc()',
        ),
        'doanh_so'=>array(
            'name'=>Yii::t('viLib','Sales'),
            'value'=>'$data->tinhTongDoanhSo()',
        )
    )
));