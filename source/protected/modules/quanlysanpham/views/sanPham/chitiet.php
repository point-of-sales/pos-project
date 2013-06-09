<?php if (Yii::app()->user->hasFlash('info-board')) { ?>
    <div class="response-msg error ui-corner-all info-board">
        <?php echo Yii::app()->user->getFlash('info-board'); ?>
    </div>
<?php } ?>

<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Product management') => array('sanPham/danhsach'),
    Yii::t('viLib', 'Product') => array('sanPham/danhsach'),
    Yii::t('viLib', 'Detail') => array(),
    GxHtml::valueEx($model),
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Product'), 'url' => array('danhsach'), 'visible' => Yii::app()->user->checkAccess('Quanlysanpham.SanPham.DanhSach')),
    array('label' => Yii::t('viLib', 'Add') . ' ' . Yii::t('viLib', 'Product'), 'url' => array('them'), 'visible' => Yii::app()->user->checkAccess('Quanlysanpham.SanPham.Them')),
    array('label' => Yii::t('viLib', 'Add') . ' ' . Yii::t('viLib', 'Price checkpoint'), 'url' => array('mocGia/them', 'spid' => $model->id)),
    //array('label' => Yii::t('viLib', 'View') . ' ' . Yii::t('viLib', 'Sales ????? '), 'url' => array('')),
    array('label' => Yii::t('viLib', 'Update') . ' ' . Yii::t('viLib', 'Product'), 'url' => array('capnhat', 'id' => $model->id), 'visible' => Yii::app()->user->checkAccess('Quanlysanpham.SanPham.CapNhat')),
    array('label' => Yii::t('viLib', 'Delete') . ' ' . Yii::t('viLib', 'Product'), 'url' => '#', 'linkOptions' => array('submit' => array('xoa', 'id' => $model->id), 'confirm' => Yii::t('viLib', 'Are you sure you want to delete this item?')), 'visible' => Yii::app()->user->checkAccess('Quanlysanpham.SanPham.Xoa')),
    array('label' => Yii::t('viLib', 'Export') . ' ' . Yii::t('viLib', 'Price checkpoint') . ' ' . Yii::t('viLib', 'File Excel'), 'url' => array('mocGia/xuat', 'spid' => $model->id), 'visible' => Yii::app()->user->checkAccess('Quanlysanpham.MocGia.Xuat')),
);
?>


<h1><?php echo Yii::t('viLib', 'View') . ' ' . Yii::t('viLib', 'Product') . ' ' . $model->ten_san_pham; ?></h1>

<?php $this->widget('ext.custom-widgets.DetailView4Col', array(
    'data' => $model,
    'attributes' => array(
        'ma_vach', 'ten_san_pham',
        'ten_tieng_viet', 'han_dung',
        'don_vi_tinh', 'ton_toi_thieu',
        'huong_dan_su_dung', 'mo_ta',
        array(
            'name' => 'trang_thai',
            'type' => 'raw',
            'value' => $model->layTenTrangThai(),
        ),
        array(
            'name' => 'nhaCungCap',
            'type' => 'raw',
            'value' => $model->nhaCungCap !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->nhaCungCap, 'ten_nha_cung_cap')), array('nhaCungCap/view', 'id' => GxActiveRecord::extractPkValue($model->nhaCungCap, true))) : null,
        ),
        array(
            'name' => 'loaiSanPham',
            'type' => 'raw',
            'value' => $model->loaiSanPham !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->loaiSanPham, 'ten_loai')), array('loaiSanPham/view', 'id' => GxActiveRecord::extractPkValue($model->loaiSanPham, true))) : null,
        ),
        array('name' => Yii::t('viLib', 'Current price'),
            'type' => 'raw',
            'value' => number_format($model->layGiaHienTai(), 0, '.', ','),
        ),
        'gia_goc' => array(
            'name' => 'gia_goc',
            'value' => number_format($model->gia_goc, 0, '.', ','),
        ),
        array('name' => Yii::t('viLib', 'Current price with promotion'),
            'type' => 'raw',
            'value' => number_format($model->layGiaHienTaiKemKhuyenMai(), 0, '.', ','),
        ),


    ),
)); ?>

