<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	Yii::t('viLib','Error'),
);
?>

<h1><?php echo Yii::t('viLib','Error')?> <?php echo $code; ?></h1>

<?php
     switch($code) {
         case 403: {
             // display 403 Forbidden error
            echo CHtml::image(Yii::app()->theme->baseUrl . '/images/error-403.png','error-image',array('class'=>'error-image'));
            break;
         }
         case 404: {
             // display 404 Page not found error
             echo CHtml::image(Yii::app()->theme->baseUrl . '/images/error-404.png','error-image',array('class'=>'error-image'));
             break;
         }
     }
?>
<div class="error error-4-series">
    <?php echo CHtml::encode($message);?>
</div>

