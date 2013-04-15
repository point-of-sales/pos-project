<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('thoi_gian_bat_dau')); ?>:
	<?php echo GxHtml::encode($data->thoi_gian_bat_dau); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('thoi_gian_ket_thuc')); ?>:
	<?php echo GxHtml::encode($data->thoi_gian_ket_thuc); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('gia_ban')); ?>:
	<?php echo GxHtml::encode($data->gia_ban); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('san_pham_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->sanPham)); ?>
	<br />

</div>