
<?php
/**
 * User: ${Cristazn}
 * Date: 6/13/13
 * Time: 9:42 PM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
    Yii::t('viLib','Error'),
);
?>

<h1><?php echo Yii::t('viLib','Authorization')?></h1>

<?php
    echo CHtml::image(Yii::app()->theme->baseUrl . '/images/user-not-authorized.png','error-image',array('class'=>'error-image'));
?>
<div class="error error-4-series">
    <?php echo CHtml::encode(Yii::t('viLib','You are not authorized in system. Please contact your administrator for help'));?>
</div>
<div class="more-info">
    <?php echo CHtml::encode(Yii::t('viLib','In case you have mistake when typing. You can come-back to login page here'));?>
</div>
<div class="come-back">
    <?php echo CHtml::link(Yii::t('viLib','Come back'),Yii::app()->createUrl('/site/login'),array('class'=>'btn-come-back'))?>
</div>