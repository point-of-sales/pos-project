<div class="form cus-rights-form">


    <?php if (Yii::app()->user->hasFlash('info-board')) { ?>
        <div
            class="response-msg error ui-corner-all info-board">
        <?php echo Yii::app()->user->getFlash('info-board'); ?>
        </div>
    <?php } ?>

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

    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', array('maxlength' => 255, 'style' => 'width:450px;height:100px;')); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>

    <?php if (Rights::module()->enableBizRule === true): ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'bizRule'); ?>
            <?php echo $form->textField($model, 'bizRule', array('maxlength' => 255, 'class' => 'text-field')); ?>
            <?php echo $form->error($model, 'bizRule'); ?>

        </div>

    <?php endif; ?>

    <?php if (Rights::module()->enableBizRule === true && Rights::module()->enableBizRuleData): ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'data'); ?>
            <?php echo $form->textField($model, 'data', array('maxlength' => 255, 'class' => 'text-field')); ?>
            <?php echo $form->error($model, 'data'); ?>
        </div>

    <?php endif; ?>

    <div class="row">

        <?php if($_GET['type'] == 2): ?>
            <?php echo CHtml::label(Yii::t('viLib', 'Weight'), ''); ?>
            <?php if (!isset($currentWeight)): ?>
                <?php echo $form->dropDownList($model, 'weight', AuthItemForm::getWeightOptions()); ?>
            <?php elseif ($currentWeight < 999): ?>
                <?php echo $form->dropDownList($model, 'weight', AuthItemForm::getWeightOptions(), array("options" => array($currentWeight => array("selected" => "selected")))); ?>
            <?php endif; ?>
            <?php echo $form->error($model, 'weight'); ?>
        <?php endif; ?>
    </div>


    <div class="clear"></div>

    <div class="row buttons btn-save">
        <?php echo CHtml::submitButton(Yii::t('viLib', 'Save')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>