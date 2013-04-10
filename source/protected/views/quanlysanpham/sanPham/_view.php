<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('ma_vach')); ?>:
	<?php echo GxHtml::encode($data->ma_vach); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('ten_san_pham')); ?>:
	<?php echo GxHtml::encode($data->ten_san_pham); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('ten_tieng_viet')); ?>:
	<?php echo GxHtml::encode($data->ten_tieng_viet); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('han_dung')); ?>:
	<?php echo GxHtml::encode($data->han_dung); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('don_vi_tinh')); ?>:
	<?php echo GxHtml::encode($data->don_vi_tinh); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('ton_toi_thieu')); ?>:
	<?php echo GxHtml::encode($data->ton_toi_thieu); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('huong_dan_su_dung')); ?>:
	<?php echo GxHtml::encode($data->huong_dan_su_dung); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('mo_ta')); ?>:
	<?php echo GxHtml::encode($data->mo_ta); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('trang_thai')); ?>:
	<?php echo GxHtml::encode($data->trang_thai); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('nha_cung_cap_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->nhaCungCap)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('loai_san_pham_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->loaiSanPham)); ?>
	<br />
	*/ ?>

</div>