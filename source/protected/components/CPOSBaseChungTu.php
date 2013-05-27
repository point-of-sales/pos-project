<?php
/**
 * User: ${Cristazn}
 * Date: 4/23/13
 * Time: 11:30 AM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */

abstract class CPOSBaseChungTu extends CPOSActiveRecord {
    protected $baseTableName = 'ChungTu';
    protected $baseModel;
    protected $baseAttributes = array('id','ma_chung_tu','ngay_lap','tri_gia','ghi_chu','nhan_vien_id','chi_nhanh_id');


    public function __get($name) {
        if(in_array($name,$this->baseAttributes)) {
            if(isset($this->baseModel))
                return $this->baseModel->$name;
            else
                return $this->getAttribute($name);
        }
        else
            return parent::__get($name);
    }

    public function __set($name,$value) {
        if(in_array($name,$this->baseAttributes))
            return $this->baseModel->$name = $value;
        else
            return parent::__set($name,$value);
    }

    public function init() {
        if($this->baseModel === null) {
            if($this->isNewRecord)
                $this->baseModel = new ChungTu();
            else
                $this->baseModel = ChungTu::model()->find("id='{$this->getAttribute('id')}'");
        }
        if($this->baseModel != null)
            $this->baseModel->setScenario($this->scenario);
    }

    // set scenario duoc goi tu dong tu constructor cua abstract CActiveRecord
    public function setScenario($value) {
        parent::setScenario($value);

    }

    public function isAttributeRequired($attribute) {
        if(in_array($attribute,$this->baseAttributes))
            return $this->baseModel->isAttributeRequired($attribute);
        else
            return parent::isAttributeRequired($attribute);
    }

    public function getBaseModel() {
        if($this->baseModel === null ) {
            // tao moi 1 chung tu hoac tra ve no la mot chung tu trong csdl (neu dung load model)
            $this->baseModel = $this->isNewRecord ? new ChungTu():ChungTu::model()->find("id='{$this->getAttribute('id')}'");
            //neu van tim ko thay. Bye bye. Chuc ban may man lan sau ke ke;
            if($this->baseModel === null)
                throw new CException('Can not get base model for ' . get_class($this));
        }
        return $this->baseModel;
    }

    public function setAttributes($attributes=null,$safeOnly=true) {
        if(isset($attributes)) {
            parent::setAttributes($attributes[get_class($this)],$safeOnly);
            $this->baseModel->setAttributes($attributes[$this->baseTableName]);

        }

        // set tro nguoc lai cho base model

    }

    public function validate($attributes=null)
    {
        if (parent::validate($attributes)) {
            if ($this->baseModel->validate($attributes))
                return true;
            else {
                $this->addErrors($this->baseModel->getErrors());
                return false;
            }
        }
        else
            return false;

    }

    public function save($runValidation=true,$attributes=null)
    {   //valid truoc khi save (Validate base + sub)
        $valid = $runValidation ? $this->validate($attributes):true;

        if ($valid) {
            // save baseModel truoc
            if ($this->baseModel->save(false,$attributes)) {
                if ($this->isNewRecord) {
                    $baseModelSavedRecord = ChungTu::model()->find('ma_chung_tu=:ma_chung_tu',array(':ma_chung_tu'=>$this->baseModel->getAttribute('ma_chung_tu')));
                    $this->setAttribute('id',$baseModelSavedRecord->getAttribute('id'));
                }
                return parent::save(false,$attributes);
            }
        }
        return false;
    }

    public function saveWithRelated($relatedData, $runValidation = true, $attributes = null, $options = array()) {
        $valid = $runValidation ? $this->validate($attributes):true;
        if ($valid) {
            // save baseModel truoc
            if ($this->baseModel->save(false,$attributes)) {

               if ($this->isNewRecord) {
                    // tim record cua baseModel da luu
                   $uniqueLabel = parent::timKhoaUnique($this->baseModel->getAttributes());
                   $baseModelSavedRecord = ChungTu::model()->find("{$uniqueLabel}='{$this->baseModel->getAttribute($uniqueLabel)}'");
                   $this->setAttribute('id',$baseModelSavedRecord->getAttribute('id'));
                }
                return parent::saveWithRelated($relatedData,false,null,array(),true);
            }
        }
        return false;
    }

    public function delete() {
        // delete o PhieuNhap subclass truoc
        parent::delete();
        $this->baseModel->delete();
    }


    public static function layMaChungTuMoi($className,$prefix) {

        $tableName = call_user_func(array($className,'tenTable'));

        $maxId = Yii::app()->db->createCommand()
            ->select('max(id)')
            ->from($tableName)
            ->queryScalar();

        $model = CPOSActiveRecord::model($className)->findByPk($maxId);
        if (isset($model)) {
            $ma_chung_tu = $model->getBaseModel()->ma_chung_tu;
            $str = parent::taoMaChungTuMoi($ma_chung_tu, $prefix, 13);
        } else {
            $str = parent::taoMaChungTuMoi('', $prefix, 13);
        }
        return $str;
    }

}