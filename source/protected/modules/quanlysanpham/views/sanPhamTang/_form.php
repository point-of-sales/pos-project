<div class="form">

<?php  if(Yii::app()->user->hasFlash('info-board')) {?>    <div class="response-msg error ui-corner-all info-board">        <?php echo Yii::app()->user->getFlash('info-board');?>    </div><?php } ?>

<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'san-pham-tang-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('viLib', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('viLib', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row cus-row">
		<?php echo $form->labelEx($model,'ma_vach'); ?>
		<?php echo $form->textField($model, 'ma_vach', array('maxlength' => 15)); ?>
		<?php echo $form->error($model,'ma_vach'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'ten_san_pham'); ?>
		<?php echo $form->textField($model, 'ten_san_pham', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'ten_san_pham'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'gia_tang'); ?>
		<?php echo $form->textField($model, 'gia_tang'); ?>
		<?php echo $form->error($model,'gia_tang'); ?>
		</div><!-- row -->
        <div class="row cus-row">
            <?php echo $form->labelEx($model,'trang_thai'); ?>
            <div class="radio-list">
                <?php echo $form->radioButtonList($model, 'trang_thai',$model->layDanhSachTrangThai()); ?>
            </div>
            <?php echo $form->error($model,'trang_thai'); ?>
        </div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'thoi_gian_bat_dau'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'thoi_gian_bat_dau',
			'value' => $model->thoi_gian_bat_dau,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'dd-mm-yy'
                ,
				),
            'htmlOptions'=>array(
                'readonly'=>true,
            ),
			));
; ?>
		<?php echo $form->error($model,'thoi_gian_bat_dau'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'thoi_gian_ket_thuc'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'thoi_gian_ket_thuc',
			'value' => $model->thoi_gian_ket_thuc,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'dd-mm-yy',
				),
            'htmlOptions'=>array(
                'readonly'=>true,
            ),
			));
; ?>
		<?php echo $form->error($model,'thoi_gian_ket_thuc'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'mo_ta'); ?>
		<?php echo $form->textArea($model, 'mo_ta'); ?>
		<?php echo $form->error($model,'mo_ta'); ?>
		</div><!-- row -->

		<!--<label><?php /*echo GxHtml::encode($model->getRelationLabel('tblChiNhanhs')); */?></label>
		--><?php /*echo $form->checkBoxList($model, 'tblChiNhanhs', GxHtml::encodeEx(GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true)), false, true)); */?>

        <div class="btn-save">
            <?php
            echo GxHtml::submitButton(Yii::t('viLib', 'Save'));
            $this->endWidget();
            ?>
        </div>
</div><!-- form -->