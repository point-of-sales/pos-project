<div class="form">

    

<?php $form = $this->beginWidget('GxActiveForm', array(
    'id' => 'nhan-vien-form',
    'enableAjaxValidation' => false,
    ));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo
Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>
<<<<<<< HEAD

		<div class="row cus-row">
		<?php echo $form->labelEx($model,'ma_nhan_vien'); ?>
=======
<div class="form-add-content">
		<div class="row">
		<?php echo $form->labelEx($model, 'ma_nhan_vien'); ?>
>>>>>>> cc04ae6b14d1e9954bc50c540b31af7101184802
		<?php echo $form->textField($model, 'ma_nhan_vien', array('maxlength' => 10)); ?>
		<?php echo $form->error($model, 'ma_nhan_vien'); ?>
		</div><!-- row -->
<<<<<<< HEAD
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'ho_ten'); ?>
=======
		<div class="row">
		<?php echo $form->labelEx($model, 'ho_ten'); ?>
>>>>>>> cc04ae6b14d1e9954bc50c540b31af7101184802
		<?php echo $form->textField($model, 'ho_ten', array('maxlength' => 200)); ?>
		<?php echo $form->error($model, 'ho_ten'); ?>
		</div><!-- row -->
<<<<<<< HEAD
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'email'); ?>
=======
		<div class="row">
		<?php echo $form->labelEx($model, 'email'); ?>
>>>>>>> cc04ae6b14d1e9954bc50c540b31af7101184802
		<?php echo $form->textField($model, 'email', array('maxlength' => 100)); ?>
		<?php echo $form->error($model, 'email'); ?>
		</div><!-- row -->
<<<<<<< HEAD
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'dien_thoai'); ?>
=======
		<div class="row">
		<?php echo $form->labelEx($model, 'dien_thoai'); ?>
>>>>>>> cc04ae6b14d1e9954bc50c540b31af7101184802
		<?php echo $form->textField($model, 'dien_thoai', array('maxlength' => 12)); ?>
		<?php echo $form->error($model, 'dien_thoai'); ?>
		</div><!-- row -->
<<<<<<< HEAD
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'dia_chi'); ?>
=======
		<div class="row">
		<?php echo $form->labelEx($model, 'dia_chi'); ?>
>>>>>>> cc04ae6b14d1e9954bc50c540b31af7101184802
		<?php echo $form->textField($model, 'dia_chi', array('maxlength' => 200)); ?>
		<?php echo $form->error($model, 'dia_chi'); ?>
		</div><!-- row -->
<<<<<<< HEAD
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'gioi_tinh'); ?>
		<?php echo $form->textField($model, 'gioi_tinh'); ?>
		<?php echo $form->error($model,'gioi_tinh'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'ngay_sinh'); ?>
=======
		<div class="row">
        <?php echo $form->labelEx($model, 'gioi_tinh'); ?>
        <div class="radio-list">
        <?php echo $form->radioButtonList($model, 'gioi_tinh', $model->getSex()) ?>
        </div>
		<?php echo $form->error($model, 'gioi_tinh'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model, 'ngay_sinh'); ?>
>>>>>>> cc04ae6b14d1e9954bc50c540b31af7101184802
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
    'model' => $model,
    'attribute' => 'ngay_sinh',
    'value' => $model->ngay_sinh,
    'options' => array(
        'showButtonPanel' => true,
        'changeYear' => true,
        'dateFormat' => 'dd/mm/yy',
        ),
    ));
; ?>
		<?php echo $form->error($model, 'ngay_sinh'); ?>
		</div><!-- row -->
<<<<<<< HEAD
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'trinh_do'); ?>
=======
		<div class="row">
		<?php echo $form->labelEx($model, 'trinh_do'); ?>
>>>>>>> cc04ae6b14d1e9954bc50c540b31af7101184802
		<?php echo $form->textField($model, 'trinh_do', array('maxlength' => 100)); ?>
		<?php echo $form->error($model, 'trinh_do'); ?>
		</div><!-- row -->
<<<<<<< HEAD
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'luong_co_ban'); ?>
=======
		<div class="row">
		<?php echo $form->labelEx($model, 'luong_co_ban'); ?>
