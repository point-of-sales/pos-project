<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('ma_khu_vuc')); ?>:
	<?php echo GxHtml::encode($data->ma_khu_vuc); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('ten_khu_vuc')); ?>:
	<?php echo GxHtml::encode($data->ten_khu_vuc); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('mo_ta')); ?>:
	<?php echo GxHtml::encode($data->mo_ta); ?>
	<br />

</div>