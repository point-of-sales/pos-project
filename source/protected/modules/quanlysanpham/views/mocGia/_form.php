<div class="form">

    <?php  if(Yii::app()->user->hasFlash('info-board')) {?>    <div class="response-msg error ui-corner-all info-board">        <?php echo Yii::app()->user->getFlash('info-board');?>    </div><?php } ?>

    <?php $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'moc-gia-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">
        <?php echo Yii::t('viLib', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('viLib', 'are required'); ?>.

    </p>

    <?php echo $form->errorSummary($model); ?>
    <div class="row cus-row">
        <?php echo $form->hiddenField($model, 'id',array('readonly'=>true)); ?>
    </div><!-- row -->


    <div class="row cus-row">
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

    <div class="row cus-row">
        <?php echo $form->labelEx($model,'gia_ban'); ?>
        <?php echo $form->textField($model, 'gia_ban'); ?>
        <?php echo $form->error($model,'gia_ban'); ?>
    </div><!-- row -->

    <!--<div class="row cus-row">
		<?php /*echo $form->labelEx($model,'san_pham_id'); */?>
		<?php /*echo $form->dropDownList($model, 'san_pham_id', GxHtml::listDataEx(SanPham::model()->findAllAttributes(null, true))); */?>
		<?php /*echo $form->error($model,'san_pham_id'); */?>
		</div>--><!-- row -->


    <div class="btn-save">
        <?php
        echo GxHtml::submitButton(Yii::t('viLib', 'Save'));
        $this->endWidget();
        ?>
    </div>
</div><!-- form -->