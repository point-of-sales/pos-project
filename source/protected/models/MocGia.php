<?php

Yii::import('application.models._base.BaseMocGia');

class MocGia extends BaseMocGia
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function rules() {
        return array(
            array('thoi_gian_bat_dau, gia_ban, san_pham_id', 'required'),
            array('san_pham_id', 'numerical', 'integerOnly'=>true),
            array('gia_ban', 'numerical'),
            array('thoi_gian_ket_thuc', 'safe'),
            array('thoi_gian_ket_thuc', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, thoi_gian_bat_dau, thoi_gian_ket_thuc, gia_ban, san_pham_id', 'safe', 'on'=>'search'),
            // valid thoi gian bat dau
            array(

                'thoi_gian_bat_dau',
                'compare',
                'compareValue'=>date('yy-m-d',time()),
                'operator'=>'>=',
                'message'=>Yii::t('viLib','Start time have to greater or equal current time'),
            ),

        );
    }


    public static function layDanhSach($primaryKey = -1, $params = array(), $operator = 'AND', $limit = -1, $order = '', $orderType = 'ASC')
    {
        $criteria = new CDbCriteria();
        if ($primaryKey > 0) {
            return MocGia::model()->findByPk($primaryKey);
        }

        if (!empty($params)) {
            if (is_array($params)) {
                foreach ($params as $cond => $value) {
                    if ($criteria->condition == '') {
                        if (is_string($value)) {
                            $value = stripcslashes($value);
                            $value = addslashes($value);
                        }
                        $criteria->condition = $cond . '=' . "'$value'" . ' AND ';
                    } else {
                        $criteria->condition = $criteria->condition . ' ' . $cond . '=' . "'$value'" . ' AND ';
                    }
                }

                $criteria->condition = substr($criteria->condition, 0, strlen($criteria->condition) - 5);

                if ($operator == 'OR') {
                    //replace AND with OR
                    $criteria->condition = str_replace(' AND ', ' OR ', $criteria->condition);
                }

            } else {
                $criteria->condition = $params;
            }

            if ($limit > 0) {
                $criteria->limit = $limit;
            }

            if ($order != '') {
                $criteria->order = $order . ' ' . $orderType;
            }
            return MocGia::model()->findAll($criteria);
        } else {

            return MocGia::model()->findAll();
        }
    }

    public static function layDanhSachGiaTheoSanPham($san_pham_id)
    {
        $criteria = new CDbCriteria();
        $criteria->compare('san_pham_id', $san_pham_id, true);
        return new CActiveDataProvider('MocGia', array('criteria' => $criteria));

    }

    public function kiemTraQuanHe()
    {
        $rels = $this->relations();
        foreach ($rels as $relLabel => $value) {
            if ($value[0] != parent::BELONGS_TO) {
                $tmp = $this->getRelated($relLabel);
                if (!empty($tmp)) {
                    return true;
                }
            }
        }
        return false;
    }

    private function timKhoaUnique($schema)
    {
        foreach ($schema as $k => $v) {
            if (substr($k, 0, 3) == 'ma_') {
                return $k;
            }
        }
    }

    public function them($params)
    {
        //kiem tra moc gia cua san pham nay co ton tai hay chua
        $productLabel = 'san_pham_id';
        $exist = $this->exists($productLabel . '=:' . $productLabel, array(':' . $productLabel => $params[$productLabel]));
        if($exist) {
            // neu ton tai thi moc gia them la moc gia thu n cua san pham
            // kiem tra thoi gian nhap co hop le hay khong
            $startTimeVal = strtotime($params[$productLabel]);
            if($startTimeVal > time()) {
                //ngay thang hop le
            } else {
                //ngay thang khong hop le
            }

        } else {
            // neu chua ton tai => moc gia them la moc gia dau tien cua san pham
        }
        // kiem tra du lieu con bi trung hay chua
        $uniqueKeyLabel = $this->timKhoaUnique($this->getAttributes());
        if (empty($uniqueKeyLabel))
            $uniqueKeyLabel = 'id';   //neu khong co truong ma_ . Dung Id thay the
        $exist = $this->exists($uniqueKeyLabel . '=:' . $uniqueKeyLabel, array(':' . $uniqueKeyLabel => $params[$uniqueKeyLabel]));
        if (!$exist) {
            //neu khoa chua ton tai
            $this->setAttributes($params);
            if ($this->save())
                return 'ok';
            else
                return 'fail';
        } else
            return 'dup-error';
    }

    public function capNhat($params)
    {
        // kiem tra du lieu con bi trung hay chua
        $uniqueKeyLabel = $this->timKhoaUnique($this->getAttributes());
        if (empty($uniqueKeyLabel))
            $uniqueKeyLabel = 'id';   //neu khong co truong ma_ . Dung Id thay the

        $uniqueKeyOldVal = $this->getAttribute($uniqueKeyLabel);
        $exist = $this->exists($uniqueKeyLabel . '=:' . $uniqueKeyLabel, array(':' . $uniqueKeyLabel => $params[$uniqueKeyLabel]));
        // lay ma_ cu

        if (!$exist) {
            $this->setAttributes($params);
            if ($this->save())
                return 'ok';
            else
                return 'fail';
        } else {
            // so sanh ma cu == ma moi
            if ($uniqueKeyOldVal == $params[$uniqueKeyLabel]) {
                $this->setAttributes($params);
                if ($this->save())
                    return 'ok';
                else
                    return 'fail';
            } else
                return 'dup-error';

        }
    }

    public function xoa()
    {
        $relation = $this->kiemTraQuanHe($this->id);
        if (!$relation) {
            if ($this->delete())
                return 'ok';
            else
                return 'fail';
        } else {
            return 'rel-error';
        }
    }


}