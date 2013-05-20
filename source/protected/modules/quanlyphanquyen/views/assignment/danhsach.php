<?php $this->breadcrumbs = array(
    Yii::t('viLib', 'Decentralization management') => array('authItem/roles'),
	Yii::t('viLib', 'Decentralization')=>array('authItem/roles'),
	Yii::t('viLib','List'),
); ?>

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

<h1><?php echo Rights::t('core', 'Assignments'); ?></h1>

<div id="assignments" class="cus-rights-content">

	<?php $this->widget('zii.widgets.grid.CGridView', array(
	    'dataProvider'=>$dataProvider,
	    'template'=>"{items}\n{pager}",
	    'emptyText'=>Rights::t('core', 'No users found.'),
	    'htmlOptions'=>array('class'=>'grid-view assignment-table'),
	    'columns'=>array(
    		array(
    			'name'=>'code',
    			'header'=>Yii::t('viLib','Employee code'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'name-column'),
    			'value'=>'$data->ma_nhan_vien',
    		),
            array(
                'name'=>'name',
                'header'=>Yii::t('viLib','Employee name'),
                'type'=>'raw',
                'htmlOptions'=>array('class'=>'name-column'),
                'value'=>'$data->ho_ten',
            ),
    		array(
    			'name'=>'assignments',
    			'header'=>Rights::t('core', 'Roles'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'role-column'),
    			'value'=>'$data->getAssignmentsValueText(CAuthItem::TYPE_ROLE)',
    		),
			array(
    			'name'=>'assignments',
    			'header'=>Rights::t('core', 'Tasks'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'task-column'),
    			'value'=>'$data->getAssignmentsText(CAuthItem::TYPE_TASK)',
    		),
			array(
    			'name'=>'assignments',
    			'header'=>Rights::t('core', 'Operations'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'operation-column'),
    			'value'=>'$data->getAssignmentsText(CAuthItem::TYPE_OPERATION)',
    		),

            array(
                'class' => 'CButtonColumn',
                'template' => '{view}',
                'buttons' => array(
                    'view' => array(
                        'url' => 'Helpers::urlRouting(Yii::app()->controller,"","phanquyen",array("id"=>$data->owner->id))',
                        'label' => Yii::t('viLib', 'View'),
                    ),
                ),
            ),
	    )
	)); ?>

</div>