<?php
/**
 * User: ${Cristazn}
 * Date: 5/10/13
 * Time: 5:08 PM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980
 */

class CPOSBranchValidator extends CValidator
{
    public function validateAttribute($object, $attribute)
    {
        $baseModel = $object->getBaseModel();
        if ($baseModel != null) {
            if ($object->$attribute == $baseModel->getAttribute('chi_nhanh_id')) {
                $this->addError($object, $attribute, Yii::t('viLib', 'Can not import/export from same branch'));
            }
        }

    }
}