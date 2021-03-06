<?php

$this->breadcrumbs = array(
    Yii::t('viLib','Promotion management')=>array('khuyenMai/danhsach'),
    Yii::t('viLib','Promotion')=>array('khuyenMai/danhsach'),
    Yii::t('viLib', 'Update')=>array(),
	GxHtml::valueEx($model,"ten_chuong_trinh"),
);

$this->menu = array(
	array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib','Promotion'), 'url'=>array('danhsach'),'visible'=>Yii::app()->user->checkAccess('Quanlykhuyenmai.KhuyenMai.DanhSach')),
	array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib','Promotion'), 'url'=>array('them'),'visible'=>Yii::app()->user->checkAccess('Quanlykhuyenmai.KhuyenMai.Them')),
	array('label' => Yii::t('viLib', 'View') . ' ' . Yii::t('viLib','Promotion'), 'url'=>array('chitiet', 'id' => GxActiveRecord::extractPkValue($model, true)),'visible'=>Yii::app()->user->checkAccess('Quanlykhuyenmai.KhuyenMai.ChiTiet')),
);
?>

<h1><?php echo Yii::t('viLib', 'Update') . ' ' . Yii::t('viLib','Promotion') . ' ' . GxHtml::valueEx($model,"ten_chuong_trinh") ; ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model));
?>