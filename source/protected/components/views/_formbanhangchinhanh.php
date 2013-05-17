<?php
/**
 * User: ${Cristazn}
 * Date: 5/14/13
 * Time: 11:13 AM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980
 */
?>

<div class="form-portlet">
    <?php $form = $this->beginWidget('GxActiveForm',array(
        'id'=>'ban-hang'
    )); ?>


    <?php echo $form->errorSummary($model);?>

    <div class="row">
        <?php echo $form->labelEx($model,'chi_nhanh_id')?>
        <?php echo $form->dropDownList($model,'chi_nhanh_id',GxHtml::listDataEx(ChiNhanh::layDanhSachChiNhanhKichHoatTrongHeThong(),null,'ten_chi_nhanh'),array('class'=>'chi-nhanh-dropdownlist-report','prompt'=>Yii::t('viLib','All'))); ?>
        <?php $form->error($model,'chi_nhanh_id') ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'thoi_gian_bat_dau'); ?>
        <?php

        $form->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'thoi_gian_bat_dau',
            'value' => $model->thoi_gian_bat_dau,
            'options' => array(
                'showButtonPanel' => true,
                'changeYear' => true,
                'dateFormat' => 'dd-mm-yy',

            ),
        ));
        ;

        ?>
        <?php echo $form->error($model,'thoi_gian_bat_dau');  ?>
    </div><!-- row -->

    <div class="row">
        <?php echo $form->labelEx($model,'thoi_gian_ket_thuc'); ?>
        <?php

        $form->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'thoi_gian_ket_thuc',
            'value' => $model->thoi_gian_bat_dau,
            'options' => array(
                'showButtonPanel' => true,
                'changeYear' => true,
                'dateFormat' => 'dd-mm-yy',

            ),
        ));
        ;

        ?>
        <?php echo $form->error($model,'thoi_gian_ket_thuc');  ?>
    </div><!-- row -->

    <?php
    echo GxHtml::submitButton(Yii::t('viLib', 'Search'));
    $this->endWidget();
    ?>

</div>
