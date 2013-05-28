<div class="form">

    <?php if (Yii::app()->user->hasFlash('info-board')) { ?>
        <div
            class="response-msg error ui-corner-all info-board">        <?php echo Yii::app()->user->getFlash('info-board'); ?>    </div><?php } ?>

    <?php $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'thong-tin-cong-ty-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">
        <?php echo Yii::t('viLib', 'Fields with'); ?> <span
            class="required">*</span> <?php echo Yii::t('viLib', 'are required'); ?>.
    </p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row cus-row">
        <?php echo $form->hiddenField($model, 'id'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'ten_cong_ty'); ?>
        <?php echo $form->textField($model, 'ten_cong_ty', array('maxlength' => 100)); ?>
        <?php echo $form->error($model, 'ten_cong_ty'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'dia_chi'); ?>
        <?php echo $form->textField($model, 'dia_chi', array('maxlength' => 100)); ?>
        <?php echo $form->error($model, 'dia_chi'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'dien_thoai'); ?>
        <?php echo $form->textField($model, 'dien_thoai', array('maxlength' => 15)); ?>
        <?php echo $form->error($model, 'dien_thoai'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'fax'); ?>
        <?php echo $form->textField($model, 'fax', array('maxlength' => 15)); ?>
        <?php echo $form->error($model, 'fax'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('maxlength' => 100)); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'website'); ?>
        <?php echo $form->textField($model, 'website', array('maxlength' => 100)); ?>
        <?php echo $form->error($model, 'website'); ?>
    </div>
    <!-- row -->


    <div class="btn-save">
        <?php
        echo GxHtml::submitButton(Yii::t('viLib', 'Save'));
        $this->endWidget();
        ?>
    </div>
</div><!-- form -->