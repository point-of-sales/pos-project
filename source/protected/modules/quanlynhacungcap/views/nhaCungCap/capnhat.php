<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Supplier management') => array('nhaCungCap/danhsach'),
    Yii::t('viLib', 'Supplier') => array('nhaCungCap/danhsach'),
    Yii::t('viLib', 'Update') => array(),
    GxHtml::valueEx($model, "ten_nha_cung_cap"),

);

$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Supplier'), 'url' => array('danhsach'),'visible'=>Yii::app()->user->checkAccess('Quanlynhacungcap.NhaCungCap.DanhSach')),
    array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Supplier'), 'url' => array('them'),'visible'=>Yii::app()->user->checkAccess('Quanlynhacungcap.NhaCungCap.Them')),
    array('label' => Yii::t('viLib', 'View') . ' ' . Yii::t('viLib', 'Supplier'), 'url' => array('chitiet', 'id' => GxActiveRecord::extractPkValue($model, true)),'visible'=>Yii::app()->user->checkAccess('Quanlynhacungcap.NhaCungCap.ChiTiet')),
);
?>

    <h1><?php echo Yii::t('viLib', 'Update') . ' ' . Yii::t('viLib', 'Supplier') . ' ' . GxHtml::encode(GxHtml::valueEx($model, "ten_nha_cung_cap")); ?></h1>

<?php
$this->renderPartial('_form', array(
    'model' => $model));
?>