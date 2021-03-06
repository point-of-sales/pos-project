<div class="wide search-box-form">

    <?php $form = $this->beginWidget('GxActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>



    <div class="row cus-row">
        <?php echo $form->label($model, 'ma_nha_cung_cap'); ?>
        <?php echo $form->textField($model, 'ma_nha_cung_cap', array('maxlength' => 15)); ?>
    </div>

    <div class="row cus-row">
        <?php echo $form->label($model, 'ten_nha_cung_cap'); ?>
        <?php echo $form->textField($model, 'ten_nha_cung_cap', array('maxlength' => 100)); ?>
    </div>

    <div class="row cus-row">
        <?php echo $form->label($model, 'trang_thai'); ?>
        <div class="radio-list">
            <?php echo $form->radioButtonList($model, 'trang_thai', $model->layDanhSachTrangThai()); ?>
        </div>
    </div>

    <div class="row buttons btn-search">
        <?php echo GxHtml::submitButton(Yii::t('viLib', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
