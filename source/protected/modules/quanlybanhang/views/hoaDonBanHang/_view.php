<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('chiet_khau')); ?>:
	<?php echo GxHtml::encode($data->chiet_khau); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('khach_hang_id')); ?>:
	<?php echo GxHtml::encode($data->khach_hang_id); ?>
	<br />

</div>