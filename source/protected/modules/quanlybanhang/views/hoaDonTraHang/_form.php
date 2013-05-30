<div class="form">

<?php  if(Yii::app()->user->hasFlash('info-board')) {?>    <div class="response-msg error ui-corner-all info-board">        <?php echo Yii::app()->user->getFlash('info-board');?>    </div><?php } ?>

<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'hoa-don-tra-hang-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('viLib', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('viLib', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row cus-row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->dropDownList($model, 'id', GxHtml::listDataEx(ChungTu::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'id'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'ly_do_tra_hang'); ?>
		<?php echo $form->textArea($model, 'ly_do_tra_hang'); ?>
		<?php echo $form->error($model,'ly_do_tra_hang'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'hoa_don_ban_id'); ?>
		<?php echo $form->dropDownList($model, 'hoa_don_ban_id', GxHtml::listDataEx(HoaDonBanHang::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'hoa_don_ban_id'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('tblSanPhams')); ?></label>
		<?php echo $form->checkBoxList($model, 'tblSanPhams', GxHtml::encodeEx(GxHtml::listDataEx(SanPham::model()->findAllAttributes(null, true)), false, true)); ?>

        <div class="btn-save">
            <?php
            echo GxHtml::submitButton(Yii::t('viLib', 'Save'));
            $this->endWidget();
            ?>
        </div>
</div><!-- form -->