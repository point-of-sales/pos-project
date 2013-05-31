<?php $this->breadcrumbs = array(
    Yii::t('viLib', 'Decentralization management') => array('authItem/roles'),
    Yii::t('viLib', 'Authentication item')=>array(),
    Yii::t('viLib', 'Assign permission')
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Role'),  'url' => array('authItem/roles')),
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Task'),  'url' => array('authItem/tasks')),
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Operation'),  'url' => array('authItem/operations')),
);

?>

<h1><?php echo Yii::t('viLib','List') . ' ' . Yii::t('viLib', 'Assign permission'); ?></h1>

<div id="permissions" class="cus-rights-content">
	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$dataProvider,
		'template'=>'{items}',
		'emptyText'=>Rights::t('core', 'No authorization items found.'),
		'htmlOptions'=>array('class'=>'grid-view permission-table'),
		'columns'=>$columns,

	)); ?>

	<script type="text/javascript">

		/**
		* Attach the tooltip to the inherited items.
		*/
		jQuery('.inherited-item').rightsTooltip({
			title:'<?php echo Rights::t('core', 'Source'); ?>: '
		});

		/**
		* Hover functionality for rights' tables.
		*/
		$('#rights tbody tr').hover(function() {
			$(this).addClass('hover'); // On mouse over
		}, function() {
			$(this).removeClass('hover'); // On mouse out
		});

	</script>



</div>
