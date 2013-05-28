<?php

$this->breadcrumbs = array(
    Yii::t('viLib','Promotion management')=>array('khuyenMai/danhsach'),
    Yii::t('viLib','Promotion')=>array('khuyenMai/danhsach'),
    Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib','Promotion'),
);

$this->menu = array(
	array('label'=>Yii::t('viLib', 'List') . ' ' .Yii::t('viLib','Promotion'), 'url' => array('danhsach'),'visible'=>Yii::app()->user->checkAccess('Quanlykhuyenmai.KhuyenMai.DanhSach')),
);
?>

<h1><?php echo Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib','Promotion'); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
?>