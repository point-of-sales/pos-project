<?php
/**
 * User: ${Cristazn}
 * Date: 4/8/13
 * Time: 4:25 PM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */

$this->widget('CEExcelView', array(
    'dataProvider'=> $dataProvider,
    'title'=>'Danh_sach_chi_nhanh_' . time(),
    'autoWidth'=>false,
    'category'=>'',
    'documentTitle'=>'Danh Sách Chi Nhánh',
    'columns'=>array(
                    'id',
                    'ma_chi_nhanh',
                    'ten_chi_nhanh',
                    'loai_chi_nhanh'=>array(
                        'name'=>'loai_chi_nhanh',
                        'value'=>'$data->layTenLoaiChiNhanh()'
                    ),
                    'dia_chi',
                    'dien_thoai',
                    'fax',
                    'mo_ta',
                    'trang_thai'=>array(
                        'name'=>'trang_thai',
                        'value'=>'$data->layTenTrangThai()'
                    ),
                    'truc_thuoc_id'=>array(
                        'name'=>'truc_thuoc_id',
                        'value'=>'$data->layTenTrucThuoc()'
                    ),
                    'khu_vuc_id'=>array(
                        'name'=>'khu_vuc_id',
                        'value'=>'$data->layTenKhuVuc()',
                    )

                ),

));