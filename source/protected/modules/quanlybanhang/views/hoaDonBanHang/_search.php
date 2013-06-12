<div class="wide search-box-form">

    <?php $form = $this->beginWidget('GxActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>



    <div class="row cus-row">
        <?php echo $form->label($model->getBaseModel(), 'ma_chung_tu'); ?>
        <?php echo $form->textField($model->getBaseModel(), 'ma_chung_tu'); ?>
    </div>

    <div class="row cus-row">
        Khách hàng
        <?php echo $form->textField($model->khachHang, 'ma_khach_hang'); ?>
    </div>

    <div class="row cus-row">
        <?php echo $form->label($model->getBaseModel(), 'chi_nhanh_id'); ?>
        <?php echo $form->dropDownList($model->getBaseModel(), 'chi_nhanh_id',GxHtml::listDataEx(ChiNhanh::model()->findAll('id>1'),null,"ten_chi_nhanh"),array('prompt' => Yii::t('viLib', 'All'))); ?>
    </div>

    <div class="row cus-row">
        Ngày bắt đầu
        <?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model->getBaseModel(),
            'attribute' => 'ngay_lap',
            //'value' => $model->ngay_sinh,
            'options' => array(
                'showButtonPanel' => true,
                'changeYear' => true,
                'dateFormat' => 'dd-mm-yy',
            ),
        ));; ?>
    </div>

    <div class="row cus-row">
        Ngày kết thúc
        <?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name'=>'ngay_ket_thuc',
            //'value' => $model->ngay_sinh,
            'options' => array(
                'showButtonPanel' => true,
                'changeYear' => true,
                'dateFormat' => 'dd-mm-yy',
            ),
        ));; ?>
    </div>

    <div class="row cus-row">
        <?php echo Yii::t('viLib','Return'); ?>
        <div class="radio-list">
            <?php echo $form->radioButtonList($model, 'trang_thai', $model->layDanhSachTrangThai()); ?>
        </div>
    </div>

    <div class="row buttons btn-search">

        <?php echo GxHtml::submitButton(Yii::t('viLib', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>
<!-- search-form -->
