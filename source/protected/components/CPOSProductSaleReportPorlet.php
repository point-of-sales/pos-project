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
        $this->render('_formbanhangsanpham',array('model'=>$form));
    }

}