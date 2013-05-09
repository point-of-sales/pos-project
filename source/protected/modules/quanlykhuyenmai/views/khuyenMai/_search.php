<div class="wide search-box-form">

    <?php $form = $this->beginWidget('GxActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>


    <div class="row cus-row">
        <?php echo $form->label($model, 'ma_chuong_trinh'); ?>
        <?php echo $form->textField($model, 'ma_chuong_trinh', array('maxlength' => 15)); ?>
    </div>

    <div class="row cus-row">
        <?php echo $form->label($model, 'ten_chuong_trinh'); ?>
        <?php echo $form->textField($model, 'ten_chuong_trinh', array('maxlength' => 200)); ?>
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
                'dateFormat' => 'dd-mm-yy',
            ),
        ));; ?>
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
                'dateFormat' => 'dd-mm-yy',
            ),
        ));; ?>
    </div>

    <div class="row cus-row">
        <?php echo $form->label($model, 'trang_thai'); ?>
        <div class="radio-list">
        <?php echo $form->radioButtonList($model, 'trang_thai',$model->layDanhSachTrangThai()); ?>
        </div>
    </div>

    <div class="row buttons btn-search">
        <?php echo GxHtml::submitButton(Yii::t('viLib', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
