<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Danh sách') . ' ' . $model->label(2), 'url'=>array('danhsach')),
	array('label'=>Yii::t('app', 'Thêm') . ' ' . $model->label(), 'url'=>array('them')),
	array('label'=>Yii::t('app', 'Cập nhật') . ' ' . $model->label(), 'url'=>array('capnhat', 'id' => $model->id)),
	array('label'=>Yii::t('app', 'Xóa') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('xoa', 'id' => $model->id), 'confirm'=>'Bạn có muốn xóa chi nhánh này không ?')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'id',
'ma_chi_nhanh',
'ten_chi_nhanh',
'dia_chi',
'dien_thoai',
'fax',
'mo_ta',
'trang_thai',
array(
			'name' => 'trucThuoc',
			'type' => 'raw',
			'value' => $model->trucThuoc !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->trucThuoc)), array('mChiNhanh/view', 'id' => GxActiveRecord::extractPkValue($model->trucThuoc, true))) : null,
			),
array(
			'name' => 'khuVuc',
			'type' => 'raw',
			'value' => $model->khuVuc !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->khuVuc)), array('khuVuc/view', 'id' => GxActiveRecord::extractPkValue($model->khuVuc, true))) : null,
			),
array(
			'name' => 'loaiChiNhanh',
			'type' => 'raw',
			'value' => $model->loaiChiNhanh !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->loaiChiNhanh)), array('loaiChiNhanh/view', 'id' => GxActiveRecord::extractPkValue($model->loaiChiNhanh, true))) : null,
			),
	),
)); ?>

<!--<h2><?php /*echo GxHtml::encode($model->getRelationLabel('chiNhanhs')); */?></h2>
<?php
/*	echo GxHtml::openTag('ul');
	foreach($model->chiNhanhs as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('mChiNhanh/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
*/?><h2><?php /*echo GxHtml::encode($model->getRelationLabel('chungTus')); */?></h2>
<?php
/*	echo GxHtml::openTag('ul');
	foreach($model->chungTus as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('chungTu/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
*/?><h2><?php /*echo GxHtml::encode($model->getRelationLabel('khuyenMais')); */?></h2>
<?php
/*	echo GxHtml::openTag('ul');
	foreach($model->khuyenMais as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('khuyenMai/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
*/?><h2><?php /*echo GxHtml::encode($model->getRelationLabel('tblKhuyenMais')); */?></h2>
<?php
/*	echo GxHtml::openTag('ul');
	foreach($model->tblKhuyenMais as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('khuyenMai/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
*/?><h2><?php /*echo GxHtml::encode($model->getRelationLabel('nhanViens')); */?></h2>
<?php
/*	echo GxHtml::openTag('ul');
	foreach($model->nhanViens as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('nhanVien/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
*/?><h2><?php /*echo GxHtml::encode($model->getRelationLabel('phieuNhaps')); */?></h2>
<?php
/*	echo GxHtml::openTag('ul');
	foreach($model->phieuNhaps as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('phieuNhap/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
*/?><h2><?php /*echo GxHtml::encode($model->getRelationLabel('phieuXuats')); */?></h2>
<?php
/*	echo GxHtml::openTag('ul');
	foreach($model->phieuXuats as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('phieuXuat/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
*/?><h2><?php /*echo GxHtml::encode($model->getRelationLabel('tblSanPhams')); */?></h2>
<?php
/*	echo GxHtml::openTag('ul');
	foreach($model->tblSanPhams as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('sanPham/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
*/?><h2><?php /*echo GxHtml::encode($model->getRelationLabel('tblSanPhamTangs')); */?></h2>
--><?php
/*	echo GxHtml::openTag('ul');
	foreach($model->tblSanPhamTangs as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('sanPhamTang/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');*/
?>