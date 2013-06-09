<?php $this->breadcrumbs = array(
    Yii::t('viLib', 'Decentralization management') => array('authItem/roles'),
    Yii::t('viLib', 'Authentication item') => array('authItem/roles'),
    Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Operation'),
); ?>

<?php
$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Role'),  'url' => array('authItem/roles')),
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Task'),  'url' => array('authItem/tasks')),
    array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Role'), 'url' => array('authItem/create', 'type' => CAuthItem::TYPE_ROLE)),
    array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Task'), 'url' => array('authItem/create', 'type' => CAuthItem::TYPE_TASK)),
    //array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Operation'), 'url' => array('authItem/create', 'type' => CAuthItem::TYPE_OPERATION)),
    array('label' => Yii::t('viLib', 'Assign permission'), 'url' => array('authItem/permissions')),
);
?>

<h1><?php echo Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Operation') ?></h1>

<div id="operations" class="cus-rights-content">

	<?php $this->widget('zii.widgets.grid.CGridView', array(
	    'dataProvider'=>$dataProvider,
	    'template'=>'{items}',
	    'emptyText'=>Rights::t('core', 'No operations found.'),
	    'htmlOptions'=>array('class'=>'grid-view operation-table sortable-table'),
	    'columns'=>array(
	    	array(
    			'name'=>'name',
    			'header'=>Yii::t('viLib', 'Operation name'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'name-column'),
    			'value'=>'$data->owner->name',
    		),
    		array(
    			'name'=>'description',
    			'header'=>Yii::t('viLib', 'Description'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'description-column'),
    		),
    		array(
    			'name'=>'bizRule',
    			'header'=>Yii::t('viLib', 'Business rule'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'bizrule-column'),
    			'visible'=>Rights::module()->enableBizRule===true,
    		),
    		array(
    			'name'=>'data',
    			'header'=>Yii::t('viLib', 'Data'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'data-column'),
    			'visible'=>Rights::module()->enableBizRuleData===true,
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
                        'url' => 'Helpers::urlRouting(Yii::app()->controller,"","update",array("name"=>$data->owner->name,"type"=>0))',
                        'label' => Yii::t('viLib', 'update'),
                    ),
                ),
            ),
	    )
	)); ?>


</div>