<div class="form">

<?php  if(Yii::app()->user->hasFlash('info-board')) {?>    <div class="response-msg error ui-corner-all info-board">        <?php echo Yii::app()->user->getFlash('info-board');?>    </div><?php } ?>

<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'hoa-don-ban-hang-form',
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
		<?php echo $form->labelEx($model,'chiet_khau'); ?>
		<?php echo $form->textField($model, 'chiet_khau'); ?>
		<?php echo $form->error($model,'chiet_khau'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'khach_hang_id'); ?>
		<?php echo $form->textField($model, 'khach_hang_id'); ?>
		<?php echo $form->error($model,'khach_hang_id'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('tblSanPhams')); ?></label>
		<?php echo $form->checkBoxList($model, 'tblSanPhams', GxHtml::encodeEx(GxHtml::listDataEx(SanPham::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('hoaDonTraHangs')); ?></label>
		<?php echo $form->checkBoxList($model, 'hoaDonTraHangs', GxHtml::encodeEx(GxHtml::listDataEx(HoaDonTraHang::model()->findAllAttributes(null, true)), false, true)); ?>

        <div class="btn-save">
            <?php
            echo GxHtml::submitButton(Yii::t('viLib', 'Save'));
            $this->endWidget();
            ?>
        </div>
</div><!-- form -->