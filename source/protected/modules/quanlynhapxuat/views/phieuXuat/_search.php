<div class="wide search-box-form">

    <?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'id'); ?>
            <?php echo $form->dropDownList($model, 'id', GxHtml::listDataEx(ChungTu::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'ly_do_xuat'); ?>
            <?php echo $form->textArea($model, 'ly_do_xuat'); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'loai_xuat_ra'); ?>
            <?php echo $form->textField($model, 'loai_xuat_ra'); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'chi_nhanh_nhap_id'); ?>
            <?php echo $form->dropDownList($model, 'chi_nhanh_nhap_id', GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
        </div>

        <div class="row buttons btn-search">
        <?php echo GxHtml::submitButton(Yii::t('viLib', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
