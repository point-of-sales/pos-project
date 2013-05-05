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
            <?php echo $form->textField($model->baseModel, 'ma_chung_tu'); ?>
            <?php echo $form->error($model->baseModel, 'ma_chung_tu'); ?>
        </div>
        <!-- row -->
        <div class="row cus-row">
            <?php echo $form->labelEx($model->baseModel, 'ngay_lap'); ?>
            <?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model->baseModel,
                'attribute' => 'ngay_lap',
                'value' => (!empty($model->baseModel->ngay_lap)) ? $model->baseModel->ngay_lap : $model->baseModel->setAttribute('ngay_lap', date('d-m-Y', time())),
                'options' => array(
                    'showButtonPanel' => true,
                    'changeYear' => true,
                    'dateFormat' => 'dd-mm-yy',
                ),
            ));; ?>
            <?php echo $form->error($model->baseModel, 'ngay_lap'); ?>
        </div>

        <div class="row cus-row">
            <?php echo $form->labelEx($model->baseModel, 'nhan_vien_id'); ?>
            <?php echo $form->dropDownList($model->baseModel, 'nhan_vien_id', GxHtml::listDataEx(NhanVien::model()->findAllAttributes(null, true))); ?>
            <?php echo $form->error($model->baseModel, 'nhan_vien_id'); ?>
        </div>

        <div class="row cus-row">
            <?php echo $form->labelEx($model->baseModel, 'chi_nhanh_id'); ?>
            <?php echo $form->dropDownList($model->baseModel, 'chi_nhanh_id', GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true)),array("options"=>array($id=>array("selected"=>"selected")))); ?>
            <?php echo $form->error($model->baseModel, 'chi_nhanh_id'); ?>
        </div>

        <div class="row cus-row">
            <?php echo $form->labelEx($model->baseModel, 'tri_gia'); ?>
            <?php
            if (!empty($model->baseModel->tri_gia))
                echo $form->textField($model->baseModel, 'tri_gia', array('class'=>'number','readOnly' => 'readOnly')) . ' ' . Yii::t('viLib', 'Currency');
            else

                echo $form->textField($model->baseModel, 'tri_gia', array('class'=>'number','value' => '0', 'readOnly' => 'readOnly')) . ' ' . Yii::t('viLib', 'Currency'); ?>
            <?php echo $form->error($model->baseModel, 'tri_gia'); ?>
        </div>


        <div class="row cus-row">
            <?php echo $form->labelEx($model, 'chi_nhanh_xuat_id'); ?>
            <?php echo $form->dropDownList($model, 'chi_nhanh_xuat_id', GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true))); ?>
            <?php echo $form->error($model, 'chi_nhanh_xuat_id'); ?>
        </div>

        <div class="row cus-row">
            <?php echo $form->labelEx($model, 'loai_nhap_vao'); ?>
            <?php echo $form->dropDownList($model, 'loai_nhap_vao',$model->layDanhSachLoaiNhap()); ?>
            <?php echo $form->error($model, 'loai_nhap_vao'); ?>
        </div>

        <div class="row cus-row">
            <?php echo $form->labelEx($model->baseModel, 'ghi_chu'); ?>
            <?php echo $form->textArea($model->baseModel, 'ghi_chu',array('class'=>'import-notes')); ?>
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
            <?php echo GxHtml::textField('productname', '', array('readOnly' => 'readOnly','onkeypress' => 'keypressInputMa(event)')) ?>
        </div>

        <div class="row cus-row">
            <?php echo GxHtml::label(Yii::t('viLib', 'Quantity'), 'quantity') ?>
            <?php echo GxHtml::textField('quantity', 0, array('class' => 'number','onkeypress' => 'keypressInputMa(event)')) ?>
        </div>

        <div class="row cus-row">
            <?php echo GxHtml::label(Yii::t('viLib', 'Import price'), 'import-price') ?>
            <?php echo GxHtml::textField('price', 0, array('class' => 'number','onkeypress' => 'keypressInputMa(event)')) ?>
        </div>

        <div class="row cus-row">
            <?php /*echo GxHtml::ajaxLink(
                Yii::t('viLib','Add product to list'),
                Yii::app()->createUrl(array('phieuNhap/AjaxCheckProduct'),
                // options

                ))*/
            ?>
        </div>

        <!--<label><?php /*echo GxHtml::encode($model->getRelationLabel('tblSanPhams'));*/?></label>
        --><?php /*echo $form->checkBoxList($model, 'tblSanPhams', GxHtml::encodeEx(GxHtml::listDataEx(SanPham::model()->findAllAttributes(null, true)), false, true));  */ ?>
    </div>
    <div class="detail-voucher">
        <div id="grid" class="grid-view">
            <table id="items" class="items">
                <tr>
                    <th id="grid_c0"><?php echo Yii::t('viLib', 'Barcode') ?></th>
                    <th id="grid_c1"><?php echo Yii::t('viLib', 'Product name') ?></th>
                    <th id="grid_c2"><?php echo Yii::t('viLib', 'Quantity') ?></th>
                    <th id="grid_c3"><?php echo Yii::t('viLib', 'Import price') ?>
                    <th id="grid_c4" class="button-column"></th>
                </tr>
            </table>
        </div>
    </div>

    <div class="clear"></div>

    <div class="btn-save">
        <?php
        echo GxHtml::submitButton(Yii::t('viLib', 'Save'));
        $this->endWidget();
        ?>
    </div>
</div><!-- form -->