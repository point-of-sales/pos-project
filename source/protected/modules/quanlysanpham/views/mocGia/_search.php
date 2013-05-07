<div class="wide search-box-form">

    <?php $form = $this->beginWidget('GxActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>

    <div class="row cus-row">
        <?php echo $form->label($model, 'id'); ?>
        <?php echo $form->textField($model, 'id'); ?>
    </div>

    <div class="row cus-row">
        <?php echo $form->label($model, 'thoi_gian_bat_dau'); ?>
        <?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'thoi_gian_bat_dau',
            'value' => $model->thoi_gian_bat_dau,
            'options' => array(
                'showButtonPanel' => true,
                'changeYear' => true,
                'dateFormat' => 'yy-mm-dd',
            ),
            'htmlOptions'=>array(
                'readonly'=>true,
            ),
        ));; ?>
    </div>

    <div class="row cus-row">
        <?php echo $form->label($model, 'gia_ban'); ?>
        <?php echo $form->textField($model, 'gia_ban'); ?>
    </div>

    <div class="row cus-row">
        <?php echo $form->label($model, 'san_pham_id'); ?>
        <?php echo $form->dropDownList($model, 'san_pham_id', GxHtml::listDataEx(SanPham::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('viLib', 'All'))); ?>
    </div>

    <div class="row buttons btn-search">
        <?php echo GxHtml::submitButton(Yii::t('viLib', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
