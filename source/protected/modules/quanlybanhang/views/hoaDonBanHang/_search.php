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
        <?php echo $form->label($model, 'chiet_khau'); ?>
        <?php echo $form->textField($model, 'chiet_khau'); ?>
    </div>

    <div class="row cus-row">
        <?php echo $form->label($model, 'khach_hang_id'); ?>
        <?php echo $form->textField($model, 'khach_hang_id'); ?>
    </div>

    <div class="row buttons btn-search">

	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'ma_chung_tu'); ?>
            <?php echo $form->textField($model, 'ma_chung_tu'); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'chiet_khau'); ?>
            <?php echo $form->textField($model, 'chiet_khau'); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'khach_hang_id'); ?>
            <?php echo $form->textField($model, 'khach_hang_id'); ?>
        </div>

        <div class="row buttons btn-search">
>>>>>>> 76ca651a14c3cdfc2680bfde58f607bfa6535fe2
        <?php echo GxHtml::submitButton(Yii::t('viLib', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
