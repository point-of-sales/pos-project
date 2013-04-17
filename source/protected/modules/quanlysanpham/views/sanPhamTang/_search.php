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
            <?php echo $form->label($model, 'ma_vach'); ?>
            <?php echo $form->textField($model, 'ma_vach', array('maxlength' => 15)); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'ten_san_pham'); ?>
            <?php echo $form->textField($model, 'ten_san_pham', array('maxlength' => 100)); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'gia_tang'); ?>
            <?php echo $form->textField($model, 'gia_tang'); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'thoi_gian_bat_dau'); ?>
            <?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'thoi_gian_bat_dau',
			'value' => $model->thoi_gian_bat_dau,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
; ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'thoi_gian_ket_thuc'); ?>
            <?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'thoi_gian_ket_thuc',
			'value' => $model->thoi_gian_ket_thuc,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
; ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'mo_ta'); ?>
            <?php echo $form->textArea($model, 'mo_ta'); ?>
        </div>

        <div class="row buttons btn-search">
        <?php echo GxHtml::submitButton(Yii::t('viLib', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
