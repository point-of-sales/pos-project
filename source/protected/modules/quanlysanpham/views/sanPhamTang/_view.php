<div class="view">
<?php print_r($data);exit;?>

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('ma_vach')); ?>:
	<?php echo GxHtml::encode($data->ma_vach); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('ten_san_pham')); ?>:
	<?php echo GxHtml::encode($data->ten_san_pham); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('gia_tang')); ?>:
	<?php echo GxHtml::encode($data->gia_tang); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('thoi_gian_bat_dau')); ?>:
	<?php echo GxHtml::encode($data->formatDate('thoi_gian_bat_dau')); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('thoi_gian_ket_thuc')); ?>:
	<?php echo GxHtml::encode($data->formatDate('thoi_gian_ket_thuc')); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('mo_ta')); ?>:
	<?php echo GxHtml::encode($data->mo_ta); ?>
	<br />

    <br />
    <?php echo GxHtml::encode($data->getAttributeLabel('trang_thai')); ?>:
    <?php echo GxHtml::encode($data->trang_thai); ?>
    <br />

</div>