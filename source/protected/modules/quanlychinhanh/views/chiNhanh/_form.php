<div class="form">


    <?php  if(Yii::app()->user->hasFlash('dup-error')) { ?>
        <div class="response-msg error ui-corner-all">
            <?php echo Yii::app()->user->getFlash('dup-error');?>
        </div>

    <?php } ?>

    <?php $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'chi-nhanh-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">
        <?php echo Yii::t('app', 'Fields with'); ?> <span
            class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
    </p>

    <?php echo $form->errorSummary($model); ?>

        <div class="row cus-row">
            <?php echo $form->labelEx($model, 'ma_chi_nhanh'); ?>
            <?php echo $form->textField($model, 'ma_chi_nhanh', array('maxlength' => 15)); ?>
            <?php echo $form->error($model, 'ma_chi_nhanh'); ?>
        </div>
        <!-- row -->
        <div class="row cus-row">
            <?php echo $form->labelEx($model, 'ten_chi_nhanh'); ?>
            <?php echo $form->textField($model, 'ten_chi_nhanh', array('maxlength' => 100)); ?>
            <?php echo $form->error($model, 'ten_chi_nhanh'); ?>
        </div>
        <!-- row -->
        <div class="row cus-row">
            <?php echo $form->labelEx($model, 'dia_chi'); ?>
            <?php echo $form->textField($model, 'dia_chi', array('maxlength' => 100)); ?>
            <?php echo $form->error($model, 'dia_chi'); ?>
        </div>
        <!-- row cus-row -->
        <div class="row cus-row">
            <?php echo $form->labelEx($model, 'dien_thoai'); ?>
            <?php echo $form->textField($model, 'dien_thoai', array('maxlength' => 15)); ?>
            <?php echo $form->error($model, 'dien_thoai'); ?>
        </div>
        <!-- row cus-row -->
        <div class="row cus-row">
            <?php echo $form->labelEx($model, 'fax'); ?>
            <?php echo $form->textField($model, 'fax', array('maxlength' => 15)); ?>
            <?php echo $form->error($model, 'fax'); ?>
        </div>
        <!-- row cus-row -->
        <div class="row cus-row">
            <?php echo $form->labelEx($model, 'mo_ta'); ?>
            <?php echo $form->textArea($model, 'mo_ta'); ?>
            <?php echo $form->error($model, 'mo_ta'); ?>
        </div>
        <!-- row cus-row -->
        <div class="row cus-row">

            <?php echo $form->labelEx($model, 'trang_thai',array('value'=>'Kích hoạt')); ?>
            <div class="radio-list">
                <?php echo $form->radioButtonList($model, 'trang_thai',$model->getStatusOptions());?>
            </div>
            <?php echo $form->error($model, 'trang_thai'); ?>
        </div>
        <!-- row cus-row -->
        <div class="row cus-row">
            <?php echo $form->labelEx($model, 'truc_thuoc_id'); ?>
            <?php echo $form->dropDownList($model, 'truc_thuoc_id', $model->getUnderOptions()); ?>
            <?php echo $form->error($model, 'truc_thuoc_id'); ?>
        </div>
        <!-- row cus-row -->
        <div class="row cus-row">
            <?php echo $form->labelEx($model, 'khu_vuc_id'); ?>
            <?php echo $form->dropDownList($model, 'khu_vuc_id', $model->getAreaOptions()); ?>
            <?php echo $form->error($model, 'khu_vuc_id'); ?>
        </div>
        <!-- row cus-row -->
        <div class="row cus-row">
            <?php echo $form->labelEx($model, 'loai_chi_nhanh_id'); ?>
            <?php echo $form->dropDownList($model, 'loai_chi_nhanh_id', $model->getTypeOptions()); ?>
            <?php echo $form->error($model, 'loai_chi_nhanh_id'); ?>
        </div>
        <!-- row cus-row -->


        <!--<label><?php /*echo GxHtml::encode($model->getRelationLabel('chungTus')); */?></label>
		<?php /*echo $form->checkBoxList($model, 'chungTus', GxHtml::encodeEx(GxHtml::listDataEx(ChungTu::model()->findAllAttributes(null, true)), false, true)); */?>
		<label><?php /*echo GxHtml::encode($model->getRelationLabel('khuyenMais')); */?></label>
		<?php /*echo $form->checkBoxList($model, 'khuyenMais', GxHtml::encodeEx(GxHtml::listDataEx(KhuyenMai::model()->findAllAttributes(null, true)), false, true)); */?>
		<label><?php /*echo GxHtml::encode($model->getRelationLabel('tblKhuyenMais')); */?></label>
		<?php /*echo $form->checkBoxList($model, 'tblKhuyenMais', GxHtml::encodeEx(GxHtml::listDataEx(KhuyenMai::model()->findAllAttributes(null, true)), false, true)); */?>
		<label><?php /*echo GxHtml::encode($model->getRelationLabel('nhanViens')); */?></label>
		<?php /*echo $form->checkBoxList($model, 'nhanViens', GxHtml::encodeEx(GxHtml::listDataEx(NhanVien::model()->findAllAttributes(null, true)), false, true)); */?>
		<label><?php /*echo GxHtml::encode($model->getRelationLabel('phieuNhaps')); */?></label>
		<?php /*echo $form->checkBoxList($model, 'phieuNhaps', GxHtml::encodeEx(GxHtml::listDataEx(PhieuNhap::model()->findAllAttributes(null, true)), false, true)); */?>
		<label><?php /*echo GxHtml::encode($model->getRelationLabel('phieuXuats')); */?></label>
		<?php /*echo $form->checkBoxList($model, 'phieuXuats', GxHtml::encodeEx(GxHtml::listDataEx(PhieuXuat::model()->findAllAttributes(null, true)), false, true)); */?>
		<label><?php /*echo GxHtml::encode($model->getRelationLabel('tblSanPhams')); */?></label>
		<?php /*echo $form->checkBoxList($model, 'tblSanPhams', GxHtml::encodeEx(GxHtml::listDataEx(SanPham::model()->findAllAttributes(null, true)), false, true)); */?>
		<label><?php /*echo GxHtml::encode($model->getRelationLabel('tblSanPhamTangs')); */?></label>
		--><?php /*echo $form->checkBoxList($model, 'tblSanPhamTangs', GxHtml::encodeEx(GxHtml::listDataEx(SanPhamTang::model()->findAllAttributes(null, true)), false, true)); */?>

        <div class="btn-save">
            <?php

            echo GxHtml::submitButton(Yii::t('viLib', 'Save'));
            $this->endWidget();
            ?>
        </div>

</div><!-- form -->
