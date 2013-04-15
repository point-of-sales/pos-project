<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('ma_khach_hang')); ?>:
	<?php echo GxHtml::encode($data->ma_khach_hang); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('ho_ten')); ?>:
	<?php echo GxHtml::encode($data->ho_ten); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('ngay_sinh')); ?>:
	<?php echo GxHtml::encode($data->ngay_sinh); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('dia_chi')); ?>:
	<?php echo GxHtml::encode($data->dia_chi); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('thanh_pho')); ?>:
	<?php echo GxHtml::encode($data->thanh_pho); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('dien_thoai')); ?>:
	<?php echo GxHtml::encode($data->dien_thoai); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('email')); ?>:
	<?php echo GxHtml::encode($data->email); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('mo_ta')); ?>:
	<?php echo GxHtml::encode($data->mo_ta); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('diem_tich_luy')); ?>:
	<?php echo GxHtml::encode($data->diem_tich_luy); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('loai_khach_hang_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->loaiKhachHang)); ?>
	<br />
	*/ ?>

</div>