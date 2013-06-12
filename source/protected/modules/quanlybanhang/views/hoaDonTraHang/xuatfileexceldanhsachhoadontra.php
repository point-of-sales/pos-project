<?php
/**
 * User: ${Cristazn}
 * Date: 6/12/13
 * Time: 8:59 AM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */
$this->widget('CPOSEExcelView', array(
    'dataProvider'=> $dataProvider,
    'title'=>'Hoa_Don_Tra_Hang_' . time(),
    'autoWidth'=>true,
    'category'=>'',
    'documentTitle'=>'Danh sách Hóa đơn trả hàng',
    'template'=>'HoaDonTraHang',
));
?>