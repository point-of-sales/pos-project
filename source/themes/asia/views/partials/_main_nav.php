<?php
$currentRoleWeight = RightsWeight::getRoleWeight(Yii::app()->user->id);
switch ($currentRoleWeight) {
    case 1:
    {
        $menuItems = array(
            array('label' => Yii::t('viLib', 'Sales management'), 'url' => array('/quanlybanhang/hoaDonBanHang/danhsach')),
            array('label' => Yii::t('viLib', 'Customer management'), 'url' => array('/quanlykhachhang/khachHang/danhsach')),
            array('label' => Yii::t('viLib', 'Product management'), 'url' => array('/quanlysanpham/sanPham/danhsach')),
        );
        break;
    }
    case 2:
    {
        $menuItems = array(
            array('label' => Yii::t('viLib', 'Product management'), 'url' => array('/quanlysanpham/sanPham/danhsach')),
            array('label' => Yii::t('viLib', 'Import/Export management'), 'url' => array('/quanlynhapxuat/chiNhanh/danhsach')),
        );
        break;
    }
    case 3:
    {
        $menuItems = array(
            array('label' => Yii::t('viLib', 'Branch management'), 'url' => array('/quanlychinhanh/chiNhanh/danhsach')),
            array('label' => Yii::t('viLib', 'Employee management'), 'url' => array('/quanlynhanvien/nhanVien/danhsach')),
            array('label' => Yii::t('viLib', 'Sales management'), 'url' => array('/quanlybanhang/hoaDonBanHang/danhsach')),
            array('label' => Yii::t('viLib', 'Customer management'), 'url' => array('/quanlykhachhang/khachHang/danhsach')),
            array('label' => Yii::t('viLib', 'Product management'), 'url' => array('/quanlysanpham/sanPham/danhsach')),
            array('label' => Yii::t('viLib', 'Promotion management'), 'url' => array('/quanlykhuyenmai/khuyenMai/danhsach')),
            array('label' => Yii::t('viLib', 'Supplier management'), 'url' => array('/quanlynhacungcap/nhaCungCap/danhsach')),
            array('label' => Yii::t('viLib', 'Import/Export management'), 'url' => array('/quanlynhapxuat/chiNhanh/danhsach')),
            array('label' => Yii::t('viLib', 'Report management'), 'url' => array('/quanlybaocao/baoCao/danhsach')),
        );
        break;
    }
    case 999:
    {
        $menuItems = array(
            array('label' => Yii::t('viLib', 'Branch management'), 'url' => array('/quanlychinhanh/chiNhanh/danhsach')),
            array('label' => Yii::t('viLib', 'Employee management'), 'url' => array('/quanlynhanvien/nhanVien/danhsach')),
            array('label' => Yii::t('viLib', 'Sales management'), 'url' => array('/quanlybanhang/hoaDonBanHang/danhsach')),
            array('label' => Yii::t('viLib', 'Customer management'), 'url' => array('/quanlykhachhang/khachHang/danhsach')),
            array('label' => Yii::t('viLib', 'Product management'), 'url' => array('/quanlysanpham/sanPham/danhsach')),
            array('label' => Yii::t('viLib', 'Import/Export management'), 'url' => array('/quanlynhapxuat/chiNhanh/danhsach')),
            array('label' => Yii::t('viLib', 'Promotion management'), 'url' => array('/quanlykhuyenmai/khuyenMai/danhsach')),
            array('label' => Yii::t('viLib', 'Supplier management'), 'url' => array('/quanlynhacungcap/nhaCungCap/danhsach')),
            array('label' => Yii::t('viLib', 'Report management'), 'url' => array('/quanlybaocao/baoCao/danhsach')),
            array('label' => Yii::t('viLib', 'Decentralization management'), 'url' => array('/quanlyphanquyen/assignment/danhsach')),
        );
        break;
    }
}

if (isset($menuItems)) {
    $this->widget('zii.widgets.CMenu', array(
        'id' => 'navigation',
        'items' => $menuItems,
        'htmlOptions' => array('class' => 'sf-navbar')
    ));
}
?>