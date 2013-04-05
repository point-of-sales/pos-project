<div class="form">

    <?php  if(Yii::app()->user->hasFlash('dup-error')) { ?>
        <div class="response-msg error ui-corner-all">
            <?php echo Yii::app()->user->getFlash('dup-error');?>
        </div>

    <?php } ?>

<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'khu-vuc-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('viLib', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('viLib', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>
    <div class="form-add-content">
		<div class="row">
		<?php echo $form->labelEx($model,'ma_khu_vuc'); ?>
		<?php echo $form->textField($model, 'ma_khu_vuc', array('maxlength' => 15)); ?>
		<?php echo $form->error($model,'ma_khu_vuc'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'ten_khu_vuc'); ?>
		<?php echo $form->textField($model, 'ten_khu_vuc', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'ten_khu_vuc'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'mo_ta'); ?>
		<?php echo $form->textArea($model, 'mo_ta'); ?>
		<?php echo $form->error($model,'mo_ta'); ?>
		</div><!-- row -->

        <div class="btn">
            <?php
            echo GxHtml::submitButton(Yii::t('viLib', 'Save'));
            $this->endWidget();
            ?>
        </div>
    </div>
</div><!-- form -->