
<?php
$this->widget('CPOSEExcelView', array(
    'dataProvider'=> $dataProvider,
    'title'=>'Danh_sach_chi_nhanh_' . time(),
    'autoWidth'=>true,
    'category'=>'',
    'documentTitle'=>Yii::t('viLib','Branchs list'),
));
?>