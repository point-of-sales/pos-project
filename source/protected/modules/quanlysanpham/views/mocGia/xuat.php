
<?php
$this->widget('CEExcelView', array(
    'dataProvider'=> $dataProvider,
    'title'=>'Sample_name' . time(),
    'autoWidth'=>true,
    'category'=>'',
    'documentTitle'=>'Sample_name',
));
?>