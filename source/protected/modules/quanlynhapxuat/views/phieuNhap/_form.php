<div class="form">

<?php  if(Yii::app()->user->hasFlash('info-board')) {?>    <div class="response-msg error ui-corner-all info-board">        <?php echo Yii::app()->user->getFlash('info-board');?>    </div><?php } ?>

<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'phieu-nhap-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('viLib', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('viLib', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row cus-row">
		<?php echo $form->labelEx($model,'ma_chung_tu'); ?>
		<?php echo $form->textField($model, 'ma_chung_tu'); ?>
		<?php echo $form->error($model,'ma_chung_tu'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'loai_nhap_vao'); ?>
		<?php echo $form->textField($model, 'loai_nhap_vao'); ?>
		<?php echo $form->error($model,'loai_nhap_vao'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'chi_nhanh_xuat_id'); ?>
		<?php echo $form->dropDownList($model, 'chi_nhanh_xuat_id', GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'chi_nhanh_xuat_id'); ?>
		</div><!-- row -->

		<!--<label><?php /*echo GxHtml::encode($model->getRelationLabel('tblSanPhams')); */?></label>
		--><?php /*echo $form->checkBoxList($model, 'tblSanPhams', GxHtml::encodeEx(GxHtml::listDataEx(SanPham::model()->findAllAttributes(null, true)), false, true)); */?>

        <div class="btn-save">
            <?php
            echo GxHtml::submitButton(Yii::t('viLib', 'Save'));
            $this->endWidget();
            ?>
        </div>
</div><!-- form -->