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
            <?php echo $form->label($model, 'ma_nha_cung_cap'); ?>
            <?php echo $form->textField($model, 'ma_nha_cung_cap', array('maxlength' => 15)); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'ten_nha_cung_cap'); ?>
            <?php echo $form->textField($model, 'ten_nha_cung_cap', array('maxlength' => 100)); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'mo_ta'); ?>
            <?php echo $form->textArea($model, 'mo_ta'); ?>
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
            <?php echo $form->label($model, 'fax'); ?>
            <?php echo $form->textField($model, 'fax', array('maxlength' => 15)); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'trang_thai'); ?>
            <?php echo $form->textField($model, 'trang_thai'); ?>
        </div>

        <div class="row buttons btn-search">
        <?php echo GxHtml::submitButton(Yii::t('viLib', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
