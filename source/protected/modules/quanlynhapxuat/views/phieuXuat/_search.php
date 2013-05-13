<div class="wide search-box-form">


    <?php $form = $this->beginWidget('GxActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>

    <div class="row cus-row">
        <?php echo GxHtml::label(Yii::t('viLib','Voucher code'),'id'); ?>
        <?php echo $form->dropDownList($model->baseModel, 'id', GxHtml::listDataEx($model->baseModel->layDanhSachChungTuPhieuXuat()), array('prompt' => Yii::t('viLib', 'All'))); ?>

    </div>

    <div class="row cus-row">
        <?php echo $form->label($model, 'loai_xuat_ra'); ?>
        <?php echo $form->dropDownList($model, 'loai_xuat_ra', LoaiNhapXuat::layDanhSachLoaiXuat(),array('prompt' => Yii::t('viLib', 'All'))); ?>
    </div>

    <div class="row cus-row">
        <?php echo $form->label($model, 'chi_nhanh_nhap_id'); ?>
        <?php echo $form->dropDownList($model, 'chi_nhanh_nhap_id', GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('viLib', 'All'))); ?>
    </div>

    <div class="row buttons btn-search">
        <?php echo GxHtml::submitButton(Yii::t('viLib', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
