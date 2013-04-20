<?php
/**
 * User: ${Cristazn}
 * Date: 4/15/13
 * Time: 6:43 PM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */

/*
 * Lop cung cap valid cac format ngay thang
 */

class CPOSDateTimeValidator extends CValidator{

    public function validateAttribute($object,$attribute) {
        $currentTimeStamp = time();
        $inputDate = $object->$attribute;
        $inputDateTimeStamp = strtotime($inputDate) + 24*60*60;
        // kiem tra timestamp hien thoi va timestamp nguoi dung nhap vao co hop le hay khong
        if($currentTimeStamp > $inputDateTimeStamp ) {
            $this->addError($object,$attribute,Yii::t('viLib','Start time have to greater or equal current time'));
        }

    }



}