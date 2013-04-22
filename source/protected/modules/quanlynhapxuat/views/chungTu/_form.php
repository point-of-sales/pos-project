<div class="form">

    <?php
        //print_r($model->phieuNhap->getRelated('tblSanPhams'));exit;
    ?>

    <?php if (Yii::app()->user->hasFlash('info-board')) { ?>
        <div
            class="response-msg error ui-corner-all info-board">        <?php echo Yii::app()->user->getFlash('info-board'); ?>    </div><?php } ?>

    <?php $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'chung-tu-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">
        <?php echo Yii::t('viLib', 'Fields with'); ?> <span
            class="required">*</span> <?php echo Yii::t('viLib', 'are required'); ?>.
    </p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'ma_chung_tu'); ?>
        <?php echo $form->textField($model, 'ma_chung_tu', array('maxlength' => 15)); ?>
        <?php echo $form->error($model, 'ma_chung_tu'); ?>
    </div>
    <!-- row -->

    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'ngay_lap'); ?>
        <?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'ngay_lap',
            'value' => $model->ngay_lap,
            'options' => array(
                'showButtonPanel' => true,
                'changeYear' => true,
                'dateFormat' => 'yy-mm-dd',
            ),
        ));; ?>
        <?php echo $form->error($model, 'ngay_lap'); ?>
    </div>
    <!-- row -->

    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'nhan_vien_id'); ?>
        <?php echo $form->dropDownList($model, 'nhan_vien_id', GxHtml::listDataEx(NhanVien::model()->findAllAttributes(null, true))); ?>
        <?php echo $form->error($model, 'nhan_vien_id'); ?>
    </div>
    <!-- row -->

    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'chi_nhanh_id'); ?>
        <?php echo $form->dropDownList($model, 'chi_nhanh_id', GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true))); ?>
        <?php echo $form->error($model, 'chi_nhanh_id'); ?>
    </div>
    <!-- row -->

    <div class="row cus-row">
        <?php echo $form->labelEx($model->phieuNhap, 'chi_nhanh_xuat_id'); ?>
        <?php echo $form->dropDownList($model->phieuNhap, 'chi_nhanh_xuat_id', GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true))); ?>
        <?php echo $form->error($model->phieuNhap, 'chi_nhanh_xuat_id'); ?>
    </div>
    <!-- row -->

    <div class="row cus-row">
        <?php echo $form->labelEx($model->phieuNhap, 'loai_nhap_vao'); ?>
        <?php echo $form->dropDownList($model->phieuNhap, 'loai_nhap_vao', GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true))); ?>
        <?php echo $form->error($model->phieuNhap, 'loai_nhap_vao'); ?>
    </div>
    <!-- row -->

    <div class="row cus-row">
        <?php //echo $form->labelEx($model->phieuNhap->tblSanPhams, 'id'); ?>
        <?php echo $form->checkBoxList($model->phieuNhap, 'tblSanPhams', GxHtml::encodeEx(GxHtml::listDataEx(SanPham::model()->findAllAttributes(null, true)), false, true)); ?>
        <?php //echo $form->error($model->phieuNhap->tblSanPhams, 'id'); ?>
    </div>
    <!-- row -->


    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'tri_gia'); ?>
        <?php echo $form->textField($model, 'tri_gia'); ?>
        <?php echo $form->error($model, 'tri_gia'); ?>
    </div>
    <!-- row -->

    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'ghi_chu'); ?>
        <?php echo $form->textArea($model, 'ghi_chu'); ?>
        <?php echo $form->error($model, 'ghi_chu'); ?>
    </div>
    <!-- row -->

    <div class="clear"></div>

    <div class="btn-save">
        <?php
        echo GxHtml::submitButton(Yii::t('viLib', 'Save'));
        $this->endWidget();
        ?>
    </div>
</div><!-- form -->