<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'ma_nhan_vien'); ?>
		<?php echo $form->textField($model, 'ma_nhan_vien', array('maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'ho_ten'); ?>
		<?php echo $form->textField($model, 'ho_ten', array('maxlength' => 200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'trang_thai'); ?>
		<?php echo $form->textField($model, 'trang_thai'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'loai_nhan_vien_id'); ?>
		<?php echo $form->dropDownList($model, 'loai_nhan_vien_id', GxHtml::listDataEx(LoaiNhanVien::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'chi_nhanh_id'); ?>
		<?php echo $form->dropDownList($model, 'chi_nhanh_id', GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