<?php // Cac moc gia cua san pham ?>
<div class="sub-title">
    <p><?php echo Yii::t('viLib', 'Prices level list') ?></p>
</div>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'grid',
    'dataProvider' => $model->layDanhSachMocGia(),
    'columns' => array(
        array('name' => 'thoi_gian_bat_dau',
            'header' => Yii::t('viLib', 'Times'),
            'value' => '$data->layKhoangThoiGian()',
        ),
        'gia_ban' => array(
            'name' => 'gia_ban',
            'value' => 'number_format($data->gia_ban,0,".",",")',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
                'update' => array(
                    'url' => 'Helpers::urlRouting(Yii::app()->controller,"mocGia","capnhat",array("id"=>$data->id))',
                    'label' => Yii::t('viLib', 'Update'),
                ),
                'delete' => array(
                    'url' => 'Helpers::urlRouting(Yii::app()->controller,"mocGia","xoagrid",array("id"=>$data->id))',
                    'label' => Yii::t('viLib', 'Delete'),
                    'click' => Helpers::deleteButtonClick(),
                ),

            ),
        ),
    ),


));
?>
<?php // Cua hang chua san pham ?>
<div class="sub-title">
    <p><?php echo Yii::t('viLib', 'Stored at branch') ?></p>
</div>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'chi-nhanh-grid',
    'dataProvider' => $model->layDanhSachChiNhanh(),
    'columns' => array(
        'ma_chi_nhanh',
        'ten_chi_nhanh',
        array('name' => Yii::t('viLib', 'Instock'),
            'value' => 'number_format($data->laySoLuongTonSanPham(),0,".",",")'
        ),
        array('name' => 'trang_thai',
            'value' => '$data->layTenTrangThaiSanPhamOChiNhanh()'
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{active}',
            'buttons' => array(
                'active' => array(
                    'label' => '',
                    'url' => 'Yii::app()->createUrl("/quanlychinhanh/chiNhanh/ajaxActiveStatusProduct",array("cnid"=>$data->id,"spid"=>$data->san_pham_id))',
                    'options' => array('class' => 'active_button',
                        'title' => Yii::t('viLib', 'Active/Deactive this item'),
                        'id' => 'active_button'
                    ),
                    'imageUrl' => Yii::app()->request->baseUrl . '/themes/asia/images/icons/active.png',
                    'click' => Helpers::refreshGrid('chi-nhanh-grid'),

                ),
            ),
        ),
    ),

));
?>
<b>
    <?php
    echo GxHtml::encode(Yii::t('viLib', 'Total quantity') . ' : ' . number_format($model->layTongSoLuongTon(), 0, '.', ','));
    ?>
</b>

<!--<h2><?php /*echo GxHtml::encode($model->getRelationLabel('tblHoaDonBanHangs')); */?></h2>
<?php
/*	echo GxHtml::openTag('ul');
	foreach($model->tblHoaDonBanHangs as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('hoaDonBanHang/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
*/?><h2><?php /*echo GxHtml::encode($model->getRelationLabel('tblHoaDonTraHangs')); */?></h2>
<?php
/*	echo GxHtml::openTag('ul');
	foreach($model->tblHoaDonTraHangs as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('hoaDonTraHang/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
*/?><h2><?php /*echo GxHtml::encode($model->getRelationLabel('tblPhieuNhaps')); */?></h2>
<?php
/*	echo GxHtml::openTag('ul');
	foreach($model->tblPhieuNhaps as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('phieuNhap/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
*/?><h2><?php /*echo GxHtml::encode($model->getRelationLabel('tblPhieuXuats')); */?></h2>
<?php
/*	echo GxHtml::openTag('ul');
	foreach($model->tblPhieuXuats as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('phieuXuat/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
*/?><h2><?php /*echo GxHtml::encode($model->getRelationLabel('tblChiNhanhs')); */?></h2>
--><?php
/*	echo GxHtml::openTag('ul');
	foreach($model->tblChiNhanhs as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('chiNhanh/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
*/
?>
