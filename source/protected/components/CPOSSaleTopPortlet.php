<?php
/**
 * User: ${Cristazn}
 * Date: 5/17/13
 * Time: 6:41 AM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */
Yii::import('zii.widgets.CPortlet');

class CPOSSaleTopPortlet  extends CPortlet {
    protected  function renderContent() {
        $form = new CPOSBanHangTopForm();
        $form->thoi_gian_bat_dau = date('d-m-Y',time()-30*24*60*60);
        $form->thoi_gian_ket_thuc = date('d-m-Y',time());
        if(isset($_POST['CPOSBanHangTopForm'])) {
            $form->top = $_POST['CPOSBanHangTopForm']['top'];
            $form->chi_nhanh_id = $_POST['CPOSBanHangTopForm']['chi_nhanh_id'];
            $form->thoi_gian_bat_dau = $_POST['CPOSBanHangTopForm']['thoi_gian_bat_dau'];
            $form->thoi_gian_ket_thuc = $_POST['CPOSBanHangTopForm']['thoi_gian_ket_thuc'];
        }
        $this->render('_formbanhangtop',array('model'=>$form));
    }
}