<?php

Yii::import('application.models._base.BaseMocGia');

class MocGia extends BaseMocGia
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('viLib', 'ID'),
            'thoi_gian_bat_dau' => Yii::t('viLib', 'Start date'),
            'gia_ban' => Yii::t('viLib', 'Price'),
            'san_pham_id' => null,
            'sanPham' => null,
        );
    }

    public function beforeSave() {
        if (parent::beforeSave()) {
            $this->thoi_gian_bat_dau = date('Y-m-d',strtotime($this->thoi_gian_bat_dau));
            return true;
        }

    }

    public function rules() {
        return array(
            array('thoi_gian_bat_dau, gia_ban, san_pham_id', 'required'),
            array('san_pham_id', 'numerical', 'integerOnly'=>true),
            array('gia_ban', 'numerical'),
            array('id, thoi_gian_bat_dau, gia_ban, san_pham_id', 'safe', 'on'=>'search'),
            array('thoi_gian_bat_dau', 'ext.custom-validator.CDateTimeValidator'),
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

    public function layDanhSachGiaTheoSanPham($san_pham)
    {
        $criteria = new CDbCriteria();
        $criteria->compare('san_pham_id', $san_pham->id, true);
        $criteria->order = 'thoi_gian_bat_dau ASC';
        return new CActiveDataProvider('MocGia', array('criteria' => $criteria));

    }

    private function kiemTraQuanHe()
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

    /*
     * Tra ve ket qua du lieu nhap tu params - bien POST (cac khoa chinh hoac khoa Unique) co ton tai hay chua
     */

    private function kiemTraTonTai($params) {
        $uniqueKeyLabel = $this->timKhoaUnique($this->getAttributes());
        if (empty($uniqueKeyLabel)) {
            $primaryKeys = $this->tableSchema->primaryKey; //neu khong co truong ma_ . Dung Primary key thay the
            if(is_array($primaryKeys))  {                        //neu primary keys la mang
                $conditions = array();
                foreach($primaryKeys as $key) {
                    $conditions[$key] = $params[$key];
                }
                return  $this->exists($conditions);
            }
            else
                return $this->exists($primaryKeys . '=:' . $primaryKeys, array(':' . $primaryKeys => $params[$primaryKeys]));
        } else {
            // co ton tai truong ma_ (co khoa Unique)
            return $this->exists($uniqueKeyLabel . '=:' . $uniqueKeyLabel, array(':' . $uniqueKeyLabel => $params[$uniqueKeyLabel]));
        }
    }

    /*
     * So sanh ma voi doi so params. Thu tu so sanh tu Khoa Unique->PrimaryKey
     */

    private function soKhopMa($params) {
        $uniqueKeyLabel = $this->timKhoaUnique($this->getAttributes());
        if (empty($uniqueKeyLabel)) {
            $primaryKeys = $this->tableSchema->primaryKey; //neu khong co truong ma_ . Dung Primary key thay the
            if(is_array($primaryKeys))  {                        //neu primary keys la mang
                $oldPrimaryValues = array();
                foreach($primaryKeys as $key) {
                    $oldPrimaryValues[$key] = $this->getAttribute($key);
                }
                return  Helpers::compareArray($oldPrimaryValues,$params);
            }
            else
                return $this->getAttribute($primaryKeys) == $params[$primaryKeys];
        } else {
            // co ton tai truong ma_ (co khoa Unique)
            return $this->getAttribute($uniqueKeyLabel) == $params[$uniqueKeyLabel];
        }

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
        if ($exist) {
            $startDate = date('Y-m-d',strtotime($params['thoi_gian_bat_dau'])); //tim thu moc_gia_trung cua san pham
            $command = Yii::app()->db->createCommand("SELECT COUNT(*)
                                                       FROM tbl_MocGia
                                                       WHERE san_pham_id = '{$params[$productLabel]}' AND thoi_gian_bat_dau = '{$startDate}'");

            $count = $command->queryScalar();
            if ($count)
                return 'dup-error';

        }
        // kiem tra du lieu con bi trung hay chua
        if (!$this->kiemTraTonTai($params)) {
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
        if (!$this->kiemTraTonTai($params)) {
            $this->setAttributes($params);
            if ($this->save())
                return 'ok';
            else
                return 'fail';
        } else {

            if ($this->soKhopMa($params)) {
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

    public function layThoiGianKeTiep() {
        $command = Yii::app()->db->createCommand();
        $command->select = 'MIN(thoi_gian_bat_dau)';
        $command->from = 'tbl_MocGia';
        $command->where = "san_pham_id='{$this->san_pham_id}' AND thoi_gian_bat_dau > '{$this->thoi_gian_bat_dau}'";
        return  $command->queryScalar();
    }

    public function layKhoangThoiGian() {
        $thoiGianKetThuc = $this->layThoiGianKeTiep();
        if($thoiGianKetThuc!='')
            return date('d-m-Y',strtotime($this->thoi_gian_bat_dau)) .' --> '. date('d-m-Y',strtotime($thoiGianKetThuc)-24*60*60);
        else
            return date('d-m-Y',strtotime($this->thoi_gian_bat_dau));
    }


}