>>>>>>> cc04ae6b14d1e9954bc50c540b31af7101184802
		<?php echo $form->textField($model, 'luong_co_ban'); ?>
		<?php echo $form->error($model, 'luong_co_ban'); ?>
		</div><!-- row -->
<<<<<<< HEAD
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'chuyen_mon'); ?>
		<?php echo $form->textField($model, 'chuyen_mon', array('maxlength' => 200)); ?>
		<?php echo $form->error($model,'chuyen_mon'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'trang_thai'); ?>
		<?php echo $form->textField($model, 'trang_thai'); ?>
		<?php echo $form->error($model,'trang_thai'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'mat_khau'); ?>
		<?php echo $form->textField($model, 'mat_khau', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'mat_khau'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'ngay_vao_lam'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'ngay_vao_lam',
			'value' => $model->ngay_vao_lam,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
; ?>
		<?php echo $form->error($model,'ngay_vao_lam'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'lan_dang_nhap_cuoi'); ?>
=======
		<div class="row">
		<?php echo $form->labelEx($model, 'chuyen_mon'); ?>
		<?php echo $form->textField($model, 'chuyen_mon', array('maxlength' => 200)); ?>
		<?php echo $form->error($model, 'chuyen_mon'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model, 'trang_thai'); ?>
		<?php echo $form->checkBox($model, 'trang_thai'); ?>
		<?php echo $form->error($model, 'trang_thai'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model, 'mat_khau'); ?>
		<?php echo $form->passwordField($model, 'mat_khau', array('maxlength' => 100)); ?>
		<?php echo $form->error($model, 'mat_khau'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model, 'ngay_vao_lam'); ?>
>>>>>>> cc04ae6b14d1e9954bc50c540b31af7101184802
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
    'model' => $model,
    'attribute' => 'ngay_vao_lam',
    'value' => $model->ngay_vao_lam,
    'options' => array(
        'showButtonPanel' => true,
        'changeYear' => true,
        'dateFormat' => 'yy-mm-dd',
        ),
    ));
; ?>
<<<<<<< HEAD
		<?php echo $form->error($model,'lan_dang_nhap_cuoi'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'loai_nhan_vien_id'); ?>
		<?php echo $form->dropDownList($model, 'loai_nhan_vien_id', GxHtml::listDataEx(LoaiNhanVien::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'loai_nhan_vien_id'); ?>
		</div><!-- row -->
		<div class="row cus-row">
		<?php echo $form->labelEx($model,'chi_nhanh_id'); ?>
		<?php echo $form->dropDownList($model, 'chi_nhanh_id', GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'chi_nhanh_id'); ?>
=======
		<?php echo $form->error($model, 'ngay_vao_lam'); ?>
		</div>
		<div class="row">
		<?php echo $form->labelEx($model, 'loai_nhan_vien_id'); ?>
		<?php echo $form->dropDownList($model, 'loai_nhan_vien_id', GxHtml::
listDataEx(LoaiNhanVien::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model, 'loai_nhan_vien_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model, 'chi_nhanh_id'); ?>
		<?php echo $form->dropDownList($model, 'chi_nhanh_id', GxHtml::listDataEx(ChiNhanh::
model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model, 'chi_nhanh_id'); ?>
>>>>>>> cc04ae6b14d1e9954bc50c540b31af7101184802
		</div><!-- row -->

		<label><?php //echo GxHtml::encode($model->getRelationLabel('chungTus')); ?></label>
		<?php //echo $form->checkBoxList($model, 'chungTus', GxHtml::encodeEx(GxHtml::listDataEx(ChungTu::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php //echo GxHtml::encode($model->getRelationLabel('tblQuyens')); ?></label>
		<?php //echo $form->checkBoxList($model, 'tblQuyens', GxHtml::encodeEx(GxHtml::listDataEx(Quyen::model()->findAllAttributes(null, true)), false, true)); ?>

<<<<<<< HEAD
        <div class="btn-save">
            <?php
            echo GxHtml::submitButton(Yii::t('viLib', 'Save'));
            $this->endWidget();
            ?>
        </div>
=======
<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div>
>>>>>>> cc04ae6b14d1e9954bc50c540b31af7101184802
</div><!-- form -->