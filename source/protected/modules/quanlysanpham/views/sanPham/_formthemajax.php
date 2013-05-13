<script>
   $('.error-modal').hide();
   $('.success-modal').hide();
   function resetInputs() {
       $('#SanPham_ma_vach').val('');
       $('#SanPham_ten_san_pham').val('');
       $('#SanPham_han_dung').val('');
       $('#SanPham_don_vi_tinh').val('');
       $('#SanPham_ton_toi_thieu').val('');
       $('#SanPham_gia_goc').val('');


   }

</script>

<div class="form" id="new-product-form-dialog">

    <?php $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'san-pham-form',
        'enableAjaxValidation' => false,
       /* 'clientOptions'=>array(
            'validateOnSubmit'=>true,
        )*/
    ));
    ?>
    <div class="response-msg error ui-corner-all error-modal"></div>
    <div class="response-msg success ui-corner-all success-modal"></div>

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
        <?php echo $form->labelEx($model, 'nha_cung_cap_id'); ?>
        <?php echo $form->dropDownList($model, 'nha_cung_cap_id', GxHtml::listDataEx(NhaCungCap::model()->findAll(), null, "ten_nha_cung_cap")); ?>
        <?php echo $form->error($model, 'nha_cung_cap_id'); ?>
    </div>
    <!-- row -->
    <div class="row cus-row">
        <?php echo $form->labelEx($model, 'loai_san_pham_id'); ?>
        <?php echo $form->dropDownList($model, 'loai_san_pham_id', GxHtml::listDataEx(LoaiSanPham::model()->findAll(), null, "ten_loai")); ?>
        <?php echo $form->error($model, 'loai_san_pham_id'); ?>
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
    <div class="clear"></div>

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


        <div class="row buttons">
            <?php
            /*echo GxHtml::submitButton(Yii::t('viLib', 'Save'));*/
            echo CHtml::ajaxSubmitButton(Yii::t('viLib', 'Save'), CHtml::normalizeUrl(array('/quanlysanpham/sanPham/themajax', 'render' => false)),
                                        array('success' => 'js: function(response) {
                                            switch(response) {
                                                case "ok": {
                                                    $(".success-modal p").remove();
                                                    $(".success-modal").append("<p>Thêm mới thành công</p>");
                                                    $(".success-modal").show();
                                                    $(".success-modal").fadeOut(5000);
                                                    resetInputs();
                                                    break;
                                                }
                                                case "dup-error": {
                                                    $(".error-modal p").remove();
                                                    $(".error-modal").append("<p>Dữ liệu đã tồn tại xin vui lòng nhập dữ liệu khác</p>");
                                                    $(".error-modal").show();
                                                    $(".error-modal").fadeOut(5000);
                                                    break;
                                                }
                                                case "fail": {
                                                    $(".error-modal p").remove();
                                                    $(".error-modal").append("<p>Có lỗi xảy ra. Vui lòng kiểm tra dữ liệu nhập hoặc liên hệ với quản trị viên để được giúp đỡ</p>");
                                                    $(".error-modal").show();
                                                    $(".error-modal").fadeOut(5000);
                                                    break;
                                                }
                                            }
                                        }'),
                                        array('id' => 'closeDialog'));

            $this->endWidget();
            ?>
        </div>
    </div>
</div><!-- form -->