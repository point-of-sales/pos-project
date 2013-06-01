<?php
/**
 * User: ${Cristazn}
 * Date: 5/29/13
 * Time: 4:08 PM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */

$this->widget('CPOSEExcelView', array(
    'dataProvider'=> $dataProvider,
    'title'=>'Danh_sach_nhap_xuat_ton_' . time(),
    'autoWidth'=>true,
    'category'=>'',
    'fromDate'=>$khoangThoiGian['thoi_gian_bat_dau'],
    'toDate'=>$khoangThoiGian['thoi_gian_ket_thuc'],
    'template'=>'XuatNhapTon',
    'documentTitle'=>Yii::t('viLib','Import Export Instock List'),
    'columns'=>array(
        'id',
        'ma_vach',
        'ten_san_pham',
        array('name'=>Yii::t('viLib','Current price'),
            'type'=>'raw',
            'value'=>'$data->layGiaHienTai()',
        ),
        array(
            'name'=>'ton_dau_ky',
            'header'=>Yii::t('viLib','Total Beginning Instock'),
            'value'=>'$data->ton_dau_ky',
        ),
        array(
            'name'=>'so_luong_nhap',
            'header'=>Yii::t('viLib','Total Import'),
            'value'=>'$data->so_luong_nhap',
        ),
        array(
            'name'=>'so_luong_xuat',
            'header'=>Yii::t('viLib','Total Export'),
            'value'=>'$data->so_luong_xuat',
        ),
        array(
            'name'=>'so_luong_ban',
            'header'=>Yii::t('viLib','Total Sale'),
            'value'=>'$data->so_luong_ban',
        ),
        array(
            'name'=>'so_luong_thuc_ton',
            'header'=>Yii::t('viLib','Total Real Instock'),
            'value'=>'$data->so_luong_thuc_ton',
        ),

    )
));