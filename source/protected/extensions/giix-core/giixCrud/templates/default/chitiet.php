<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n
\$this->breadcrumbs = array(
	\$model->label(2) => array('danhsach'),
	GxHtml::valueEx(\$model),
);\n";
?>

$this->menu=array(
array('label'=>Yii::t('viLib', 'List') . ' ' . $model->label(2), 'url'=>array('danhsach')),
array('label'=>Yii::t('viLib', 'Add') . ' ' . $model->label(), 'url'=>array('them')),
array('label'=>Yii::t('viLib', 'Update') . ' ' . $model->label(), 'url'=>array('capnhat', 'id' => $model->id)),
array('label'=>Yii::t('viLib', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('xoa', 'id' => $model->id), 'confirm'=>Yii::t('viLib','Are you sure you want to delete this item?'))),
);
?>


<h1><?php echo '<?php'; ?> echo Yii::t('viLib', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php echo '<?php'; ?> $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
<?php
foreach ($this->tableSchema->columns as $column)
		echo $this->generateDetailViewAttribute($this->modelClass, $column) . ",\n";
?>
	),
)); ?>

<?php foreach (GxActiveRecord::model($this->modelClass)->relations() as $relationName => $relation): ?>
<?php if ($relation[0] == GxActiveRecord::HAS_MANY || $relation[0] == GxActiveRecord::MANY_MANY): ?>
<h2><?php echo '<?php'; ?> echo GxHtml::encode($model->getRelationLabel('<?php echo $relationName; ?>')); ?></h2>
<?php echo "<?php\n"; ?>
	echo GxHtml::openTag('ul');
	foreach($model-><?php echo $relationName; ?> as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('<?php echo strtolower($relation[1][0]) . substr($relation[1], 1); ?>/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
<?php echo '?>'; ?>
<?php endif; ?>
<?php endforeach; ?>