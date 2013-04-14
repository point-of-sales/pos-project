<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('ma_loai')); ?>:
	<?php echo GxHtml::encode($data->ma_loai); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('ten_loai')); ?>:
	<?php echo GxHtml::encode($data->ten_loai); ?>
	<br />

</div>