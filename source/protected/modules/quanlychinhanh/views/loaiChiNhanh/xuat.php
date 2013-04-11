<?php
/**
 * User: ${Cristazn}
 * Date: 4/11/13
 * Time: 1:56 PM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */

$this->widget('CEExcelView', array(
    'dataProvider'=> $dataProvider,
    'title'=>'Danh_sach_loai_chi_nhanh_' . time(),
    'autoWidth'=>false,
    'category'=>'',
    'documentTitle'=>'Danh Sách Loại Chi Nhánh',
    'template'=>CEExcelView::NORMAL_LIST,
));