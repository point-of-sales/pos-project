<?php
$fullModuleList = array(
    'Quanlybanhang' => array('label' => Yii::t('viLib', 'Sales management'), 'url' => array('/quanlybanhang/hoaDonBanHang/danhsach')),
    'Quanlykhachhang' => array('label' => Yii::t('viLib', 'Customer management'), 'url' => array('/quanlykhachhang/khachHang/danhsach')),
    'Quanlychinhanh' => array('label' => Yii::t('viLib', 'Branch management'), 'url' => array('/quanlychinhanh/chiNhanh/danhsach')),
    'Quanlysanpham' => array('label' => Yii::t('viLib', 'Product management'), 'url' => array('/quanlysanpham/sanPham/danhsach')),
    'Quanlynhapxuat' => array('label' => Yii::t('viLib', 'Import/Export management'), 'url' => array('/quanlynhapxuat/chiNhanh/danhsach')),
    'Quanlynhanvien' => array('label' => Yii::t('viLib', 'Employee management'), 'url' => array('/quanlynhanvien/nhanVien/danhsach')),
    'Quanlynhacungcap' => array('label' => Yii::t('viLib', 'Supplier management'), 'url' => array('/quanlynhacungcap/nhaCungCap/danhsach')),
    'Quanlykhuyenmai' => array('label' => Yii::t('viLib', 'Promotion management'), 'url' => array('/quanlykhuyenmai/khuyenMai/danhsach')),
    'Quanlybaocao' => array('label' => Yii::t('viLib', 'Report management'), 'url' => array('/quanlybaocao/baoCao/danhsach')),
    'Quanlyphanquyen' => array('label' => Yii::t('viLib', 'Decentralization management'), 'url' => array('/quanlyphanquyen/assignment/danhsach')),
    'Quanlycauhinh' => array('label' => Yii::t('viLib', 'Config management'), 'url' => array('/quanlycauhinh/cauHinh/chitiet/id/1')),
);

if (!Yii::app()->user->isGuest) {
    $currentUserModuleList = Rights::getCurrentUserModuleList();
    $menuItems = array();
    $currentRoleWeight = RightsWeight::getRoleWeight(Yii::app()->user->id);
    if ($currentRoleWeight < 999) {
        foreach ($fullModuleList as $key => $value) {
            if (in_array($key, $currentUserModuleList)) {
                $menuItems[] = $value;
            }
        }
    } else {
        // render full module for quan ly he thong
        foreach ($fullModuleList as $key => $value) {
            $menuItems[] = $value;
        }

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
