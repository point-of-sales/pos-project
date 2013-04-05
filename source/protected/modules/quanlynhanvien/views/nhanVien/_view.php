<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('danhsach', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('ma_nhan_vien')); ?>:
	<?php echo GxHtml::encode($data->ma_nhan_vien); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('ho_ten')); ?>:
	<?php echo GxHtml::encode($data->ho_ten); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('email')); ?>:
	<?php echo GxHtml::encode($data->email); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('dien_thoai')); ?>:
	<?php echo GxHtml::encode($data->dien_thoai); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('dia_chi')); ?>:
	<?php echo GxHtml::encode($data->dia_chi); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('gioi_tinh')); ?>:
	<?php echo GxHtml::encode($data->gioi_tinh); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('ngay_sinh')); ?>:
	<?php echo GxHtml::encode($data->ngay_sinh); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('trinh_do')); ?>:
	<?php echo GxHtml::encode($data->trinh_do); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('luong_co_ban')); ?>:
	<?php echo GxHtml::encode($data->luong_co_ban); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('chuyen_mon')); ?>:
	<?php echo GxHtml::encode($data->chuyen_mon); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('trang_thai')); ?>:
	<?php echo GxHtml::encode($data->trang_thai); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('mat_khau')); ?>:
	<?php echo GxHtml::encode($data->mat_khau); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('ngay_vao_lam')); ?>:
	<?php echo GxHtml::encode($data->ngay_vao_lam); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('lan_dang_nhap_cuoi')); ?>:
	<?php echo GxHtml::encode($data->lan_dang_nhap_cuoi); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('loai_nhan_vien_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->loaiNhanVien)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('chi_nhanh_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->chiNhanh)); ?>
	<br />
	*/ ?>

</div>