<?php

Yii::import('application.models._base.BaseKhachHang');

class KhachHang extends BaseKhachHang
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public function rules() {
        return array(
                    array('ma_khach_hang, loai_khach_hang_id', 'required'),
                    array('diem_tich_luy, loai_khach_hang_id', 'numerical', 'integerOnly'=>true),
                    array('ma_khach_hang', 'length', 'max'=>10),
                    array('ho_ten, dia_chi', 'length', 'max'=>200),
                    array('thanh_pho, email', 'length', 'max'=>100),
                    array('dien_thoai', 'length', 'max'=>15),
                    array('ngay_sinh, mo_ta', 'safe'),
                    array('ho_ten, ngay_sinh, dia_chi, thanh_pho, dien_thoai, email, mo_ta, diem_tich_luy', 'default', 'setOnEmpty' => true, 'value' => null),
                array('id, ma_khach_hang, ho_ten, ngay_sinh, dia_chi, thanh_pho, dien_thoai, email, mo_ta, diem_tich_luy, loai_khach_hang_id', 'safe', 'on'=>'search'),
        );
    }

    public function pivotModels() {
        return array(
                );
    }

    public function attributeLabels() {
        return array(
                                    'id' => Yii::t('app', 'ID'),
                                                'ma_khach_hang' => Yii::t('app', 'Ma Khach Hang'),
                                                'ho_ten' => Yii::t('app', 'Ho Ten'),
                                                'ngay_sinh' => Yii::t('app', 'Ngay Sinh'),
                                                'dia_chi' => Yii::t('app', 'Dia Chi'),
                                                'thanh_pho' => Yii::t('app', 'Thanh Pho'),
                                                'dien_thoai' => Yii::t('app', 'Dien Thoai'),
                                                'email' => Yii::t('app', 'Email'),
                                                'mo_ta' => Yii::t('app', 'Mo Ta'),
                                                'diem_tich_luy' => Yii::t('app', 'Diem Tich Luy'),
                                                'loai_khach_hang_id' => null,
                                                'loaiKhachHang' => null,
                            );
    }

    public static function layDanhSach($primaryKey=-1, $params=array(), $operator='AND',$limit=-1,$order='',$orderType='ASC') {
        $criteria = new CDbCriteria();
        if($primaryKey > 0) {
            return KhachHang::model()->findByPk($primaryKey);
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
                return KhachHang::model()->findAll($criteria);
            } else {

                return KhachHang::model()->findAll();
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