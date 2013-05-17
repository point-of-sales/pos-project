<?php
/**
 * User: ${Cristazn}
 * Date: 5/17/13
 * Time: 6:43 AM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */

class CPOSBanHangTopForm extends CFormModel {
    public $top;
    public $chi_nhanh_id;
    public $thoi_gian_bat_dau;
    public $thoi_gian_ket_thuc;

    public function attributeLabels()
    {
        return array(
            'top'=>Yii::t('viLib','Top'),
            'chi_nhanh_id'=>Yii::t('viLib','Branch'),
            'thoi_gian_bat_dau'=>Yii::t('viLib','Start date'),
            'thoi_gian_ket_thuc'=>Yii::t('viLib','End date'),
        );
    }
}