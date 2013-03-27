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
		<?php echo $form->label($model, 'ma_vach'); ?>
		<?php echo $form->textField($model, 'ma_vach', array('maxlength' => 15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'ten_san_pham'); ?>
		<?php echo $form->textField($model, 'ten_san_pham', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'ten_tieng_viet'); ?>
		<?php echo $form->textField($model, 'ten_tieng_viet', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'han_dung'); ?>
		<?php echo $form->textField($model, 'han_dung'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'don_vi_tinh'); ?>
		<?php echo $form->textField($model, 'don_vi_tinh', array('maxlength' => 50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'ton_toi_thieu'); ?>
		<?php echo $form->textField($model, 'ton_toi_thieu'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'huong_dan_su_dung'); ?>
		<?php echo $form->textArea($model, 'huong_dan_su_dung'); ?>
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
		<?php echo $form->label($model, 'nha_cung_cap_id'); ?>
		<?php echo $form->dropDownList($model, 'nha_cung_cap_id', GxHtml::listDataEx(NhaCungCap::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'loai_san_pham_id'); ?>
		<?php echo $form->dropDownList($model, 'loai_san_pham_id', GxHtml::listDataEx(LoaiSanPham::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
