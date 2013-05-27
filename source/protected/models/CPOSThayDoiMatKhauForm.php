<?php
/**
 * User: ${Cristazn}
 * Date: 5/23/13
 * Time: 3:20 PM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */

class CPOSThayDoiMatKhauForm extends  CFormModel{

    public $nhanVien;
    public $mat_khau_moi_1;
    public $mat_khau_moi_2;

    public function rules() {
        return array(
            array('mat_khau_moi_1,mat_khau_moi_2','required'),
            array('mat_khau_moi_1','compare','compareAttribute'=>'mat_khau_moi_2'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'mat_khau_moi_1' => Yii::t('viLib', 'New password 1'),
            'mat_khau_moi_2' => Yii::t('viLib', 'New password 2'),

        );
    }

    public function capNhatMatKhau($params) {
        $this->setAttributes($params);
        if($this->validate()) {
            $mat_khau_moi = md5($params['mat_khau_moi_1']);
            if($this->nhanVien->saveAttributes(array('mat_khau'=>$mat_khau_moi)))
                return 'ok';
            else
                return 'fail';

        }
    }

}