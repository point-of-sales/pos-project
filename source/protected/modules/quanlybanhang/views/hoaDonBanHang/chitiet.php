<?php
$this->breadcrumbs = array(
    'Quản lý bán hàng' => array('hoaDonBanHang/danhsach'),
    'Chi tiết hóa đơn bán '.$model->getBaseModel()->ma_chung_tu,
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . 'Hóa đơn bán', 'url' => array('danhsach')),
    array('label' => Yii::t('viLib', 'Add') . ' ' . 'Hóa đơn bán', 'url' => array('them')),
    array('label' => 'Trả hàng' . ' ' . 'Hóa đơn bán', 'url' => array('trahang','id'=>$model->id)),
    //array('label' => Yii::t('viLib', 'Export') . ' ' . Yii::t('viLib', 'File Excel'), 'url'=>array('xuat', 'id' => $model->id)),
);
?>


    <h1><?php echo 'Hóa Đơn Bán' . ' ' . $model->getBaseModel()->ma_chung_tu; ?></h1>
<div class="xuat-file-menu">
    <ul>
        <li>
            <a href="<?php echo Yii::app()->createUrl('quanlybanhang/hoaDonBanHang/hoadon',array('id'=>$model->id))?>" title="print" target="_blank">
                <img alt="print" src="<?php echo Yii::app()->theme->baseUrl?>/images/icons/print.png"/>
            </a>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('quanlybanhang/hoaDonBanHang/xuatfileexcel',array('id'=>$model->id))?>" title="excel" target="_blank">
                <img alt="excel" src="<?php echo Yii::app()->theme->baseUrl?>/images/icons/excel.png"/>
            </a>
        </li>
    </ul>
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
            'name' => 'Mã khách hàng',
            'type' => 'raw',
            'value' => $model->khachHang->ma_khach_hang,
        ),
        array(
            'name' => Yii::t('viLib','Created date'),
            'type' => 'raw',
            'value' => date('d/m/Y - h:i:s',strtotime($model->baseModel->ngay_lap)),
        ),
        array(
            'name' => 'Điện thoại',
            'type' => 'raw',
            'value' => $model->khachHang->dien_thoai,
        ),
        array(
            'name' => Yii::t('viLib','Created employee'),
            'type' => 'raw',
            'value' => $model->baseModel->nhanVien->ho_ten,
        ),
        array(
            'name' => 'Địa chỉ',
            'type' => 'raw',
            'value' => $model->khachHang->dia_chi,
        ),
        array(
            'name' =>'Chi nhánh bán',
            'type' => 'raw',
            'value' => $model->baseModel->chiNhanh->ten_chi_nhanh,
        ),
        array(
            'name' => 'Loại khách hàng',
            'type' => 'raw',
            'value' => $model->khachHang->loaiKhachHang->ten_loai,
        ),
        array(
            'name' => 'Trị giá gốc',
            'type' => 'raw',
            'value' => number_format($model->baseModel->tri_gia,0,".",","),
        ),
        array(
            'name' => 'Giảm giá',
            'type' => 'raw',
            'value' => $model->chiet_khau.'%',
        ),
        array(
            'name' => 'Trị giá hiện tại',
            'type' => 'raw',
            'value' => number_format(HoaDonBanHang::layTriGiaHoaDonThuc($model->id),0,".",","),
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
            'value' => 'number_format($data->don_gia,0,".",",")',
        ),
        array(
            'name' => 'Trả hàng',
            'value' => array($this,'gridCoTraHang'),
            'type' => 'raw',
            'htmlOptions' => array('class'=>'center'),
        )
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
                'value' => 'number_format($data->sanPhamTang->gia_tang,0,".",",")',
            ),
        )
    ));
}
?>

<?php
if(count($hdTraProvider->getData())!=0){
    echo '<h2>Hóa đơn trả</h2>';
    echo '<div id="accordion">';
    foreach($hdTraProvider->getData() as $item){
        //echo '<hr style="margin:10px 0 !important"/>';
        //$item->getBaseModel();
        echo '<h3>'.'Mã CT: <span class="content-accordion">'.$item->baseModel->ma_chung_tu.'</span> Ngày lập: <span class="content-accordion">'.date('d/m/Y - h:i:s',strtotime($item->baseModel->ngay_lap)).'</span>Trị giá: <span class="content-accordion">'.number_format($item->baseModel->tri_gia,0,".",",").'</span></h3>';
        echo '<div>';
        ?>
        <div class="xuat-file-menu">
            <ul>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('quanlybanhang/hoaDonTraHang/hoadontra',array('id'=>$item->id,'p'=>'false'))?>" title="print" target="_blank">
                        <img alt="print" src="<?php echo Yii::app()->theme->baseUrl?>/images/icons/print.png"/>
                    </a>
                </li>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('quanlybanhang/hoaDonTraHang/xuatfileexcel',array('id'=>$item->id))?>" title="excel" target="_blank">
                        <img alt="excel" src="<?php echo Yii::app()->theme->baseUrl?>/images/icons/excel.png"/>
                    </a>
                </li>
            </ul>
        </div>
        <?php
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
                    'value' => number_format($item->baseModel->tri_gia,0,".",","),
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
                    'value' => 'number_format($data->don_gia,0,".",",")',
                ),
            )
        ));
        echo '</div>';
    }
    echo '</div>';
}
?>
<script type="text/javascript">
$(function(){
    $('#accordion').accordion({
        collapsible: true, 
        active: false,
        icons: false,
        heightStyle: 'fill',
        header: 'h2', 
    });
});
</script>

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