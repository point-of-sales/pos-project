<?php
/**
 * User: ${Cristazn}
 * Date: 5/15/13
 * Time: 11:15 AM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */

class CPOSBanHangForm extends CFormModel {
    public $chi_nhanh_id;
    public $thoi_gian_bat_dau;
    public $thoi_gian_ket_thuc;

    public function attributeLabels()
    {
        return array(
            'chi_nhanh_id'=>Yii::t('viLib','Branch'),
            'thoi_gian_bat_dau'=>Yii::t('viLib','Start date'),
            'thoi_gian_ket_thuc'=>Yii::t('viLib','End date'),
        );
    }

}