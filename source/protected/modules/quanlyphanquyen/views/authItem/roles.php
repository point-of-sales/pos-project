<?php $this->breadcrumbs = array(
    Yii::t('viLib', 'Decentralization management') => array('authItem/roles'),
    Yii::t('viLib', 'Authentication item') => array('authItem/roles'),
    Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Roles'),
); ?>

<?php
$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Tasks'),  'url' => array('authItem/tasks')),
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Operations'),  'url' => array('authItem/operations')),
    array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'New Role'), 'url' => array('authItem/create', 'type' => CAuthItem::TYPE_ROLE)),
    array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'New Task'), 'url' => array('authItem/create', 'type' => CAuthItem::TYPE_TASK)),
    array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'New Operation'), 'url' => array('authItem/create', 'type' => CAuthItem::TYPE_OPERATION)),
);
?>

<h1><?php echo Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Roles'); ?></h1>

<div id="roles" class="cus-rights-content">
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => $dataProvider,
        'template' => '{items}',
        'emptyText' => Rights::t('core', 'No roles found.'),
        'htmlOptions' => array('class' => 'grid-view role-table'),
        'columns' => array(
            array(
                'name' => 'name',
                'header' => Rights::t('core', 'Name'),
                'type' => 'raw',
                'htmlOptions' => array('class' => 'name-column'),
                'value' => '$data->getGridNameLink()',
            ),
            array(
                'name' => 'description',
                'header' => Rights::t('core', 'Description'),
                'type' => 'raw',
                'htmlOptions' => array('class' => 'description-column'),
            ),
            array(
                'name' => 'bizRule',
                'header' => Rights::t('core', 'Business rule'),
                'type' => 'raw',
                'htmlOptions' => array('class' => 'bizrule-column'),
                'visible' => Rights::module()->enableBizRule === true,
            ),
            array(
                'name' => 'data',
                'header' => Rights::t('core', 'Data'),
                'type' => 'raw',
                'htmlOptions' => array('class' => 'data-column'),
                'visible' => Rights::module()->enableBizRuleData === true,
            ),

            array(
                'class' => 'CButtonColumn',
                'template' => '{update}{delete}',
                'buttons' => array(
                    'delete' => array(
                        'url' => 'Helpers::urlRouting(Yii::app()->controller,"","delete",array("name"=>$data->owner->name))',
                        'label' => Yii::t('viLib', 'delete'),
                    ),
                    'update' => array(
                        'url' => 'Helpers::urlRouting(Yii::app()->controller,"","update",array("name"=>$data->owner->name))',
                        'label' => Yii::t('viLib', 'update'),
                    ),
                ),
            ),
        )
    )); ?>

</div>