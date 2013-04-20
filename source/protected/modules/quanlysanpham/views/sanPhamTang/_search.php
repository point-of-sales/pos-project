<div class="wide search-box-form">

    <?php $form = $this->beginWidget('GxActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>


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

    <div class="row buttons btn-search">
        <?php echo GxHtml::submitButton(Yii::t('viLib', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
