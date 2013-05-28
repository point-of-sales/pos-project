<?php

$this->breadcrumbs = array(
	'Quản lý bán hàng' => array('danhsach'),
	'Trả hàng hóa đơn '.GxHtml::valueEx($model),
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . 'Hóa đơn bán', 'url' => array('danhsach')),
    array('label' => Yii::t('viLib', 'Add') . ' ' . 'Hóa đơn bán', 'url' => array('them')),
    array('label' => Yii::t('viLib', 'Export') . ' ' . Yii::t('viLib', 'File Excel'), 'url'=>array('xuat', 'id' => $model->id)),
);
?>

<h1><?php echo 'Trả hàng hóa đơn '.GxHtml::valueEx($model); ?></h1>

<?php $form = $this->beginWidget('GxActiveForm', array(
	'enableAjaxValidation' => false,
    'id' => 'form',
));
?>

<div class="row cus-row">
		<?php echo $form->hiddenField($model->hoaDonTraHangs, 'id') ?>
</div>
<?php
$this->widget('ext.custom-widgets.DetailView4Col', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'Tên khách hàng',
            'type' => 'raw',
            'value' => $model->khachHang->ho_ten,
        ),
        array(
            'name' =>Yii::t('viLib','Voucher code'),
            'type' => 'raw',
            'value' => $model->baseModel->ma_chung_tu,
        ),
        array(
            'name' => 'Điện thoại',
            'type' => 'raw',
            'value' => $model->khachHang->dien_thoai,
        ),
        array(
            'name' => Yii::t('viLib','Created date'),
            'type' => 'raw',
            'value' => date('d/m/Y - h:i:s',strtotime($model->baseModel->ngay_lap)),
        ),
        array(
            'name' => 'Địa chỉ',
            'type' => 'raw',
            'value' => $model->khachHang->dia_chi,
        ),
        array(
            'name' => Yii::t('viLib','Created employee'),
            'type' => 'raw',
            'value' => $model->baseModel->nhanVien->ho_ten,
        ),
        array(
            'name' => 'Loại khách hàng',
            'type' => 'raw',
            'value' => $model->khachHang->loaiKhachHang->ten_loai,
        ),
        array(
            'name' =>'Chi nhánh bán',
            'type' => 'raw',
            'value' => $model->baseModel->chiNhanh->ten_chi_nhanh,
        ),
        array(
            'name' => 'Giảm giá',
            'type' => 'raw',
            'value' => $model->chiet_khau.'%',
        ),
        array(
            'name' => 'Trị giá',
            'type' => 'raw',
            'value' => $model->baseModel->tri_gia,
        ),
    ),
)); ?>
<div style="margin-bottom: 10px;text-align: center;">
    <span style="font-weight: bold;">Lý do trả hàng: </span>
    <input name="ly_do_tra_hang" type="text" style="width: 500px;" />
    <input type="hidden" name="hoa_don_ban_id" value="<?php echo $model->id?>" />
</div>
<h2>Chi tiết hàng bán</h2>
<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'grid',
    'dataProvider' => $dataProvider,
    'rowHtmlOptionsExpression'=>'array("id"=>"row_".$data->san_pham_id)',
    'columns' => array(
        array(
            'name' => Yii::t('viLib', 'Barcode'),
            'value' => '$data->sanPham->ma_vach',
        ),
        array('name' => Yii::t('viLib', 'Product name'),
            'value' => '$data->sanPham->ten_san_pham'
        ),
        array('name' => 'Đơn vị tính',
            'value' => '$data->sanPham->don_vi_tinh'
        ),
        array(
            'name' => Yii::t('viLib', 'Quantity'),
            'type' =>'raw',
            'value' => 'CHtml::textField("so_luong[$data->san_pham_id]",$data->so_luong,array("id"=>"sl_".$data->san_pham_id,"style"=>"width:50px;text-align:center;"))',
            'htmlOptions'=>array("class"=>"td-center"),
        ),
        array(
            'name' => 'Đơn giá',
            'type' => 'raw',
            'value' => 'CHtml::textField("don_gia[$data->san_pham_id]",$data->don_gia,array("readonly"=>"readonly"))',
        ),
        array(
            'name' => 'Xóa',
            'type' =>'raw',
            'value' => 'CHtml::checkBox("chk[]",false,array("id"=>$data->san_pham_id,"value"=>$data->san_pham_id,"onclick"=>"xoa_grid($data->san_pham_id)"))',
            'htmlOptions'=>array("class"=>"td-center"),
        ),
    ),
)); 
?>
<div style="text-align: right;">
    <input type="submit" value="In hóa đơn" class="button" />
</div>
<?php $this->endWidget();?>
<script type="text/javascript">
function xoa_grid(id){
    $("#row_"+id).remove();
}
</script>