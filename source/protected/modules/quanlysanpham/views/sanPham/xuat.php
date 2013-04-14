<?php
/**
 * User: ${Cristazn}
 * Date: 4/12/13
 * Time: 10:55 AM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */
$this->widget('CEExcelView', array(
    'dataProvider'=> $dataProvider,
    'title'=>'Danh_sach_san_pham_' . time(),
    'autoWidth'=>true,
    'category'=>'',
    'documentTitle'=>'Danh Sách Sản Phẩm',
    'template'=>CEExcelView::NORMAL_LIST,
));
