<div class="wide search-box-form">

    <?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'ma_nhan_vien'); ?>
            <?php echo $form->textField($model, 'ma_nhan_vien', array('maxlength' => 10)); ?>
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
				'dateFormat' => 'dd-mm-yy',
				),
			));
; ?>
        </div>
        
        <div class="row cus-row">
		<?php echo $form->label($model, 'gioi_tinh'); ?>
        <div class="radio-list">
		    <?php echo $form->radioButtonList($model, 'gioi_tinh',$model->getOptions(2,true)); ?>
        </div>
	</div>

                    <div class="row cus-row">
		<?php echo $form->label($model, 'trang_thai'); ?>
        <div class="radio-list">
		    <?php echo $form->radioButtonList($model, 'trang_thai',$model->getOptions(1,true)); ?>
        </div>
	</div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'ngay_vao_lam'); ?>
            <?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'ngay_vao_lam',
			'value' => $model->ngay_vao_lam,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'dd-mm-yy',
				),
			));
; ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'loai_nhan_vien_id'); ?>
            <?php echo $form->dropDownList($model, 'loai_nhan_vien_id', GxHtml::listDataEx(LoaiNhanVien::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('viLib', 'All'))); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'chi_nhanh_id'); ?>
            <?php echo $form->dropDownList($model, 'chi_nhanh_id', GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('viLib', 'All'))); ?>
        </div>

        <div class="row buttons btn-search">
        <?php echo GxHtml::submitButton(Yii::t('viLib', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
