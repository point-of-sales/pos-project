<div class="form">

<?php  if(Yii::app()->user->hasFlash('info-board')) {?>    <div class="response-msg error ui-corner-all info-board">        <?php echo Yii::app()->user->getFlash('info-board');?>    </div><?php } ?>

<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'khu-vuc-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('viLib', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('viLib', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row cus-row">
		<?php echo $form->labelEx($model,'ma_khu_vuc'); ?>
		<?php echo $form->textField($model, 'ma_khu_vuc', array('maxlength' => 15)); ?>
		<?php echo $form->error($model,'ma_khu_vuc'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'ten_khu_vuc'); ?>
		<?php echo $form->textField($model, 'ten_khu_vuc', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'ten_khu_vuc'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'mo_ta'); ?>
		<?php echo $form->textArea($model, 'mo_ta'); ?>
		<?php echo $form->error($model,'mo_ta'); ?>
		</div><!-- row -->


        <div class="btn-save">
            <?php
            echo GxHtml::submitButton(Yii::t('viLib', 'Save'));
            $this->endWidget();
            ?>
        </div>
</div><!-- form -->