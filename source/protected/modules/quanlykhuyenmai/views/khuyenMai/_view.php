<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('ma_chuong_trinh')); ?>:
	<?php echo GxHtml::encode($data->ma_chuong_trinh); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('ten_chuong_trinh')); ?>:
	<?php echo GxHtml::encode($data->ten_chuong_trinh); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('mo_ta')); ?>:
	<?php echo GxHtml::encode($data->mo_ta); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('gia_giam')); ?>:
	<?php echo GxHtml::encode($data->gia_giam); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('thoi_gian_bat_dau')); ?>:
	<?php echo GxHtml::encode($data->thoi_gian_bat_dau); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('thoi_gian_ket_thuc')); ?>:
	<?php echo GxHtml::encode($data->thoi_gian_ket_thuc); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('trang_thai')); ?>:
	<?php echo GxHtml::encode($data->trang_thai); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('chi_nhanh_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->chiNhanh)); ?>
	<br />
	*/ ?>

</div>