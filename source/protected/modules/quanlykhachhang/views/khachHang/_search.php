<div class="wide search-box-form">

    <?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'id'); ?>
            <?php echo $form->textField($model, 'id'); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'ma_khach_hang'); ?>
            <?php echo $form->textField($model, 'ma_khach_hang', array('maxlength' => 10)); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'ho_ten'); ?>
            <?php echo $form->textField($model, 'ho_ten', array('maxlength' => 200)); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'ngay_sinh'); ?>
            <?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'ngay_sinh',
			'value' => $model->ngay_sinh,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
; ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'dia_chi'); ?>
            <?php echo $form->textField($model, 'dia_chi', array('maxlength' => 200)); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'thanh_pho'); ?>
            <?php echo $form->textField($model, 'thanh_pho', array('maxlength' => 100)); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'dien_thoai'); ?>
            <?php echo $form->textField($model, 'dien_thoai', array('maxlength' => 15)); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'email'); ?>
            <?php echo $form->textField($model, 'email', array('maxlength' => 100)); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'mo_ta'); ?>
            <?php echo $form->textArea($model, 'mo_ta'); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'diem_tich_luy'); ?>
            <?php echo $form->textField($model, 'diem_tich_luy'); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'loai_khach_hang_id'); ?>
            <?php echo $form->dropDownList($model, 'loai_khach_hang_id', GxHtml::listDataEx(LoaiKhachHang::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
        </div>

        <div class="row buttons btn-search">
        <?php echo GxHtml::submitButton(Yii::t('viLib', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
