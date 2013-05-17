<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Report management') => array('baoCao/danhsach'),
    Yii::t('viLib', 'Report') => array('baoCao/danhsach'),
    Yii::t('viLib', 'List'),
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'Import and Export Report'), 'url' => array('baoCao/nhapxuatton')),
    array('label' => Yii::t('viLib', 'Branch Sales Report'), 'url' => array('baoCao/banhangchinhanh')),
    array('label' => Yii::t('viLib', 'Product Sales Report'), 'url' => array('baoCao/banhangsanpham')),
    array('label' => Yii::t('viLib', 'Top Sales Report'), 'url' => array('baoCao/banhangtop')),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('grid', {
data: $(this).serialize()
});
return false;
});
");
?>



<h1><?php echo Yii::t('viLib', 'System List Reports')?></h1>

<div class="main-report-intro">
    <img src="<?php echo Yii::app()->theme->baseUrl . '/images/report-bg.jpg'?>">
</div>
