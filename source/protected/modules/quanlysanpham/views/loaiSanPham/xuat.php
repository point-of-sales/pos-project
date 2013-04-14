<?php
/**
 * User: ${Cristazn}
 * Date: 4/14/13
 * Time: 12:21 PM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */

$this->widget('CEExcelView', array(
    'dataProvider'=> $dataProvider,
    'title'=>'Danh_sach_loai_san_pham_' . time(),
    'autoWidth'=>true,
    'category'=>'',
    'documentTitle'=>'Danh Sách Loại Sản Phẩm',
    'template'=>CEExcelView::NORMAL_LIST,
));
