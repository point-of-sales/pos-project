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
            'url'=>'Yii::app()->createUrl(Yii::app()->controller->module->id .DIRECTORY_SEPARATOR. Yii::app()->controller->id .DIRECTORY_SEPARATOR. "chitiet",array("id"=>$data->id))',
            'label'=>Yii::t('viLib','View'),
            ),
            'update'=>array(
            'url'=>'Yii::app()->createUrl(Yii::app()->controller->module->id .DIRECTORY_SEPARATOR. Yii::app()->controller->id .DIRECTORY_SEPARATOR. "capnhat",array("id"=>$data->id))',
            'label'=>Yii::t('viLib','Update'),
            ),
            'delete'=>array(
            'url'=>'Yii::app()->createUrl(Yii::app()->controller->module->id .DIRECTORY_SEPARATOR. Yii::app()->controller->id .DIRECTORY_SEPARATOR. "xoagrid",array("id"=>$data->id))',
            'label'=>Yii::t('viLib','Delete'),
            'click' => "js:function(){

                    var r = confirm('Bạn có muốn xóa không ?');
                    if(r) {
                        var url = $(this).attr('href');
                         $.fn.yiiGridView.update('grid', {  //change my-grid to your grid's name
                         type:'POST',
                         url:$(this).attr('href'),
                         success:function(data) {
                            if(jQuery.type(data) == 'string' && data!='') {
                                $('.search-form').after(
                                    '<div class=error>'+data+'</div>'
                            );
                            $('.error').addClass('response-msg');
                            $('.error').addClass('ui-corner-all')
                            $('.error').fadeOut(5000);
                         }

                         $.fn.yiiGridView.update('grid'); //change my-grid to your grid's name
                    }
                    })
                        return false;
                    } else {
                        return false;
                        }
                    }",
            ),

    ),
    ),
),
)); ?>