<?php $this->breadcrumbs = array(
    Yii::t('viLib', 'Decentralization management') => array('authItem/roles'),
    Yii::t('viLib', 'Decentralization') => array('authItem/roles'),
    Yii::t('viLib', 'Personal Assign'),
); ?>
<h1><?php echo Yii::t('viLib', 'Assignments for') . ' ' . Yii::t('viLib', ':username', array(
            ':username' => $model->ho_ten
        )); ?></h1>

<div class="search-form"></div><!-- search-form -->

<?php if (Yii::app()->user->hasFlash('info-board')) { ?>
    <div class="response-msg error ui-corner-all info-board">
        <p><?php echo Yii::app()->user->getFlash('info-board'); ?></p>
    </div>
<?php } ?>

<?php
$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Role'), 'url' => array('authItem/roles')),
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Task'), 'url' => array('authItem/tasks')),
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Operation'), 'url' => array('authItem/operations')),
    array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Role'), 'url' => array('authItem/create', 'type' => CAuthItem::TYPE_ROLE)),
    array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Task'), 'url' => array('authItem/create', 'type' => CAuthItem::TYPE_TASK)),
    //array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Operation'), 'url' => array('authItem/create', 'type' => CAuthItem::TYPE_OPERATION)),
);

?>

<div id="userAssignments">

    <div class="add-assignment span-11 last">

        <?php if ($formModel !== null): ?>

            <div class="form cus-auth-form">

                <div class="sub-title">
                    <p><?php echo Yii::t('viLib', 'Assign item') ?></p>
                </div>

                <?php $this->renderPartial('_form', array(
                    'model' => $formModel,
                    'itemnameSelectOptions' => $assignSelectOptions,
                )); ?>

            </div>

        <?php else: ?>

        <p class="info"><?php echo Rights::t('core', 'No assignments available to be assigned to this user.'); ?>

            <?php endif; ?>

    </div>

    <div class="assignments span-12 first cus-assign">
        <div class="sub-title">
            <p><?php echo Yii::t('viLib', 'List Assigned rights') ?></p>
        </div>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider' => $dataProvider,
            'template' => '{items}',
            //'hideHeader'=>true,
            'emptyText' => Rights::t('core', 'This user has not been assigned any items.'),
            'htmlOptions' => array('class' => 'grid-view user-assignment-table mini'),
            'columns' => array(
                array(
                    'name' => 'name',
                    'header' => Yii::t('viLib', 'Assign item'),
                    'type' => 'raw',
                    'htmlOptions' => array('class' => 'name-column'),
                    'value' => '$data->name',
                ),
                array(
                    'name' => 'type',
                    'header' => Yii::t('viLib', 'Assign item type'),
                    'type' => 'raw',
                    'htmlOptions' => array('class' => 'type-column'),
                    'value' => '$data->getTypeText()',
                ),
                array(
                    'class' => 'CButtonColumn',
                    'template' => '{delete}',
                    'buttons' => array(
                        'delete' => array(
                            'url' => 'Helpers::urlRouting(Yii::app()->controller,"","revoke",array("id"=>$data->owner->userId,"name"=>$data->owner->name))',
                            'label' => Yii::t('viLib', 'delete'),

                        ),

                    ),
                    'afterDelete' => 'function(link,success,data){

                                if(data=="override-error") {
                                    $(".search-form").after(
                                    "<div class=error>Không thể xóa vai trò của Quản Lý Hệ Thống</div>");
                            $(".error").addClass("response-msg");
                            $(".error").addClass("ui-corner-all");
                            $(".error").fadeOut(8000);

                            }


                    ; }',
                ),

            )
        )); ?>

    </div>


</div>
