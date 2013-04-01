<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'id'); ?>
		<?php echo $form->textField($model, 'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'ma_loai_chi_nhanh'); ?>
		<?php echo $form->textField($model, 'ma_loai_chi_nhanh', array('maxlength' => 15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'ten_loai_chi_nhanh'); ?>
		<?php echo $form->textField($model, 'ten_loai_chi_nhanh', array('maxlength' => 100)); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
