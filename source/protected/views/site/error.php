<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<h2>Error <?php echo $code; ?></h2>

<div class="error">
<?php echo CHtml::encode($message);?>
</div>
<?php
     switch($code) {
         case 403: {
             // display 403 Forbidden error
            echo CHtml::image(Yii::app()->theme->baseUrl . '/images/error-403.png','error-image',array('class'=>'error-image'));
         }
     }
?>

