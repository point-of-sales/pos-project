
    <?php $this->widget('zii.widgets.CMenu',array(
        'id'=>'navigation',
        'items'=>array(
            array('label'=>'Home', 'url'=>array('/site/index')),
            array('label'=>'Quản lý chi nhánh', 'url'=>array('/quanlychinhanh/chiNhanh/danhsach')),
            array('label'=>'Quản lý nhân viên', 'url'=>array('/quanlynhanvien/nhanVien/danhsach')),
            array('label'=>'Quản lý bán hàng', 'url'=>array('/quanlybanhang/hoadonbanhang/danhsach')),
            array('label'=>'Quản lý khách hàng', 'url'=>array('/quanlykhachhang/khachhang/danhsach')),
            array('label'=>'Quản lý sản phẩm', 'url'=>array('/quanlysanpham/sanPham/danhsach')),
            array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
            array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
        ),
        'htmlOptions'=>array('class'=>'sf-navbar')
    )); ?>
