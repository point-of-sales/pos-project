<div class="form">

    <?php if (Yii::app()->user->hasFlash('info-board')) { ?>
        <div
            class="response-msg error ui-corner-all info-board">        <?php echo Yii::app()->user->getFlash('info-board'); ?>    </div><?php } ?>

    <?php $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'khach-hang-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">
        <?php echo Yii::t('viLib', 'Fields with'); ?> <span
            class="required">*</span> <?php echo Yii::t('viLib', 'are required'); ?>.
    </p>

    <?php echo $form->errorSummary($model); ?>
    
    <?php
    if($model->ma_khach_hang == 'KHBT'){
        ?>
        
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'ho_ten'); ?>
        <?php echo $form->textField($model, 'ho_ten', array('maxlength' => 200)); ?>
        <?php echo $form->error($model, 'ho_ten'); ?>
    </div>
        
        <?php
    }
    else{
    ?>

    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'ma_khach_hang'); ?>
        <?php echo $form->textField($model, 'ma_khach_hang', array('maxlength' => 10)); ?>
        <?php echo $form->error($model, 'ma_khach_hang'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'ho_ten'); ?>
        <?php echo $form->textField($model, 'ho_ten', array('maxlength' => 200)); ?>
        <?php echo $form->error($model, 'ho_ten'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'loai_khach_hang_id'); ?>
        <?php echo $form->dropDownList($model, 'loai_khach_hang_id', GxHtml::listDataEx(LoaiKhachHang::model()->findAll(),null,"ten_loai")); ?>
        <?php echo $form->error($model, 'loai_khach_hang_id'); ?>
    </div>
    <!-- row -->

    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'ngay_sinh'); ?>
        <?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'ngay_sinh',
            'value' => $model->ngay_sinh,
            'options' => array(
                'showButtonPanel' => true,
                'changeYear' => true,
                'dateFormat' => 'dd-mm-yy',
            ),
        ));; ?>
        <?php echo $form->error($model, 'ngay_sinh'); ?>
    </div>

    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'diem_tich_luy'); ?>
        <?php echo $form->textField($model, 'diem_tich_luy'); ?>
        <?php echo $form->error($model, 'diem_tich_luy'); ?>
    </div>

    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'dia_chi'); ?>
        <?php echo $form->textField($model, 'dia_chi', array('maxlength' => 200)); ?>
        <?php echo $form->error($model, 'dia_chi'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'thanh_pho'); ?>
        <?php echo $form->textField($model, 'thanh_pho', array('maxlength' => 100)); ?>
        <?php echo $form->error($model, 'thanh_pho'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'dien_thoai'); ?>
        <?php echo $form->textField($model, 'dien_thoai', array('maxlength' => 15)); ?>
        <?php echo $form->error($model, 'dien_thoai'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('maxlength' => 100)); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'mo_ta'); ?>
        <?php echo $form->textArea($model, 'mo_ta'); ?>
        <?php echo $form->error($model, 'mo_ta'); ?>
    </div>
    <!-- row -->

<?php
    }
    ?>

    <div class="btn-save">
        <?php
        echo GxHtml::submitButton(Yii::t('viLib', 'Save'));
        $this->endWidget();
        ?>
    </div>
</div><!-- form -->