<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Promotion management') => array('khuyenMai/danhsach'),
    Yii::t('viLib', 'Promotion') => array('khuyenMai/danhsach'),
    Yii::t('viLib', 'Detail') => array(),
    GxHtml::valueEx($model, "ten_chuong_trinh"),
);
if (RightsWeight::getRoleWeight(Yii::app()->user->id) == 999) {
    $this->menu = array(
        array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Promotion'), 'url' => array('danhsach')),
        array('label' => Yii::t('viLib', 'Add') . ' ' . Yii::t('viLib', 'Promotion'), 'url' => array('them')),
        array('label' => Yii::t('viLib', 'Update') . ' ' . Yii::t('viLib', 'Promotion'), 'url' => array('capnhat', 'id' => $model->id)),
        array('label' => Yii::t('viLib', 'Delete') . ' ' . Yii::t('viLib', 'Promotion'), 'url' => '#', 'linkOptions' => array('submit' => array('xoa', 'id' => $model->id), 'confirm' => Yii::t('viLib', 'Are you sure you want to delete this item?'))),
    );
}
?>



    <h1><?php echo Yii::t('viLib', 'View') . ' ' . Yii::t('viLib', 'Promotion') . ' ' . GxHtml::encode(GxHtml::valueEx($model, "ten_chuong_trinh")); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'ma_chuong_trinh',
        'ten_chuong_trinh',
        'mo_ta',
        'gia_giam',
        'thoi_gian_bat_dau',
        'thoi_gian_ket_thuc',
        array('name' => Yii::t('viLib', 'Status'),
            'value' => $model->layTenTrangThai(),
        ),
    ),
)); ?>

    <!--<h2><?php /*echo GxHtml::encode($model->getRelationLabel('tblChiNhanhs')); */?></h2>
--><?php
/*echo GxHtml::openTag('ul');
foreach ($model->tblChiNhanhs as $relatedModel) {
    echo GxHtml::openTag('li');
    echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('chiNhanh/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
    echo GxHtml::closeTag('li');
}
echo GxHtml::closeTag('ul');*/
?>