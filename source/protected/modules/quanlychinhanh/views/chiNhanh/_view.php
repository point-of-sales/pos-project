<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('ma_chi_nhanh')); ?>:
	<?php echo GxHtml::encode($data->ma_chi_nhanh); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('ten_chi_nhanh')); ?>:
	<?php echo GxHtml::encode($data->ten_chi_nhanh); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('dia_chi')); ?>:
	<?php echo GxHtml::encode($data->dia_chi); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('dien_thoai')); ?>:
	<?php echo GxHtml::encode($data->dien_thoai); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('fax')); ?>:
	<?php echo GxHtml::encode($data->fax); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('mo_ta')); ?>:
	<?php echo GxHtml::encode($data->mo_ta); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('trang_thai')); ?>:
	<?php echo GxHtml::encode($data->trang_thai); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('truc_thuoc_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->trucThuoc)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('khu_vuc_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->khuVuc)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('loai_chi_nhanh_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->loaiChiNhanh)); ?>
	<br />
	*/ ?>

</div>