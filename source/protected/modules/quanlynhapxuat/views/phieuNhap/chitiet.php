<?php



$this->breadcrumbs = array(
    $model->label(2) => array('danhsach'),
    GxHtml::valueEx($model),
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib','Import form'), 'url' => array('danhsach')),
    array('label' => Yii::t('viLib', 'Add') . ' ' . Yii::t('viLib','Import form'), 'url' => array('them')),

);
?>


    <h1><?php echo Yii::t('viLib', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(

        array(
            'name' => 'ngay_lap',
            'type' => 'raw',
            //'value' => $model->id0 !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->id0)), array('chungTu/view', 'id' => GxActiveRecord::extractPkValue($model->id0, true))) : null,
            'value' => $model->baseModel->ngay_lap,
        ),

        array(
            'name' => 'nhan_vien_id',
            'type' => 'raw',
            //'value' => $model->id0 !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->id0)), array('chungTu/view', 'id' => GxActiveRecord::extractPkValue($model->id0, true))) : null,
            'value' => $model->baseModel->nhan_vien_id,
        ),

        array(
            'name' => 'tri_gia',
            'type' => 'raw',
            //'value' => $model->id0 !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->id0)), array('chungTu/view', 'id' => GxActiveRecord::extractPkValue($model->id0, true))) : null,
            'value' => $model->baseModel->tri_gia,
        ),

        array(
            'name' => 'chi_nhap_nhap',
            'type' => 'raw',
            //'value' => $model->id0 !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->id0)), array('chungTu/view', 'id' => GxActiveRecord::extractPkValue($model->id0, true))) : null,
            'value' => $model->baseModel->chi_nhanh_id,
        ),

        array(
            'name' => 'id',
            'type' => 'raw',
            //'value' => $model->id0 !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->id0)), array('chungTu/view', 'id' => GxActiveRecord::extractPkValue($model->id0, true))) : null,
            'value' => $model->id,
        ),
        'loai_nhap_vao',
        array(
            'name' => 'chiNhanhXuat',
            'type' => 'raw',
            //'value' => $model->chiNhanhXuat !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->chiNhanhXuat)), array('chiNhanh/view', 'id' => GxActiveRecord::extractPkValue($model->chiNhanhXuat, true))) : null,
            'value' => $model->chi_nhanh_xuat_id,
        ),
    ),
)); ?>
    <!--
<h2><?php /*echo GxHtml::encode($model->getRelationLabel('tblSanPhams')); */?></h2>
--><?php
/*	echo GxHtml::openTag('ul');
	foreach($model->tblSanPhams as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('sanPham/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
*/
?>