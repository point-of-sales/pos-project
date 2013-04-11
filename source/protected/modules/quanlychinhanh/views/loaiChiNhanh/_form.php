<div class="form">

<?php  if(Yii::app()->user->hasFlash('info-board')) {?>    <div class="response-msg error ui-corner-all info-board">        <?php echo Yii::app()->user->getFlash('info-board');?>    </div><?php } ?>

<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'loai-chi-nhanh-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('viLib', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('viLib', 'are required'); ?>.
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
<!--
		<label><?php /*echo GxHtml::encode($model->getRelationLabel('chiNhanhs')); */?></label>
		--><?php /*echo $form->checkBoxList($model, 'chiNhanhs', GxHtml::encodeEx(GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true)), false, true)); */?>

        <div class="btn-save">
            <?php
            echo GxHtml::submitButton(Yii::t('viLib', 'Save'));
            $this->endWidget();
            ?>
        </div>
</div><!-- form -->