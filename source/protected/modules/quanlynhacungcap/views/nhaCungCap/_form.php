<div class="form">

<?php  if(Yii::app()->user->hasFlash('info-board')) {?>    <div class="response-msg error ui-corner-all info-board">        <?php echo Yii::app()->user->getFlash('info-board');?>    </div><?php } ?>

<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'nha-cung-cap-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('viLib', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('viLib', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row cus-row">
		<?php echo $form->labelEx($model,'ma_nha_cung_cap'); ?>
		<?php echo $form->textField($model, 'ma_nha_cung_cap', array('maxlength' => 15)); ?>
		<?php echo $form->error($model,'ma_nha_cung_cap'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'ten_nha_cung_cap'); ?>
		<?php echo $form->textField($model, 'ten_nha_cung_cap', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'ten_nha_cung_cap'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'mo_ta'); ?>
		<?php echo $form->textArea($model, 'mo_ta'); ?>
		<?php echo $form->error($model,'mo_ta'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'dien_thoai'); ?>
		<?php echo $form->textField($model, 'dien_thoai', array('maxlength' => 15)); ?>
		<?php echo $form->error($model,'dien_thoai'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model, 'email', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'email'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'fax'); ?>
		<?php echo $form->textField($model, 'fax', array('maxlength' => 15)); ?>
		<?php echo $form->error($model,'fax'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'trang_thai'); ?>
		<?php echo $form->textField($model, 'trang_thai'); ?>
		<?php echo $form->error($model,'trang_thai'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('sanPhams')); ?></label>
		<?php echo $form->checkBoxList($model, 'sanPhams', GxHtml::encodeEx(GxHtml::listDataEx(SanPham::model()->findAllAttributes(null, true)), false, true)); ?>

        <div class="btn-save">
            <?php
            echo GxHtml::submitButton(Yii::t('viLib', 'Save'));
            $this->endWidget();
            ?>
        </div>
</div><!-- form -->