<?php
/**
 * User: ${Cristazn}
 * Date: 5/14/13
 * Time: 10:19 AM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980
 */

$this->breadcrumbs = array(
    Yii::t('viLib', 'Report management') => array('baoCao/index'),
    Yii::t('viLib', 'Report') => array('baoCao/index'),
    Yii::t('viLib', 'Import and Export Report'),
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'Import Export Report'), 'url' => array('baoCao/nhapxuatton')),
    array('label' => Yii::t('viLib', 'General Report'), 'url' => array('baoCao/baocaotonghop')),
    array('label' => Yii::t('viLib', 'Sales Report'), 'url' => array('baoCao/banhang')),
);

?>



<h1><?php echo Yii::t('viLib', 'Import and Export Report') ?></h1>
<?php

if (!isset($thoi_gian_bat_dau) && !isset($thoi_gian_ket_thuc)) {
    ?>
    <div class="report-intro">
        <p><?php echo Yii::t('viLib', 'Choose time period to view Sales Status') ?></p>
        <img src="<?php echo Yii::app()->theme->baseUrl . '/images/chart.png' ?>">
    </div>

<?php
}

?>
