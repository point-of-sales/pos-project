<div class="wide search-box-form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

<ul class="search-box">

	<li>
		<?php echo $form->label($model, 'ma_chi_nhanh'); ?>
		<?php echo $form->textField($model, 'ma_chi_nhanh', array('maxlength' => 15)); ?>
	</li>

	<li>
		<?php echo $form->label($model, 'ten_chi_nhanh'); ?>
		<?php echo $form->textField($model, 'ten_chi_nhanh', array('maxlength' => 100)); ?>
	</li>

	<li>
		<?php echo $form->label($model, 'trang_thai'); ?>
		<?php echo $form->radioButtonList($model, 'trang_thai',$model->getStatusOptions()); ?>
	</li>

	<li>
		<?php echo $form->label($model, 'khu_vuc_id'); ?>
		<?php echo $form->dropDownList($model, 'khu_vuc_id', $model->getAreaOptions(),array('prompt' => Yii::t('app', 'Tất cả'))); ?>
	</li>

	<li>
		<?php echo $form->label($model, 'loai_chi_nhanh_id'); ?>
		<?php echo $form->dropDownList($model, 'loai_chi_nhanh_id', $model->getAreaOptions(), array('prompt' => Yii::t('app', 'Tất cả'))); ?>
	</li>
</ul>


	<div class="row buttons btn-search">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Tìm')); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- search-form -->
