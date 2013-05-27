
    <?php $this->widget('zii.widgets.CMenu',array(
        'id'=>'navigation',
        'items'=>array(
            array('label'=>Yii::t('viLib','Branch management'), 'url'=>array('/quanlychinhanh/chiNhanh/danhsach')),
            array('label'=>Yii::t('viLib','Employee management'), 'url'=>array('/quanlynhanvien/nhanVien/danhsach')),
            array('label'=>Yii::t('viLib','Sales management'), 'url'=>array('/quanlybanhang/hoaDonBanHang/danhsach')),
            array('label'=>Yii::t('viLib','Customer management'), 'url'=>array('/quanlykhachhang/khachHang/danhsach')),
            array('label'=>Yii::t('viLib','Product management'), 'url'=>array('/quanlysanpham/sanPham/danhsach')),
            array('label'=>Yii::t('viLib','Import/Export management'), 'url'=>array('/quanlynhapxuat/chiNhanh/danhsach')),
            array('label'=>Yii::t('viLib','Promotion management'), 'url'=>array('/quanlykhuyenmai/khuyenMai/danhsach')),
            array('label'=>Yii::t('viLib','Supplier management'), 'url'=>array('/quanlynhacungcap/nhaCungCap/danhsach')),
            array('label'=>Yii::t('viLib','Report management'), 'url'=>array('/quanlybaocao/baoCao/danhsach')),
            array('label'=>Yii::t('viLib','Decentralization management'), 'url'=>array('/quanlyphanquyen/assignment/danhsach')),
            array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
            array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
        ),
        'htmlOptions'=>array('class'=>'sf-navbar')
    )); ?>
