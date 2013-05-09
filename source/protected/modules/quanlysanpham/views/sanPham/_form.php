<div class="form">

    <?php if (Yii::app()->user->hasFlash('info-board')) { ?>
        <div
            class="response-msg error ui-corner-all info-board">        <?php echo Yii::app()->user->getFlash('info-board'); ?>    </div><?php } ?>

    <?php $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'san-pham-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">
        <?php echo Yii::t('viLib', 'Fields with'); ?> <span
            class="required">*</span> <?php echo Yii::t('viLib', 'are required'); ?>.
    </p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'ma_vach'); ?>
        <?php echo $form->textField($model, 'ma_vach', array('maxlength' => 15)); ?>
        <?php echo $form->error($model, 'ma_vach'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'ten_san_pham'); ?>
        <?php echo $form->textField($model, 'ten_san_pham', array('maxlength' => 100)); ?>
        <?php echo $form->error($model, 'ten_san_pham'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'ten_tieng_viet'); ?>
        <?php echo $form->textField($model, 'ten_tieng_viet', array('maxlength' => 100)); ?>
        <?php echo $form->error($model, 'ten_tieng_viet'); ?>
    </div>
    <!-- row -->

    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'nha_cung_cap_id'); ?>
        <?php echo $form->dropDownList($model, 'nha_cung_cap_id', GxHtml::listDataEx(NhaCungCap::model()->findAllAttributes(null, true))); ?>
        <?php echo $form->error($model, 'nha_cung_cap_id'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'loai_san_pham_id'); ?>
        <?php echo $form->dropDownList($model, 'loai_san_pham_id', GxHtml::listDataEx(LoaiSanPham::model()->findAllAttributes(null, true))); ?>
        <?php echo $form->error($model, 'loai_san_pham_id'); ?>
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
        <?php echo $form->labelEx($model, 'han_dung'); ?>
        <?php echo $form->textField($model, 'han_dung') . CHtml::encode(' (Tháng)'); ?>
        <?php echo $form->error($model, 'han_dung'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'don_vi_tinh'); ?>
        <?php echo $form->textField($model, 'don_vi_tinh', array('maxlength' => 50)); ?>
        <?php echo $form->error($model, 'don_vi_tinh'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'ton_toi_thieu'); ?>
        <?php echo $form->textField($model, 'ton_toi_thieu'); ?>
        <?php echo $form->error($model, 'ton_toi_thieu'); ?>
    </div>

    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'gia_goc'); ?>
        <?php echo $form->textField($model, 'gia_goc'); ?>
        <?php echo $form->error($model, 'gia_goc'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'huong_dan_su_dung'); ?>
        <?php echo $form->textArea($model, 'huong_dan_su_dung'); ?>
        <?php echo $form->error($model, 'huong_dan_su_dung'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'mo_ta'); ?>
        <?php echo $form->textArea($model, 'mo_ta'); ?>
        <?php echo $form->error($model, 'mo_ta'); ?>
    </div>
    <!-- row -->


    <!--<label><?php /*echo GxHtml::encode($model->getRelationLabel('tblHoaDonBanHangs')); */?></label>
		<?php /*echo $form->checkBoxList($model, 'tblHoaDonBanHangs', GxHtml::encodeEx(GxHtml::listDataEx(HoaDonBanHang::model()->findAllAttributes(null, true)), false, true)); */?>
		<label><?php /*echo GxHtml::encode($model->getRelationLabel('tblHoaDonTraHangs')); */?></label>
		<?php /*echo $form->checkBoxList($model, 'tblHoaDonTraHangs', GxHtml::encodeEx(GxHtml::listDataEx(HoaDonTraHang::model()->findAllAttributes(null, true)), false, true)); */?>
		<label><?php /*echo GxHtml::encode($model->getRelationLabel('tblPhieuNhaps')); */?></label>
		<?php /*echo $form->checkBoxList($model, 'tblPhieuNhaps', GxHtml::encodeEx(GxHtml::listDataEx(PhieuNhap::model()->findAllAttributes(null, true)), false, true)); */?>
		<label><?php /*echo GxHtml::encode($model->getRelationLabel('tblPhieuXuats')); */?></label>
		<?php /*echo $form->checkBoxList($model, 'tblPhieuXuats', GxHtml::encodeEx(GxHtml::listDataEx(PhieuXuat::model()->findAllAttributes(null, true)), false, true)); */?>
		<label><?php /*echo GxHtml::encode($model->getRelationLabel('tblChiNhanhs')); */?></label>
		--><?php /*echo $form->checkBoxList($model, 'tblChiNhanhs', GxHtml::encodeEx(GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true)), false, true)); */ ?>

    <div class="btn-save">
        <?php
        echo GxHtml::submitButton(Yii::t('viLib', 'Save'));
        $this->endWidget();
        ?>
    </div>
</div><!-- form -->