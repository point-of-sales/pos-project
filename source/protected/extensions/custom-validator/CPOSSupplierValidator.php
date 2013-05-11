<?php
/**
 * User: ${Cristazn}
 * Date: 5/10/13
 * Time: 10:07 AM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */

class CPOSSupplierValidator extends CValidator {

    public function validateAttribute($object,$attribute) {
        $chi_nhanh_xuat_id = $object->$attribute;
        if($chi_nhanh_xuat_id == 1) {
            $nha_cung_cap_id = $object->nha_cung_cap_id;
            if($nha_cung_cap_id=='')
                $this->addError($object,$attribute,Yii::t('viLib','Suppier is required when export source is out of system'));

        }

    }

}