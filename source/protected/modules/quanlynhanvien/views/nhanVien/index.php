<?php
$this->breadcrumbs = array(
	NhanVien::label(2),
	Yii::t('app', 'Index'),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . NhanVien::label(), 'url' => array('them')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . NhanVien::label(2), 'url' => array('danhsach')),
);
?>



<h1><?php echo GxHtml::encode(NhanVien::label(2)); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 