<?php
/**
 * User: ${Cristazn}
 * Date: 5/14/13
 * Time: 1:12 PM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */

class  CPOSNhapXuatTonForm extends CFormModel {
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