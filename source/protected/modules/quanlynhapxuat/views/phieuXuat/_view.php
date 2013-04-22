<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('ly_do_xuat')); ?>:
	<?php echo GxHtml::encode($data->ly_do_xuat); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('loai_xuat_ra')); ?>:
	<?php echo GxHtml::encode($data->loai_xuat_ra); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('chi_nhanh_nhap_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->chiNhanhNhap)); ?>
	<br />

</div>