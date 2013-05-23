<div class="form">

    <?php if (Yii::app()->user->hasFlash('info-board')) { ?>
        <div
            class="response-msg error ui-corner-all info-board">        <?php echo Yii::app()->user->getFlash('info-board'); ?>    </div><?php } ?>

    <?php $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'thay-doi-mat-khau-form',
        'enableAjaxValidation' => false,

    ));
    ?>

    <p class="note">
        <?php echo Yii::t('viLib', 'Fields with'); ?> <span
            class="required">*</span> <?php echo Yii::t('viLib', 'are required'); ?>.
    </p>

    <?php echo $form->errorSummary($model); ?>

    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model->nhanVien, 'ho_ten'); ?>
        <?php echo $form->textField($model->nhanVien, 'ho_ten', array('maxlength' => 100,'disabled'=>'disabled')); ?>
        <?php echo $form->error($model->nhanVien, 'ho_ten'); ?>
    </div>

    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'mat_khau_moi_1'); ?>
        <?php echo $form->passwordField($model, 'mat_khau_moi_1', array('maxlength' => 100)); ?>
        <?php echo $form->error($model, 'mat_khau_moi_1'); ?>
    </div>

    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'mat_khau_moi_2'); ?>
        <?php echo $form->passwordField($model, 'mat_khau_moi_2', array('maxlength' => 100)); ?>
        <?php echo $form->error($model, 'mat_khau_moi_2'); ?>
    </div>

    <div class="btn-save">
        <?php
        echo GxHtml::submitButton(Yii::t('viLib', 'Save and comeback list'));
        $this->endWidget();
        ?>
    </div>
</div><!-- form -->