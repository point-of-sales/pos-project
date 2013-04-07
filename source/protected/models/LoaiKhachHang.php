<?php

Yii::import('application.models._base.BaseLoaiKhachHang');

class LoaiKhachHang extends BaseLoaiKhachHang
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public function rules() {
        return array(
                    array('ma_loai_khach_hang', 'required'),
                    array('ma_loai_khach_hang', 'length', 'max'=>15),
                    array('ten_loai', 'length', 'max'=>100),
                    array('ten_loai', 'default', 'setOnEmpty' => true, 'value' => null),
                array('id, ma_loai_khach_hang, ten_loai', 'safe', 'on'=>'search'),
        );
    }

    public function pivotModels() {
        return array(
                );
    }

    public function attributeLabels() {
        return array(
                                    'id' => Yii::t('app', 'ID'),
                                                'ma_loai_khach_hang' => Yii::t('app', 'Ma Loai Khach Hang'),
                                                'ten_loai' => Yii::t('app', 'Ten Loai'),
                                                'khachHangs' => null,
                            );
    }

    public static function layDanhSach($primaryKey=-1, $params=array(), $operator='AND',$limit=-1,$order='',$orderType='ASC') {
        $criteria = new CDbCriteria();
        if($primaryKey > 0) {
            return LoaiKhachHang::model()->findByPk($primaryKey);
        }

        if(!empty($params)) {
            if(is_array($params) ) {
                foreach($params as $cond=>$value) {
                if($criteria->condition=='') {
                if(is_string($value)) {
                    $value = stripcslashes($value);
                    $value = addslashes($value);
                }
                    $criteria->condition = $cond .'='."'$value'" . ' AND ';
                } else {
                    $criteria->condition = $criteria->condition . ' ' .  $cond .'='."'$value'" . ' AND ';
                }
            }

                $criteria->condition = substr($criteria->condition,0,strlen($criteria->condition)-5);

                if($operator=='OR') {
                    //replace AND with OR
                    $criteria->condition = str_replace(' AND ',' OR ', $criteria->condition);
                }

            } else {
                $criteria->condition = $params;
            }

            if($limit > 0) {
                $criteria->limit = $limit;
            }

            if($order!='') {
                $criteria->order = $order .' ' .$orderType;
            }
                return LoaiKhachHang::model()->findAll($criteria);
            } else {

                return LoaiKhachHang::model()->findAll();
            }
        }

    public function kiemTraQuanHe() {
        $rels = $this->relations();
        foreach($rels as $relLabel=>$value) {
            if($value[0]!=parent::BELONGS_TO) {
                $tmp = $this->getRelated($relLabel);
                if(!empty($tmp)) {
                    return true;
                }
            }
        }
        return false;
    }
    private  function timKhoaUnique($schema) {
        foreach($schema as $k=>$v) {
            if(substr($k,0,3)=='ma_') {
                return $k;
            }
        }
    }
    public function them($params) {
        // kiem tra du lieu con bi trung hay chua
        $uniqueKeyLabel = $this->timKhoaUnique($this->getAttributes());
        $exist = $this->exists($uniqueKeyLabel .'=:'. $uniqueKeyLabel,array(':'.$uniqueKeyLabel=>$params[$uniqueKeyLabel]));
        if(!$exist) {
            //neu khoa chua ton tai
            $this->setAttributes($params);
                            if ($this->save())
                        return 'ok';
            else
                return 'fail';
        } else
                return 'dup-error';
    }

    public function capNhat($params) {
        // kiem tra du lieu con bi trung hay chua
        $uniqueKeyLabel = $this->timKhoaUnique($this->getAttributes());
        // lay ma_ cu
        $uniqueKeyOldVal = $this->getAttribute($uniqueKeyLabel);
        $exist = $this->exists($uniqueKeyLabel .'=:'. $uniqueKeyLabel,array(':'.$uniqueKeyLabel=>$params[$uniqueKeyLabel]));
                if(!$exist) {
            $this->setAttributes($params);
                            if ($this->save())
                                return 'ok';
                else
                    return 'fail';
        } else {

        // so sanh ma cu == ma moi
        if($uniqueKeyOldVal == $this->getAttribute($uniqueKeyLabel)) {
            $this->setAttributes($params);
                            if ($this->save())
                                return 'ok';
                else
                    return 'fail';
        } else
                return 'dup-error';

        }
    }

    public function xoa() {
        $relation = $this->kiemTraQuanHe($this->id);
        if(!$relation) {
            if($this->delete())
                return 'ok';
            else
                return 'fail';
        } else {
            return 'rel-error';
        }
    }








}