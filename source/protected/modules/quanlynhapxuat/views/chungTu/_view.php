<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('ma_chung_tu')); ?>:
	<?php echo GxHtml::encode($data->ma_chung_tu); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('ngay_lap')); ?>:
	<?php echo GxHtml::encode($data->ngay_lap); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('tri_gia')); ?>:
	<?php echo GxHtml::encode($data->tri_gia); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('ghi_chu')); ?>:
	<?php echo GxHtml::encode($data->ghi_chu); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('nhan_vien_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->nhanVien)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('chi_nhanh_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->chiNhanh)); ?>
	<br />

</div>