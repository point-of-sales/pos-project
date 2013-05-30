<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('ly_do_tra_hang')); ?>:
	<?php echo GxHtml::encode($data->ly_do_tra_hang); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('hoa_don_ban_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->hoaDonBan)); ?>
	<br />

</div>