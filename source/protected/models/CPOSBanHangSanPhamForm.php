<?php
/**
 * User: ${Cristazn}
 * Date: 5/16/13
 * Time: 3:53 PM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */

class CPOSBanHangSanPhamForm extends CFormModel {
    public $ma_vach;
    public $chi_nhanh_id;
    public $thoi_gian_bat_dau;
    public $thoi_gian_ket_thuc;

    public function attributeLabels()
    {
        return array(
            'ma_vach'=>Yii::t('viLib','Barcode'),
            'chi_nhanh_id'=>Yii::t('viLib','Branch'),
            'thoi_gian_bat_dau'=>Yii::t('viLib','Start date'),
            'thoi_gian_ket_thuc'=>Yii::t('viLib','End date'),
        );
    }

}