<?php
$this->breadcrumbs = array(
    'Quản lý bán hàng' => array('hoaDonBanHang/danhsach'),
    'Chi tiết hóa đơn bán '.$model->getBaseModel()->ma_chung_tu,
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . 'Hóa đơn bán', 'url' => array('danhsach')),
    array('label' => Yii::t('viLib', 'Add') . ' ' . 'Hóa đơn bán', 'url' => array('them')),
    array('label' => 'Trả hàng' . ' ' . 'Hóa đơn bán', 'url' => array('trahang','id'=>$model->id)),
    array('label' => Yii::t('viLib', 'Export') . ' ' . Yii::t('viLib', 'File Excel'), 'url'=>array('xuat', 'id' => $model->id)),
);
?>


    <h1><?php echo 'Hóa Đơn Bán' . ' ' . $model->getBaseModel()->ma_chung_tu; ?></h1>

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
)); 
?>

<?php
//echo '<h2>Chi tiết hóa đơn bán</h2>';
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'grid',
    'dataProvider' => $chiTietHangBanProvider,
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
            'value' => '$data->so_luong',
        ),
        array(
            'name' => 'Đơn giá',
            'value' => '$data->don_gia',
        ),
    )
));
?>
<?php
if(count($chiTietHangTangProvider->getData())!=0){
    echo '<h2>Chi tiết hàng tặng</h2>';
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'grid',
        'dataProvider' => $chiTietHangTangProvider,
        'columns' => array(
            array(
                'name' => Yii::t('viLib', 'Barcode'),
                'value' => '$data->sanPhamTang->ma_vach',
            ),
            array('name' => Yii::t('viLib', 'Product name'),
                'value' => '$data->sanPhamTang->ten_san_pham'
            ),
            array(
                'name' => Yii::t('viLib', 'Quantity'),
                'value' => '$data->so_luong',
            ),
            array(
                'name' => 'Đơn giá tặng',
                'value' => '$data->sanPhamTang->gia_tang',
            ),
        )
    ));
}
?>

<?php
if(count($hdTraProvider->getData())!=0){
    echo '<h2>Hóa đơn trả</h2>';
    foreach($hdTraProvider->getData() as $item){
        echo '<hr style="margin:10px 0 !important"/>';
        $item->getBaseModel();
        $this->widget('ext.custom-widgets.DetailView4Col', array(
            'data' => $hdTraProvider,
            'attributes' => array(
                array(
                    'name' =>Yii::t('viLib','Voucher code'),
                    'type' => 'raw',
                    'value' => $item->baseModel->ma_chung_tu,
                ),
                array(
                    'name' => Yii::t('viLib','Created date'),
                    'type' => 'raw',
                    'value' => date('d/m/Y - h:i:s',strtotime($item->baseModel->ngay_lap)),
                ),
                array(
                    'name' => Yii::t('viLib','Created employee'),
                    'type' => 'raw',
                    'value' => $item->baseModel->nhanVien->ho_ten,
                ),
                array(
                    'name' => 'Trị giá',
                    'type' => 'raw',
                    'value' => $item->baseModel->tri_gia,
                ),
                array(
                    'name' => 'Lý do trả hàng',
                    'type' => 'raw',
                    'value' => $item->ly_do_tra_hang,
                ),
                array(
                    'value' => '',
                ),
            ),
        ));  
        //chi tiet hoa don ban hang
        $id = $item->id;
        $criteria = new CDbCriteria();
        $criteria->condition = 'hoa_don_tra_id=:hoa_don_tra_id';
        $criteria->params = array(':hoa_don_tra_id' => $id);
        $chiTietHangTraProvider = new CActiveDataProvider('ChiTietHoaDonTra', array('criteria' => $criteria));
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'grid',
            'dataProvider' => $chiTietHangTraProvider,
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
                    'value' => '$data->so_luong',
                ),
                array(
                    'name' => 'Đơn giá',
                    'value' => '$data->don_gia',
                ),
            )
        ));
    }
}
?>

    <!--
<h2><?php /*echo GxHtml::encode($model->getRelationLabel('tblSanPhams')); */?></h2>
--><?php
/*	echo GxHtml::openTag('ul');
	foreach($model->tblSanPhams as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('sanPham/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
*/
?>