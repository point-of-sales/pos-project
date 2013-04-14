<div class="form">

<?php  if(Yii::app()->user->hasFlash('info-board')) {?>    <div class="response-msg error ui-corner-all info-board">        <?php echo Yii::app()->user->getFlash('info-board');?>    </div><?php } ?>

<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'loai-san-pham-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('viLib', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('viLib', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row cus-row">
		<?php echo $form->labelEx($model,'ma_loai'); ?>
		<?php echo $form->textField($model, 'ma_loai', array('maxlength' => 15)); ?>
		<?php echo $form->error($model,'ma_loai'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'ten_loai'); ?>
		<?php echo $form->textField($model, 'ten_loai', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'ten_loai'); ?>
		</div><!-- row -->

		<!--<label><?php /*echo GxHtml::encode($model->getRelationLabel('sanPhams')); */?></label>
		--><?php /*echo $form->checkBoxList($model, 'sanPhams', GxHtml::encodeEx(GxHtml::listDataEx(SanPham::model()->findAllAttributes(null, true)), false, true)); */?>

        <div class="btn-save">
            <?php
            echo GxHtml::submitButton(Yii::t('viLib', 'Save'));
            $this->endWidget();
            ?>
        </div>
</div><!-- form -->