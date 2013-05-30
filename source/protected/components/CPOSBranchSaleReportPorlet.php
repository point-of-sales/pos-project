<?php
/**
 * User: ${Cristazn}
 * Date: 5/15/13
 * Time: 11:22 AM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */

Yii::import('zii.widgets.CPortlet');

class CPOSBranchSaleReportPorlet extends CPortlet {

    protected  function renderContent() {
        $form = new CPOSBanHangChiNhanhForm();
        if(isset($_POST['CPOSBanHangChiNhanhForm'])) {
            $form->chi_nhanh_id = $_POST['CPOSBanHangChiNhanhForm']['chi_nhanh_id'];
            $form->thoi_gian_bat_dau = $_POST['CPOSBanHangChiNhanhForm']['thoi_gian_bat_dau'];
            $form->thoi_gian_ket_thuc = $_POST['CPOSBanHangChiNhanhForm']['thoi_gian_ket_thuc'];
        }
        $this->render('_formbanhangchinhanh',array('model'=>$form));
    }

}