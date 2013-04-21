<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n
\$this->breadcrumbs = array(
	\$model->label(1),
	Yii::t('viLib', 'List'),
);\n";
?>

$this->menu = array(
array('label'=>Yii::t('viLib', 'Create') . ' ' . $model->label(), 'url'=>array('them')),
array('label'=>Yii::t('viLib', 'Export') . ' ' . $model->label(), 'url'=>array('xuat')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1><?php echo '<?php'; ?> echo Yii::t('viLib', 'List') . ' ' . GxHtml::encode($model->label(2)); ?></h1>


<div class="search-form">
    <?php echo "<?php \$this->renderPartial('_search', array(
	'model' => \$model,
)); ?>\n"; ?>
</div><!-- search-form -->

<?php echo '<?php'; ?> $this->widget('zii.widgets.grid.CGridView', array(
'id' => 'grid',
'dataProvider' => $model->search(),
'columns' => array(
<?php
$count = 0;
foreach ($this->tableSchema->columns as $column) {
    if (++$count == 7)
        echo "\t\t/*\n";
    echo "\t\t" . $this->generateGridViewColumn($this->modelClass, $column).",\n";
}
if ($count >= 7)
    echo "\t\t*/\n";
?>
array(
    'class' => 'CButtonColumn',
    'template'=>'{view}{update}{delete}',
    'buttons'=>array(
            'view'=>array(
            'url'=>'Helpers::urlRouting(Yii::app()->controller,"","chitiet",array("id"=>$data->id))',
            'label'=>Yii::t('viLib','View'),
            ),
            'update'=>array(
            'url'=>'Helpers::urlRouting(Yii::app()->controller,"","capnhat",array("id"=>$data->id))',
            'label'=>Yii::t('viLib','Update'),
            ),
            'delete'=>array(
            'url'=>'Helpers::urlRouting(Yii::app()->controller,"","xoagrid",array("id"=>$data->id))',
            'label'=>Yii::t('viLib','Delete'),
            'click' => Helpers::deleteButtonClick(),
            ),

    ),
    ),
),
)); ?>