
<?php echo "<?php\n"; ?>
$this->widget('CPOSEExcelView', array(
    'dataProvider'=> $dataProvider,
    'title'=>'Sample_name' . time(),
    'autoWidth'=>true,
    'category'=>'',
    'documentTitle'=>'Sample_name',
));
<?php echo '?>'; ?>