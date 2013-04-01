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
		<?php echo $form->label($model, 'ma_chi_nhanh'); ?>
		<?php echo $form->textField($model, 'ma_chi_nhanh', array('maxlength' => 15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'ten_chi_nhanh'); ?>
		<?php echo $form->textField($model, 'ten_chi_nhanh', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'dia_chi'); ?>
		<?php echo $form->textField($model, 'dia_chi', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'dien_thoai'); ?>
		<?php echo $form->textField($model, 'dien_thoai', array('maxlength' => 15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'fax'); ?>
		<?php echo $form->textField($model, 'fax', array('maxlength' => 15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'mo_ta'); ?>
		<?php echo $form->textArea($model, 'mo_ta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'trang_thai'); ?>
		<?php echo $form->textField($model, 'trang_thai'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'truc_thuoc_id'); ?>
		<?php echo $form->dropDownList($model, 'truc_thuoc_id', GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'khu_vuc_id'); ?>
		<?php echo $form->dropDownList($model, 'khu_vuc_id', GxHtml::listDataEx(KhuVuc::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'loai_chi_nhanh_id'); ?>
		<?php echo $form->dropDownList($model, 'loai_chi_nhanh_id', GxHtml::listDataEx(LoaiChiNhanh::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
