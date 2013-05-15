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
        $this->render('_formnhapxuatton',array('model'=>$form));
    }


}