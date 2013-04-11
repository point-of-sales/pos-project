<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('ma_loai_chi_nhanh')); ?>:
	<?php echo GxHtml::encode($data->ma_loai_chi_nhanh); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('ten_loai_chi_nhanh')); ?>:
	<?php echo GxHtml::encode($data->ten_loai_chi_nhanh); ?>
	<br />

</div>