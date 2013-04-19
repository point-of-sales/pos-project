<?php
/**
 * User: ${Cristazn}
 * Date: 4/11/13
 * Time: 11:05 AM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */

$this->widget('CEExcelView', array(
    'dataProvider'=> $dataProvider,
    'title'=>'Danh_sach_khu_vuc_' . time(),
    'autoWidth'=>false,
    'category'=>'',
    'documentTitle'=>'Danh Sách Khu Vực',

));
