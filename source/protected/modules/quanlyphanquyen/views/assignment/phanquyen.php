<?php $this->breadcrumbs = array(
    Yii::t('viLib', 'Decentralization management') => array('authItem/roles'),
    Yii::t('viLib', 'Decentralization')=>array('authItem/roles'),
    Yii::t('viLib','Assign rights'),
); ?>
<h1><?php echo Rights::t('core', 'Assignments for :username', array(
        ':username'=>$model->ho_ten
    )); ?></h1>

<?php
$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Roles'),  'url' => array('authItem/roles')),
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Tasks'),  'url' => array('authItem/tasks')),
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Operations'),  'url' => array('authItem/operations')),
    array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'New Role'), 'url' => array('authItem/create', 'type' => CAuthItem::TYPE_ROLE)),
    array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'New Task'), 'url' => array('authItem/create', 'type' => CAuthItem::TYPE_TASK)),
    array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'New Operation'), 'url' => array('authItem/create', 'type' => CAuthItem::TYPE_OPERATION)),
);

?>

<div id="userAssignments" class="cus-rights-content">

    <div class="add-assignment span-11 last">




        <?php if( $formModel!==null ): ?>

            <div class="form cus-auth-form">

                <div class="sub-title">
                    <p><?php echo Yii::t('viLib', 'Assign item') ?></p>
                </div>

                <?php $this->renderPartial('_form', array(
                    'model'=>$formModel,
                    'itemnameSelectOptions'=>$assignSelectOptions,
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
			'dataProvider'=>$dataProvider,
			'template'=>'{items}',
			//'hideHeader'=>true,
			'emptyText'=>Rights::t('core', 'This user has not been assigned any items.'),
			'htmlOptions'=>array('class'=>'grid-view user-assignment-table mini'),
			'columns'=>array(
    			array(
    				'name'=>'name',
    				'header'=>Rights::t('core', 'Name'),
    				'type'=>'raw',
    				'htmlOptions'=>array('class'=>'name-column'),
    				'value'=>'$data->name',
    			),
    			array(
    				'name'=>'type',
    				'header'=>Rights::t('core', 'Type'),
    				'type'=>'raw',
    				'htmlOptions'=>array('class'=>'type-column'),
    				'value'=>'$data->getTypeText()',
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
                ),

			)
		)); ?>

	</div>





</div>