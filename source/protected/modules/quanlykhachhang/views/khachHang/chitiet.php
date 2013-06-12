<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Customer management') => array('khachHang/danhsach'),
    Yii::t('viLib', 'Customer') => array('khachHang/danhsach'),
    Yii::t('viLib', 'Detail') . ' ' . Yii::t('viLib', 'Customer')=>array(),
    GxHtml::valueEx($model,"ho_ten"),

);

if($model->ma_khach_hang == 'KHBT'){
    $this->menu = array(
        array('label' => Yii::t('viLib', 'List') . ' ' .  Yii::t('viLib', 'Customer'), 'url' => array('danhsach'),'visible'=>Yii::app()->user->checkAccess('Quanlykhachhang.KhachHang.DanhSach')),
        array('label' => Yii::t('viLib', 'Add') . ' ' .  Yii::t('viLib', 'Customer'), 'url' => array('them'),'visible'=>Yii::app()->user->checkAccess('Quanlykhachhang.KhachHang.Them')),
        array('label' => Yii::t('viLib', 'Update') . ' ' .  Yii::t('viLib', 'Customer'), 'url' => array('capnhat', 'id' => $model->id),'visible'=>Yii::app()->user->checkAccess('Quanlykhachhang.KhachHang.CapNhat')),
    );
}
else{
    $this->menu = array(
        array('label' => Yii::t('viLib', 'List') . ' ' .  Yii::t('viLib', 'Customer'), 'url' => array('danhsach'),'visible'=>Yii::app()->user->checkAccess('Quanlykhachhang.KhachHang.DanhSach')),
        array('label' => Yii::t('viLib', 'Add') . ' ' .  Yii::t('viLib', 'Customer'), 'url' => array('them'),'visible'=>Yii::app()->user->checkAccess('Quanlykhachhang.KhachHang.Them')),
        array('label' => Yii::t('viLib', 'Update') . ' ' .  Yii::t('viLib', 'Customer'), 'url' => array('capnhat', 'id' => $model->id),'visible'=>Yii::app()->user->checkAccess('Quanlykhachhang.KhachHang.CapNhat')),
        array('label' => Yii::t('viLib', 'Delete') . ' ' .  Yii::t('viLib', 'Customer'), 'url' => '#', 'linkOptions' => array('submit' => array('xoa', 'id' => $model->id), 'confirm' => Yii::t('viLib', 'Are you sure you want to delete this item?')),'visible'=>Yii::app()->user->checkAccess('Quanlykhachhang.KhachHang.Xoa')),
    );   
}
?>


<h1><?php echo Yii::t('viLib', 'View') . ' ' .  Yii::t('viLib', 'Customer') . ' ' . GxHtml::encode(GxHtml::valueEx($model,"ho_ten")); ?></h1>

<?php $this->widget('ext.custom-widgets.DetailView4Col', array(
    'data' => $model,
    'attributes' => array(
        'ma_khach_hang',
        'ho_ten',
        'ngay_sinh',
        'dia_chi',
        'thanh_pho',
        'dien_thoai',
        'email',
        'mo_ta',
        'diem_tich_luy',
        array(
            'name' => 'loaiKhachHang',
            'type' => 'raw',
            'value' => $model->loaiKhachHang->ten_loai,
        ),
    ),
)); ?>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
'id' => 'grid',
'dataProvider' => $hoa_don_ban,
'columns' => array(
		array(
				'name'=>'Mã chứng từ',
				'value'=>'GxHtml::valueEx($data->chungTu)',
				'filter'=>GxHtml::listDataEx(ChungTu::model()->findAllAttributes(null, true)),
				),
        array(
            'name'=>'Ngày lập',
            'value' => 'date("d/m/Y - h:i:s",strtotime($data->getBaseModel()->ngay_lap))',
        ),
        array(
            'name'=>'Số SP gốc',
            'value' => 'count($data->chiTietHoaDonBan)',
            'htmlOptions'=>array('class'=>'center'),
        ),
        array(
            'name'=>'Trị giá gốc',
            'value' => 'number_format($data->getBaseModel()->tri_gia,0,".",",")',
        ),
        array(
            'name'=>'Số SP thực',
            'value' => array($this,'gridSoSanPhamThuc'),
            'htmlOptions'=>array('class'=>'center'),
        ),
        array(
            'name'=>'Trị giá thực',
            'value' => array($this,'gridTriGiaThuc'),
        ),
        array(
            'name'=>'Có HĐ trả',
            'type'=>'raw',
            'value'=>array($this,'gridCoHoaDonTra'),
            'htmlOptions'=>array('class'=>'center'),
        ),
    array(
        'class' => 'CButtonColumn',
        'template'=>'{view}{print}{return}',
        'buttons'=>array(
            'view'=>array(
                'url'=>'Yii::app()->baseUrl."/quanlybanhang/hoaDonBanHang/chitiet/id/".$data->id',
                'label'=>Yii::t('viLib','View'),
            ),
            'print'=>array(
                'url'=>'Yii::app()->baseUrl."/quanlybanhang/hoaDonBanHang/hoadon/id/".$data->id',
                'imageUrl'=>Yii::app()->theme->baseUrl . '/images/icons/print.png',
                'options'=>array('target'=>'_blank'),
            ),
            'return'=>array(
                'url'=>'Yii::app()->baseUrl."/quanlybanhang/hoaDonBanHang/trahang/id/".$data->id',
                'label'=>'Trả Hàng',
                'imageUrl'=>Yii::app()->theme->baseUrl . '/images/icons/return.png',
            ),
        ),
    ),
),
)); ?>