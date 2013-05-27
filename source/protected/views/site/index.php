<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<h1><?php echo Yii::t('viLib', 'Welcome to Point Of Sales System Management') ?></h1>
<div class="main-intro">
    <div class="intro-image">
        <?php echo CHtml::image(Yii::app()->theme->baseUrl . '/images/sm.jpg') ?>
    </div>
    <div class="intro-text">
        <p class="intro-text-header"><?php echo Yii::t('viLib','Introduction')?></p>
        <p class="intro-text-content"><?php echo Yii::t('viLib', 'Point Of Sales System Management - POSSM is an advance system is designed for
sales management purpose. Data of system is hosted in cloud and can be scale easily. It\'s suitable to
 small or average bussiness.')?></p>
        <p class="intro-text-header"><?php echo Yii::t('viLib','Features')?></p>
        <ul class="features-ul">
            <li><?php echo Yii::t('viLib','Reliable and Convenient')?></li>
            <li><?php echo Yii::t('viLib','Work on Web-based 2.0')?></li>
            <li><?php echo Yii::t('viLib','Large scale easily')?></li>
            <li><?php echo Yii::t('viLib','Central management')?></li>
            <li><?php echo Yii::t('viLib','Quick security update')?></li>
            <li><?php echo Yii::t('viLib','Lower cost than tranditional management method')?></li>
        </ul>
    </div>

</div>