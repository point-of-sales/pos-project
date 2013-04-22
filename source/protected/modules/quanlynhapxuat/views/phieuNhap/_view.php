<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('loai_nhap_vao')); ?>:
	<?php echo GxHtml::encode($data->loai_nhap_vao); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('chi_nhanh_xuat_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->chiNhanhXuat)); ?>
	<br />

</div>