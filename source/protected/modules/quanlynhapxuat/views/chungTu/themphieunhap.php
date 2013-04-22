<?php
$this->breadcrumbs = array(
	$model->label(2) => array('danhsach'),
	Yii::t('viLib', 'Create'),
);

$this->menu = array(
	array('label'=>Yii::t('viLib', 'List') . ' ' . $model->label(2), 'url' => array('danhsach')),
);
?>

<h1><?php echo Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib','Import form') ; ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
?>
