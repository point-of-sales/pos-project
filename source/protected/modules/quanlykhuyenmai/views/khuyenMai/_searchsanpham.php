<div class="wide search-box-form">

    <?php $form = $this->beginWidget('GxActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>

    <div class="row cus-row">
        <?php echo $form->label($model, 'ma_vach'); ?>
        <?php echo $form->textField($model, 'ma_vach', array('maxlength' => 15)); ?>
    </div>

    <div class="row cus-row">
        <?php echo $form->label($model, 'ten_san_pham'); ?>
        <?php echo $form->textField($model, 'ten_san_pham', array('maxlength' => 100)); ?>
    </div>

    <div class="row cus-row">
        <?php echo $form->label($model, 'ten_tieng_viet'); ?>
        <?php echo $form->textField($model, 'ten_tieng_viet', array('maxlength' => 100)); ?>
    </div>

    <div class="row cus-row">
        <?php echo $form->label($model, 'trang_thai'); ?>
        <div class="radio-list">
        <?php echo $form->radioButtonList($model, 'trang_thai',$model->layDanhSachTrangThai()); ?>
        </div>
    </div>

    <!--<div class="row cus-row">
        <?php /*echo $form->label($model, 'khuyen_mai_id'); */?>
        <div class="radio-list">
            <?php /*echo $form->radioButtonList($model, 'khuyen_mai_id',$model->layDanhSachTrangThaiKhuyenMai()); */?>
        </div>
    </div>-->

    <div class="row cus-row">
        <?php echo $form->label($model, 'nha_cung_cap_id'); ?>
        <?php echo $form->dropDownList($model, 'nha_cung_cap_id', GxHtml::listDataEx(NhaCungCap::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('viLib', 'All'))); ?>
    </div>

    <div class="row cus-row">
        <?php echo $form->label($model, 'loai_san_pham_id'); ?>
        <?php echo $form->dropDownList($model, 'loai_san_pham_id', GxHtml::listDataEx(LoaiSanPham::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('viLib', 'All'))); ?>
    </div>

    <div class="row cus-row">
       <label><?php echo GxHtml::encode(Yii::t('viLib','Branch')); ?></label>
        <?php echo $form->dropDownList($model, 'tblChiNhanhs', GxHtml::encodeEx(GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true)), false, true),array('prompt' => Yii::t('viLib', 'All'))); ?>
    </div>
    <div class="clear"></div>
    <div class="row buttons btn-search">
        <?php echo GxHtml::submitButton(Yii::t('viLib', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
