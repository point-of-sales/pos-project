<div class="form">

<?php  if(Yii::app()->user->hasFlash('info-board')) {?>    <div class="response-msg error ui-corner-all info-board">        <?php echo Yii::app()->user->getFlash('info-board');?>    </div><?php } ?>

<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'cau-hinh-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('viLib', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('viLib', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

        <div class="row cus-row">
            <?php echo $form->hiddenField($model, 'id'); ?>
        </div><!-- row -->

		<div class="row cus-row">
		<?php echo $form->labelEx($model,'so_muc_tin_tren_trang'); ?>
		<?php echo $form->textField($model, 'so_muc_tin_tren_trang'); ?>
		<?php echo $form->error($model,'so_muc_tin_tren_trang'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'so_luong_ton_canh_bao'); ?>
		<?php echo $form->textField($model, 'so_luong_ton_canh_bao'); ?>
		<?php echo $form->error($model,'so_luong_ton_canh_bao'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'so_ngay_canh_bao_sinh_nhat_khach_hang'); ?>
		<?php echo $form->textField($model, 'so_ngay_canh_bao_sinh_nhat_khach_hang'); ?>
		<?php echo $form->error($model,'so_ngay_canh_bao_sinh_nhat_khach_hang'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'email_ho_tro'); ?>
		<?php echo $form->textField($model, 'email_ho_tro', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'email_ho_tro'); ?>
		</div><!-- row -->


        <div class="btn-save">
            <?php
            echo GxHtml::submitButton(Yii::t('viLib', 'Save'));
            $this->endWidget();
            ?>
        </div>
</div><!-- form -->