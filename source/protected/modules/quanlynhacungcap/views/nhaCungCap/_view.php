<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('ma_nha_cung_cap')); ?>:
	<?php echo GxHtml::encode($data->ma_nha_cung_cap); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('ten_nha_cung_cap')); ?>:
	<?php echo GxHtml::encode($data->ten_nha_cung_cap); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('mo_ta')); ?>:
	<?php echo GxHtml::encode($data->mo_ta); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('dien_thoai')); ?>:
	<?php echo GxHtml::encode($data->dien_thoai); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('email')); ?>:
	<?php echo GxHtml::encode($data->email); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('fax')); ?>:
	<?php echo GxHtml::encode($data->fax); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('trang_thai')); ?>:
	<?php echo GxHtml::encode($data->trang_thai); ?>
	<br />
	*/ ?>

</div>