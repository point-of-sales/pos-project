<?php $this->breadcrumbs = array(
    Yii::t('viLib', 'Decentralization management') => array('authItem/roles'),
	Yii::t('viLib', 'Decentralization')=>array('authItem/roles'),
	Yii::t('viLib','List'),
); ?>

<?php
$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Role'),  'url' => array('authItem/roles')),
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Task'),  'url' => array('authItem/tasks')),
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Operation'),  'url' => array('authItem/operations')),
    array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Role'), 'url' => array('authItem/create', 'type' => CAuthItem::TYPE_ROLE)),
    array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Task'), 'url' => array('authItem/create', 'type' => CAuthItem::TYPE_TASK)),
   // array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Operation'), 'url' => array('authItem/create', 'type' => CAuthItem::TYPE_OPERATION)),
);

?>

<h1><?php echo Yii::t('viLib','List') . ' ' . Yii::t('viLib', 'Assignment'); ?></h1>

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
                'name'=>'name',
                'header'=>Yii::t('viLib','Branch name'),
                'type'=>'raw',
                'htmlOptions'=>array('class'=>'name-column'),
                'value'=>'$data->chiNhanh->ten_chi_nhanh',
            ),

    		array(
    			'name'=>'assignments',
    			'header'=>Yii::t('viLib', 'Role'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'role-column'),
    			'value'=>'$data->getAssignmentsValueText(CAuthItem::TYPE_ROLE)',
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