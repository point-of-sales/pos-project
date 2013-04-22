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
            <?php echo $form->label($model, 'ma_chung_tu'); ?>
            <?php echo $form->textField($model, 'ma_chung_tu', array('maxlength' => 15)); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'ngay_lap'); ?>
            <?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'ngay_lap',
			'value' => $model->ngay_lap,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
; ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'tri_gia'); ?>
            <?php echo $form->textField($model, 'tri_gia'); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'ghi_chu'); ?>
            <?php echo $form->textArea($model, 'ghi_chu'); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'nhan_vien_id'); ?>
            <?php echo $form->dropDownList($model, 'nhan_vien_id', GxHtml::listDataEx(NhanVien::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'chi_nhanh_id'); ?>
            <?php echo $form->dropDownList($model, 'chi_nhanh_id', GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
        </div>

        <div class="row buttons btn-search">
        <?php echo GxHtml::submitButton(Yii::t('viLib', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
