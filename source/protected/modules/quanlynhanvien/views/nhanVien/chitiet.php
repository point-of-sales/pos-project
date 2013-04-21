<?php

$this->breadcrumbs = array(
	$model->label(2) => array('danhsach'),
	GxHtml::valueEx($model),
);

$this->menu=array(
array('label'=>Yii::t('viLib', 'List') . ' ' . $model->label(2), 'url'=>array('danhsach')),
array('label'=>Yii::t('viLib', 'Add') . ' ' . $model->label(), 'url'=>array('them')),
array('label'=>Yii::t('viLib', 'Update') . ' ' . $model->label(), 'url'=>array('capnhat', 'id' => $model->id)),
array('label'=>Yii::t('viLib', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('xoa', 'id' => $model->id), 'confirm'=>Yii::t('viLib','Are you sure you want to delete this item?'))),
);
?>


<h1><?php echo Yii::t('viLib', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'id',
'ma_nhan_vien',
'ho_ten',
'email',
'dien_thoai',
'dia_chi',
'gioi_tinh',
array(
        'name'=>'ngay_sinh',
        'value'=>date('d-m-Y',strtotime($model->ngay_sinh)),
    ),
'trinh_do',
'luong_co_ban',
'chuyen_mon',
'trang_thai',
'mat_khau',
array(
        'name'=>'ngay_vao_lam',
        'value'=>date('d-m-Y',strtotime($model->ngay_vao_lam)),
    ),
array(
        'name'=>'lan_dang_nhap_cuoi',
        'value'=>date('d-m-Y',strtotime($model->lan_dang_nhap_cuoi)),
    ),
array(
			'name' => 'loaiNhanVien',
			'type' => 'raw',
			'value' => $model->loaiNhanVien !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->loaiNhanVien)), array('loaiNhanVien/view', 'id' => GxActiveRecord::extractPkValue($model->loaiNhanVien, true))) : null,
			),
array(
			'name' => 'chiNhanh',
			'type' => 'raw',
			'value' => $model->chiNhanh !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->chiNhanh)), array('chiNhanh/view', 'id' => GxActiveRecord::extractPkValue($model->chiNhanh, true))) : null,
			),
	),
)); ?>