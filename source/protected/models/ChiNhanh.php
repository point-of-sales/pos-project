<?php

Yii::import('application.models._base.BaseChiNhanh');

class ChiNhanh extends BaseChiNhanh
{
    public $ma_chi_nhanh;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        if ($n <= 1) {
            return Yii::t('viLib', 'Branch');
        } else {
            return Yii::t('viLib', 'Branchs');
        }
    }

    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('viLib', 'ID'),
            'ma_chi_nhanh' => Yii::t('viLib', 'Branch Id'),
            'ten_chi_nhanh' => Yii::t('viLib', 'Branch name'),
            'dia_chi' => Yii::t('viLib', 'Address'),
            'dien_thoai' => Yii::t('viLib', 'Phone'),
            'fax' => Yii::t('viLib', 'Fax'),
            'mo_ta' => Yii::t('viLib', 'Description'),
            'trang_thai' => Yii::t('viLib', 'Status'),
            'truc_thuoc_id' => Yii::t('viLib', 'Under'),
            'khu_vuc_id' => Yii::t('viLib', 'Area'),
            'loai_chi_nhanh_id' => Yii::t('viLib', 'Branch Type'),
            'trucThuoc' => null,
            'chiNhanhs' => null,
            'khuVuc' => null,
            'loaiChiNhanh' => Yii::t('viLib','Branch Type'),
            'chungTus' => null,
            'khuyenMais' => null,
            'tblKhuyenMais' => null,
            'mocGias' => null,
            'nhanViens' => null,
            'phieuNhaps' => null,
            'phieuXuats' => null,
            'tblSanPhams' => null,
            'tblSanPhamTangs' => null,
        );
    }

    public static function layDanhSach($primaryKey = -1, $params = array(), $operator = 'AND', $limit = -1, $order = '', $orderType = 'ASC')
    {
        $criteria = new CDbCriteria();
        if ($primaryKey > 0) {
            return ChiNhanh::model()->findByPk($primaryKey);
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
            return ChiNhanh::model()->findAll($criteria);
        } else {

            return ChiNhanh::model()->findAll();
        }
    }

    private  function kiemTraQuanHe()
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

    private  function kiemTraTonTai($params) {
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

    private  function soKhopMa($params) {
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
        // kiem tra du lieu con bi trung hay chua

        if (!$this->kiemTraTonTai($params)) {
            //neu khoa chua ton tai
            $this->setAttributes($params);
            $relatedData = array(
                //'tblKhuyenMais' => $_POST['ChiNhanh']['tblKhuyenMais'] === '' ? null : $_POST['ChiNhanh']['tblKhuyenMais'],
                //'tblSanPhams' => $_POST['ChiNhanh']['tblSanPhams'] === '' ? null : $_POST['ChiNhanh']['tblSanPhams'],
                //'tblSanPhamTangs' => $_POST['ChiNhanh']['tblSanPhamTangs'] === '' ? null : $_POST['ChiNhanh']['tblSanPhamTangs'],
            );
            if ($this->saveWithRelated($relatedData))
                return 'ok';
            else
                return 'fail';
        } else
            return 'dup-error';
    }

    public function capNhat($params)
    {
        $relatedData = array(
            //'tblKhuyenMais' => $_POST['ChiNhanh']['tblKhuyenMais'] === '' ? null : $_POST['ChiNhanh']['tblKhuyenMais'],
            //'tblSanPhams' => $_POST['ChiNhanh']['tblSanPhams'] === '' ? null : $_POST['ChiNhanh']['tblSanPhams'],
            //'tblSanPhamTangs' => $_POST['ChiNhanh']['tblSanPhamTangs'] === '' ? null : $_POST['ChiNhanh']['tblSanPhamTangs'],
        );
        if (!$this->kiemTraTonTai($params)) {
            $this->setAttributes($params);
            if ($this->saveWithRelated($relatedData))
                return 'ok';
            else
                return 'fail';
        } else {
            // so sanh ma cu == ma moi
            if ($this->soKhopMa($params)) {
                $this->setAttributes($params);
                if ($this->saveWithRelated($relatedData))
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

    public function layDanhSachTrangThai() {
        return array('Chưa kích hoạt', 'Kích hoạt');
    }


    public function layDanhSachTrucThuoc() {
        $chiNhanhs = Yii::app()->db->createCommand()
            ->select('id, ten_chi_nhanh')
            ->from('tbl_ChiNhanh')
            ->queryAll();
        $danhSachChiNhanh['']='Không trực thuộc';
        foreach($chiNhanhs as $chiNhanh) {
            if($chiNhanh['ten_chi_nhanh']!=$this->ten_chi_nhanh) {
                $danhSachChiNhanh[$chiNhanh['id']] = $chiNhanh['ten_chi_nhanh'];
            }
        }
        return $danhSachChiNhanh;
    }

    public function layDanhSachKhuVuc() {
        $khuVucs = Yii::app()->db->createCommand()
            ->select('id, ten_khu_vuc')
            ->from('tbl_KhuVuc')
            ->queryAll();
        foreach($khuVucs as $khuVuc) {
            $danhSachKhuVuc[$khuVuc['id']] = $khuVuc['ten_khu_vuc'];
        }
        return $danhSachKhuVuc;
    }

    public function layDanhSachLoaiChiNhanh() {
        $loais = Yii::app()->db->createCommand()
            ->select('id, ten_loai_chi_nhanh')
            ->from('tbl_LoaiChiNhanh')
            ->queryAll();
        foreach($loais as $loai) {
            $danhSachLoai[$loai['id']] = $loai['ten_loai_chi_nhanh'];
        }
        return $danhSachLoai;

    }

    public function layTenTrangThai() {
        $statusOptions = $this->layDanhSachTrangThai();
        return $statusOptions[$this->trang_thai];

    }

    public function layTenTrucThuoc() {
        $underOptions = $this->layDanhSachTrucThuoc();
        if($this->truc_thuoc_id!='')
            return $underOptions[$this->truc_thuoc_id];
        else
            return 'Không trực thuộc';
    }

    public function layTenLoaiChiNhanh() {
        $typeOptions = $this->layDanhSachLoaiChiNhanh();
        return $typeOptions[$this->loai_chi_nhanh_id];
    }

    public function layTenKhuVuc() {
        $areaOptions = $this->layDanhSachKhuVuc();
        return $areaOptions[$this->khu_vuc_id];
    }

    public function coChiNhanhCon() {

        return ChiNhanh::model()->exists('truc_thuoc_id=:truc_thuoc_id',array(':truc_thuoc_id'=>$this->id));
    }


}