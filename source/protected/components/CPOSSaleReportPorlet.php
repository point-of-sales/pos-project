<?php
/**
 * User: ${Cristazn}
 * Date: 5/15/13
 * Time: 11:22 AM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */

Yii::import('zii.widgets.CPortlet');

class CPOSSaleReportPorlet extends CPortlet {

    protected  function renderContent() {
        $form = new CPOSBanHangForm();
        $this->render('_formbanhang',array('model'=>$form));
    }

}