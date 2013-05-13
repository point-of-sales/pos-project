<div class="wide search-box-form">

    <?php $form = $this->beginWidget('GxActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>

    <div class="row cus-row">
        <?php echo GxHtml::label(Yii::t('viLib','Voucher code'),'id'); ?>
        <?php echo $form->dropDownList($model->baseModel, 'id', GxHtml::listDataEx($model->baseModel->layDanhSachChuntTuPhieuNhap()), array('prompt' => Yii::t('viLib', 'All'))); ?>
    </div>

    <div class="row cus-row">
        <?php echo $form->label($model, 'loai_nhap_vao'); ?>
        <?php echo $form->dropDownList($model, 'loai_nhap_vao',LoaiNhapXuat::layDanhSachLoaiNhap(),array('prompt' => Yii::t('viLib', 'All'))); ?>
    </div>

    <div class="row cus-row">
        <?php echo $form->label($model, 'chi_nhanh_xuat_id'); ?>
        <?php echo $form->dropDownList($model, 'chi_nhanh_xuat_id', GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('viLib', 'All'))); ?>
    </div>

    <div class="row buttons btn-search">
        <?php echo GxHtml::submitButton(Yii::t('viLib', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
