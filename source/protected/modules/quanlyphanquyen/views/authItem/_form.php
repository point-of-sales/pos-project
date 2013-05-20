<div class="form cus-rights-form">

    <?php if ($model->scenario === 'update'): ?>

        <div class="sub-title">
            <p><?php echo Yii::t('viLib', Rights::getAuthItemTypeName($model->type)) ?></p>
        </div>

    <?php endif; ?>

    <?php $form = $this->beginWidget('CActiveForm'); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('maxlength' => 255, 'class' => 'text-field')); ?>
        <?php echo $form->error($model, 'name'); ?>
        <p class="hint"><?php echo Rights::t('core', 'Do not change the name unless you know what you are doing.'); ?></p>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', array('maxlength' => 255, 'style' => 'width:450px;height:100px;')); ?>
        <?php echo $form->error($model, 'description'); ?>
        <p class="hint"><?php echo Rights::t('core', 'A descriptive name for this item.'); ?></p>
    </div>

    <?php if (Rights::module()->enableBizRule === true): ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'bizRule'); ?>
            <?php echo $form->textField($model, 'bizRule', array('maxlength' => 255, 'class' => 'text-field')); ?>
            <?php echo $form->error($model, 'bizRule'); ?>
            <p class="hint"><?php echo Rights::t('core', 'Code that will be executed when performing access checking.'); ?></p>
        </div>

    <?php endif; ?>

    <?php if (Rights::module()->enableBizRule === true && Rights::module()->enableBizRuleData): ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'data'); ?>
            <?php echo $form->textField($model, 'data', array('maxlength' => 255, 'class' => 'text-field')); ?>
            <?php echo $form->error($model, 'data'); ?>
            <p class="hint"><?php echo Rights::t('core', 'Additional data available when executing the business rule.'); ?></p>
        </div>

    <?php endif; ?>


    <div class="clear"></div>

    <div class="row buttons btn-save">
        <?php echo CHtml::submitButton(Yii::t('viLib', 'Save')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>