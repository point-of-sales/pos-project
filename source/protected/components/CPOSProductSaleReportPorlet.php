<?php
/**
 * User: ${Cristazn}
 * Date: 5/16/13
 * Time: 3:50 PM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */

Yii::import('zii.widgets.CPortlet');

class CPOSProductSaleReportPorlet extends CPortlet {

    protected  function renderContent() {
        $form = new CPOSBanHangSanPhamForm();
        if(isset($_POST['CPOSBanHangSanPhamForm'])) {
            $form->ma_vach = $_POST['CPOSBanHangSanPhamForm']['ma_vach'];
            $form->chi_nhanh_id = $_POST['CPOSBanHangSanPhamForm']['chi_nhanh_id'];
            $form->thoi_gian_bat_dau = $_POST['CPOSBanHangSanPhamForm']['thoi_gian_bat_dau'];
            $form->thoi_gian_ket_thuc = $_POST['CPOSBanHangSanPhamForm']['thoi_gian_ket_thuc'];
        }
        $this->render('_formbanhangsanpham',array('model'=>$form));
    }

}