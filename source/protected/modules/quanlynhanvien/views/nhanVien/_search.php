<div class="wide search-box-form">

<?php $form = $this->beginWidget('GxActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    )); ?>
<ul  class="search-box">
	<li class="row">
		<?php echo $form->label($model, 'ma_nhan_vien'); ?>
		<?php echo $form->textField($model, 'ma_nhan_vien', array('maxlength' => 10)); ?>
	</li>

	<li class="row">
		<?php echo $form->label($model, 'ho_ten'); ?>
		<?php echo $form->textField($model, 'ho_ten', array('maxlength' => 200)); ?>
	</li>

	<li class="row">
		<?php echo $form->label($model, 'trang_thai'); ?>
		<?php echo $form->textField($model, 'trang_thai'); ?>
	</li>

	<li class="row">
		<?php echo $form->label($model, 'loai_nhan_vien_id'); ?>
		<?php echo $form->dropDownList($model, 'loai_nhan_vien_id', GxHtml::
listDataEx(LoaiNhanVien::model()->findAllAttributes(null, true)), array('prompt' =>
        Yii::t('app', 'All'))); ?>
	</li>

	<li class="row">
		<?php echo $form->label($model, 'chi_nhanh_id'); ?>
		<?php echo $form->dropDownList($model, 'chi_nhanh_id', GxHtml::listDataEx(ChiNhanh::
model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</li>
</ul>
	<div class="row buttons btn-search">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Tìm kiếm')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- search-form -->
