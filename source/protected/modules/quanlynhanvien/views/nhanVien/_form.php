<div class="form">

    <?php if (Yii::app()->user->hasFlash('info-board')) { ?>
        <div
            class="response-msg error ui-corner-all info-board">        <?php echo Yii::app()->user->getFlash('info-board'); ?>    </div><?php } ?>

    <?php $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'nhan-vien-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">
        <?php echo Yii::t('viLib', 'Fields with'); ?> <span
            class="required">*</span> <?php echo Yii::t('viLib', 'are required'); ?>.
    </p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'ma_nhan_vien'); ?>
        <?php echo $form->textField($model, 'ma_nhan_vien', array('maxlength' => 10)); ?>
        <?php echo $form->error($model, 'ma_nhan_vien'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'ho_ten'); ?>
        <?php echo $form->textField($model, 'ho_ten', array('maxlength' => 200)); ?>
        <?php echo $form->error($model, 'ho_ten'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'chi_nhanh_id'); ?>
        <?php echo $form->dropDownList($model, 'chi_nhanh_id', GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true))); ?>
        <?php echo $form->error($model, 'chi_nhanh_id'); ?>
    </div>

    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'loai_nhan_vien_id'); ?>
        <?php echo $form->dropDownList($model, 'loai_nhan_vien_id', GxHtml::listDataEx(LoaiNhanVien::model()->findAllAttributes(null, true))); ?>
        <?php echo $form->error($model, 'loai_nhan_vien_id'); ?>
    </div>
    <!-- row -->

    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('maxlength' => 100)); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'dien_thoai'); ?>
        <?php echo $form->textField($model, 'dien_thoai', array('maxlength' => 12)); ?>
        <?php echo $form->error($model, 'dien_thoai'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'dia_chi'); ?>
        <?php echo $form->textField($model, 'dia_chi', array('maxlength' => 200)); ?>
        <?php echo $form->error($model, 'dia_chi'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'gioi_tinh'); ?>
        <div class="radio-list">
            <?php echo $form->radioButtonList($model, 'gioi_tinh', $model->layDanhSachGioiTinh()); ?>
        </div>
        <?php echo $form->error($model, 'gioi_tinh'); ?>
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
        <?php echo $form->labelEx($model, 'trinh_do'); ?>
        <?php echo $form->textField($model, 'trinh_do', array('maxlength' => 100)); ?>
        <?php echo $form->error($model, 'trinh_do'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'luong_co_ban'); ?>
        <?php echo $form->textField($model, 'luong_co_ban'); ?>
        <?php echo $form->error($model, 'luong_co_ban'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'chuyen_mon'); ?>
        <?php echo $form->textField($model, 'chuyen_mon', array('maxlength' => 200)); ?>
        <?php echo $form->error($model, 'chuyen_mon'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'trang_thai'); ?>
        <div class="radio-list">
            <?php echo $form->radioButtonList($model, 'trang_thai', $model->layDanhSachTrangThai()); ?>
        </div>
        <?php echo $form->error($model, 'trang_thai'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'mat_khau'); ?>
        <?php echo $form->passwordField($model, 'mat_khau', array('maxlength' => 100)); ?>
        <?php echo $form->error($model, 'mat_khau'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'ngay_vao_lam'); ?>
        <?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'ngay_vao_lam',
            'value' => $model->ngay_vao_lam,
            'options' => array(
                'showButtonPanel' => true,
                'changeYear' => true,
                'dateFormat' => 'dd-mm-yy',
            ),
        ));; ?>
        <?php echo $form->error($model, 'ngay_vao_lam'); ?>
    </div>
    <!-- row -->


    <div class="btn-save">
        <?php
        echo GxHtml::submitButton(Yii::t('viLib', 'Save'));
        $this->endWidget();
        ?>
    </div>
</div><!-- form -->