<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<div class="form form-login-wrapper">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form-content',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
    <div id="login-form-title">
        <span><?php echo Yii::t('viLib','POSSM System Login')?></span>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'username',array('class'=>'login-credential-label')); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password',array('class'=>'login-credential-label')); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('viLib','Login')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
