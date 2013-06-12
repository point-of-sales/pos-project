<?php
/**
 * User: ${Cristazn}
 * Date: 5/14/13
 * Time: 11:02 AM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */
Yii::import('zii.widgets.CPortlet');

class CPOSImportExportReportPortlet extends CPortlet {

    protected  function renderContent() {
        $form = new CPOSNhapXuatTonForm();
        $form->thoi_gian_bat_dau = date('d-m-Y',time()-30*24*60*60);
        $form->thoi_gian_ket_thuc = date('d-m-Y',time());
        if(isset($_POST['CPOSNhapXuatTonForm'])) {
            $form->chi_nhanh_id = $_POST['CPOSNhapXuatTonForm']['chi_nhanh_id'];
            $form->thoi_gian_bat_dau = $_POST['CPOSNhapXuatTonForm']['thoi_gian_bat_dau'];
            $form->thoi_gian_ket_thuc = $_POST['CPOSNhapXuatTonForm']['thoi_gian_ket_thuc'];
        }
        $this->render('_formnhapxuatton',array('model'=>$form));
    }


}