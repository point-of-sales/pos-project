<?php if (Yii::app()->user->hasFlash('info-board')) { ?>
    <div class="response-msg error ui-corner-all info-board">
        <?php echo Yii::app()->user->getFlash('info-board');?>
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
    array('label' => Yii::t('viLib', 'List') . ' ' . $model->label(2), 'url' => array('danhsach')),
    array('label' => Yii::t('viLib', 'Add') . ' ' . $model->label(), 'url' => array('them')),
    array('label' => Yii::t('viLib', 'Add') . ' ' . Yii::t('viLib', 'Price checkpoint'), 'url' => array('mocGia/them', 'spid' => $model->id)),
    array('label' => Yii::t('viLib', 'Update') . ' ' . $model->label(), 'url' => array('capnhat', 'id' => $model->id)),
    array('label' => Yii::t('viLib', 'Delete') . ' ' . $model->label(), 'url' => '#', 'linkOptions' => array('submit' => array('xoa', 'id' => $model->id), 'confirm' => Yii::t('viLib', 'Are you sure you want to delete this item?'))),
);
?>


<h1><?php echo Yii::t('viLib', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'ma_vach',
        'ten_san_pham',
        'ten_tieng_viet',
        'han_dung',
        'don_vi_tinh',
        'ton_toi_thieu',
        'huong_dan_su_dung',
        'mo_ta',
        array(
            'name' => 'trang_thai',
            'type' => 'raw',
            'value' => $model->layTenTrangThai(),
        ),
        array(
            'name' => 'nhaCungCap',
            'type' => 'raw',
            'value' => $model->nhaCungCap !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->nhaCungCap,'ten_nha_cung_cap')), array('nhaCungCap/view', 'id' => GxActiveRecord::extractPkValue($model->nhaCungCap, true))) : null,
        ),
        array(
            'name' => 'loaiSanPham',
            'type' => 'raw',
            'value' => $model->loaiSanPham !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->loaiSanPham,'ten_loai')), array('loaiSanPham/view', 'id' => GxActiveRecord::extractPkValue($model->loaiSanPham, true))) : null,
        ),
        array('name'=>Yii::t('viLib','Current price'),
              'type'=>'raw',
              'value'=>$giaHienTai,
        ),
    ),
)); ?>



<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'grid',
    'dataProvider' => $danhSachMocGia,
    'columns' => array(
        array('name'=>'thoi_gian_bat_dau',
              'header'=>Yii::t('viLib','Times'),
              'value'=>'$data->layKhoangThoiGian()',
        ),
        'gia_ban',
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
            'buttons' => array(
                'update' => array(
                    'url' => 'Yii::app()->createUrl(Yii::app()->controller->module->id ."/". "mocGia" ."/". "capnhat",array("id"=>$data->id))',
                    'label' => Yii::t('viLib', 'View'),
                ),
                'delete' => array(
                    'url' => 'Yii::app()->createUrl(Yii::app()->controller->module->id ."/". "mocGia" ."/". "xoagrid",array("id"=>$data->id))',
                    'label' => Yii::t('viLib', 'Delete'),
                    'click' => "js:function(){

                    var r = confirm('Bạn có muốn xóa không ?');
                    if(r) {
                        var url = $(this).attr('href');
                         $.fn.yiiGridView.update('grid', {  //change my-grid to your grid's name
                         type:'POST',
                         url:$(this).attr('href'),
                         success:function(data) {
                            if(jQuery.type(data) == 'string' && data!='') {
                                $('.search-form').after(
                                    '<div class=error>'+data+'</div>'
                            );
                            $('.error').addClass('response-msg');
                            $('.error').addClass('ui-corner-all')
                            $('.error').fadeOut(5000);
                         }

                         $.fn.yiiGridView.update('grid'); //change my-grid to your grid's name
                    }
                    })
                        return false;
                    } else {
                        return false;
                        }
                    }",
                ),


            ),
        ),
    ),


));
?>

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
