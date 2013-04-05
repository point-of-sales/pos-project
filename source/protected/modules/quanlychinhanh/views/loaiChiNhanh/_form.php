<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'mloai-chi-nhanh-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row cus-row">
		<?php echo $form->labelEx($model,'ma_loai_chi_nhanh'); ?>
		<?php echo $form->textField($model, 'ma_loai_chi_nhanh', array('maxlength' => 15)); ?>
		<?php echo $form->error($model,'ma_loai_chi_nhanh'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'ten_loai_chi_nhanh'); ?>
		<?php echo $form->textField($model, 'ten_loai_chi_nhanh', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'ten_loai_chi_nhanh'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('chiNhanhs')); ?></label>
		<?php echo $form->checkBoxList($model, 'chiNhanhs', GxHtml::encodeEx(GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->