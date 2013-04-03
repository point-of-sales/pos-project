<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'mkhu-vuc-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

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

		<label><?php echo GxHtml::encode($model->getRelationLabel('chiNhanhs')); ?></label>
		<?php echo $form->checkBoxList($model, 'chiNhanhs', GxHtml::encodeEx(GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->