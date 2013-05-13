<div class="wide search-box-form">

    <?php $form = $this->beginWidget('GxActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>

    <div class="row cus-row">
        <?php echo $form->label($model, 'ma_khach_hang'); ?>
        <?php echo $form->textField($model, 'ma_khach_hang', array('maxlength' => 10)); ?>
    </div>

    <div class="row cus-row">
        <?php echo $form->label($model, 'ho_ten'); ?>
        <?php echo $form->textField($model, 'ho_ten', array('maxlength' => 200)); ?>
    </div>

    <div class="row cus-row">
        <?php echo $form->label($model, 'loai_khach_hang_id'); ?>
        <?php echo $form->dropDownList($model, 'loai_khach_hang_id', GxHtml::listDataEx(LoaiKhachHang::model()->findAll(),null,"ten_loai"), array('prompt' => Yii::t('viLib', 'All'))); ?>
    </div>

    <div class="row buttons btn-search">
        <?php echo GxHtml::submitButton(Yii::t('viLib', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
