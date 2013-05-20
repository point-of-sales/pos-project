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
        $this->render('_formbanhangtop',array('model'=>$form));
    }
}