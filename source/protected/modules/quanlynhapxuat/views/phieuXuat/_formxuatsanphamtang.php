<div class="form">
    <?php if (Yii::app()->user->hasFlash('info-board')) { ?>
        <div class="response-msg error ui-corner-all info-board">
            <p><?php echo Yii::app()->user->getFlash('info-board'); ?></p>
        </div>
    <?php } ?>

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

    <div class="header-voucher-info">

        <div class="row cus-row">
            <?php echo $form->labelEx($model->baseModel, 'ma_chung_tu'); ?>
            <?php echo $form->textField($model->baseModel, 'ma_chung_tu', array("class" => "readonly-elem", 'style' => 'font-weight:bold')); ?>
            <?php echo $form->error($model->baseModel, 'ma_chung_tu'); ?>
        </div>
        <!-- row -->
        <div class="row cus-row">
            <?php echo $form->labelEx($model->baseModel, 'ngay_lap'); ?>
            <?php /*$form->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model->baseModel,
                'attribute' => 'ngay_lap',
                'value' => (!empty($model->baseModel->ngay_lap)) ? $model->baseModel->ngay_lap : $model->baseModel->setAttribute('ngay_lap', date('d-m-Y', time())),
                'options' => array(
                    'showButtonPanel' => true,
                    'changeYear' => true,
                    'dateFormat' => 'dd-mm-yy',
                ),
            ));; */
            ?>
            <?php echo $form->textField($model->baseModel, 'ngay_lap', array('value' => !empty($model->baseModel->ngay_lap) ? $model->baseModel->ngay_lap : date('d-m-Y', time()), "class" => "readonly-elem")) ?>
            <?php echo $form->error($model->baseModel, 'ngay_lap'); ?>
        </div>

        <div class="row cus-row">
            <?php echo $form->labelEx($model->baseModel, 'nhan_vien_id'); ?>
            <?php echo $form->dropDownList($model->baseModel, 'nhan_vien_id', GxHtml::listDataEx(NhanVien::model()->findAll(), null, "ho_ten"), array("class" => "readonly-elem", "options" => array(Yii::app()->user->id => array("selected" => "selected")))); ?>
            <?php echo $form->error($model->baseModel, 'nhan_vien_id'); ?>
        </div>

        <div class="row cus-row">
            <?php echo $form->labelEx($model->baseModel, 'chi_nhanh_id'); ?>
            <?php echo $form->dropDownList($model->baseModel, 'chi_nhanh_id', GxHtml::listDataEx(ChiNhanh::layDanhSachChiNhanhKichHoatTrongHeThongTheoNguoiDung(), null, "ten_chi_nhanh"), array("options" => array(NhanVien::model()->findByPk(Yii::app()->user->id)->chiNhanh->id => array("selected" => "selected")))); ?>
            <?php echo $form->error($model->baseModel, 'chi_nhanh_id'); ?>
        </div>


        <div class="row cus-row">
            <?php echo $form->labelEx($model, 'chi_nhanh_nhap_id'); ?>
            <?php echo $form->dropDownList($model, 'chi_nhanh_nhap_id', GxHtml::listDataEx(ChiNhanh::layDanhSachChiNhanhKichHoatTrongHeThongTheoNguoiDung(), null, "ten_chi_nhanh")); ?>
            <?php echo $form->error($model, 'chi_nhanh_nhap_id'); ?>
        </div>

        <div class="row cus-row">
            <?php echo $form->labelEx($model, 'loai_xuat_ra'); ?>
            <?php echo $form->dropDownList($model, 'loai_xuat_ra', LoaiNhapXuat::layDanhSachLoaiXuatSanPhamTang()); ?>
            <?php echo $form->error($model, 'loai_xuat_ra'); ?>
        </div>

        <div class="row cus-row">
            <?php echo $form->labelEx($model, 'ly_do_xuat'); ?>
            <?php echo $form->textArea($model, 'ly_do_xuat', array('class' => 'export-reason')); ?>
            <?php echo $form->error($model, 'ly_do_xuat'); ?>
        </div>

        <div class="row cus-row">
            <?php echo $form->labelEx($model->baseModel, 'ghi_chu'); ?>
            <?php echo $form->textArea($model->baseModel, 'ghi_chu', array('class' => 'export-notes')); ?>
            <?php echo $form->error($model->baseModel, 'ghi_chu'); ?>
        </div>
    </div>

    <div class="product-voucher-info">
        <div class="row cus-row">
            <?php echo GxHtml::label(Yii::t('viLib', 'Barcode'), 'barcode') ?>
            <?php echo GxHtml::textField('barcode', '', array('onkeypress' => 'keypressInputMa(event)')) ?>
        </div>

        <div class="row cus-row">
            <?php echo GxHtml::label(Yii::t('viLib', 'Product name'), 'ten_san_pham') ?>
            <?php echo GxHtml::textField('productname', '', array('readOnly' => 'readOnly')) ?>
        </div>

        <div class="row cus-row">
            <?php echo GxHtml::label(Yii::t('viLib', 'Quantity'), 'quantity') ?>
            <?php echo GxHtml::textField('quantity', 0, array('class' => 'number', 'onkeypress' => 'keypressInputMa(event)')) ?>
        </div>

        <div class="row cus-row">
            <?php echo GxHtml::label(Yii::t('viLib', 'Bill value for offering'), 'gift-price') ?>
            <?php echo GxHtml::textField('price', 0, array('class' => 'number', 'onkeypress' => 'keypressInputMa(event)')) ?>
        </div>

    </div>

    <div class="detail-voucher">
        <div id="grid" class="grid-view">
            <table id="items" class="items">
                <tr>
                    <th id="grid_c0"><?php echo Yii::t('viLib', 'Barcode') ?></th>
                    <th id="grid_c1"><?php echo Yii::t('viLib', 'Product name') ?></th>
                    <th id="grid_c2"><?php echo Yii::t('viLib', 'Quantity') ?></th>
                    <th id="grid_c3"><?php echo Yii::t('viLib', 'Gift price') ?></th>
                    <th id="grid_c4" class="button-column"></th>
                </tr>
            </table>
        </div>
    </div>

    <div class="clear"></div>

    <div class="btn-save">
        <?php
        echo GxHtml::submitButton(Yii::t('viLib', 'Save'), array('onclick' => 'return reCheckBeforeSent()'));
        $this->endWidget();
        ?>
    </div>
</div><!-- form -->