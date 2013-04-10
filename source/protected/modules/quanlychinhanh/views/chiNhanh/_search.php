<div class="wide search-box-form">

    <?php $form = $this->beginWidget('GxActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>


    <div class="row cus-row">
        <?php echo $form->label($model, 'ma_chi_nhanh'); ?>
        <?php echo $form->textField($model, 'ma_chi_nhanh', array('maxlength' => 15)); ?>
    </div>

    <div class="row cus-row">
        <?php echo $form->label($model, 'ten_chi_nhanh'); ?>
        <?php echo $form->textField($model, 'ten_chi_nhanh', array('maxlength' => 100)); ?>
    </div>


    <div class="row cus-row">
        <?php echo $form->label($model, 'trang_thai'); ?>
        <div class="radio-list">
        <?php echo $form->radioButtonList($model, 'trang_thai',$model->layDanhSachTrangThai()); ?>
        </div>
    </div>

    <div class="row cus-row">
        <?php echo $form->label($model, 'truc_thuoc_id'); ?>
        <?php echo $form->dropDownList($model, 'truc_thuoc_id', GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
    </div>

    <div class="row cus-row">
        <?php echo $form->label($model, 'khu_vuc_id'); ?>
        <?php echo $form->dropDownList($model, 'khu_vuc_id', GxHtml::listDataEx(KhuVuc::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
    </div>

    <div class="row buttons btn-search">
        <?php echo GxHtml::submitButton(Yii::t('viLib', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
