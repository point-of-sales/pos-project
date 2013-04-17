<?php

Yii::import('application.models._base.BaseSanPham');

class SanPham extends BaseSanPham
{
    public $ma_chi_nhanh;
    public $danhSachMocGia;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function rules() {
        return array(
            array('ma_vach, ten_san_pham, han_dung ,nha_cung_cap_id, loai_san_pham_id,trang_thai,ton_toi_thieu', 'required'),
            array('han_dung, ton_toi_thieu, trang_thai, nha_cung_cap_id, loai_san_pham_id', 'numerical', 'integerOnly'=>true),
            array('ma_vach', 'length', 'max'=>15),
            array('ten_san_pham, ten_tieng_viet', 'length', 'max'=>100),
            array('don_vi_tinh', 'length', 'max'=>50),
            array('huong_dan_su_dung, mo_ta', 'safe'),
            array('ten_san_pham, ten_tieng_viet, han_dung, don_vi_tinh, ton_toi_thieu, huong_dan_su_dung, mo_ta, trang_thai', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, ma_vach, ten_san_pham, ten_tieng_viet, han_dung, don_vi_tinh, ton_toi_thieu, huong_dan_su_dung, mo_ta, trang_thai, nha_cung_cap_id, loai_san_pham_id,ma_chi_nhanh', 'safe', 'on'=>'search'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('viLib', 'ID'),
            'ma_vach' => Yii::t('viLib', 'Barcode'),
            'ten_san_pham' => Yii::t('viLib', 'Product name'),
            'ten_tieng_viet' => Yii::t('viLib', 'Vietnamese name'),
            'han_dung' => Yii::t('viLib', 'Expiration'),
            'don_vi_tinh' => Yii::t('viLib', 'Unit'),
            'ton_toi_thieu' => Yii::t('viLib', 'Store limit'),
            'huong_dan_su_dung' => Yii::t('viLib', 'Manual'),
            'mo_ta' => Yii::t('viLib', 'Description'),
            'trang_thai' => Yii::t('viLib', 'Status'),
            'nha_cung_cap_id' => null,
            'loai_san_pham_id' => null,
            'tblHoaDonBanHangs' => null,
            'tblHoaDonTraHangs' => null,
            'tblPhieuNhaps' => null,
            'tblPhieuXuats' => null,
            'nhaCungCap' => null,
            'loaiSanPham' => null,
            'tblChiNhanhs' => null,
        );
    }


    public static function layDanhSach($primaryKey = -1, $params = array(), $operator = 'AND', $limit = -1, $order = '', $orderType = 'ASC')
    {
        $criteria = new CDbCriteria();
        if ($primaryKey > 0) {
            return SanPham::model()->findByPk($primaryKey);
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
            return SanPham::model()->findAll($criteria);
        } else {

            return SanPham::model()->findAll();
        }
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
        // kiem tra du lieu con bi trung hay chua
        $uniqueKeyLabel = $this->timKhoaUnique($this->getAttributes());
        $exist = $this->exists($uniqueKeyLabel . '=:' . $uniqueKeyLabel, array(':' . $uniqueKeyLabel => $params[$uniqueKeyLabel]));
        if (!$exist) {
            //neu khoa chua ton tai
            $this->setAttributes($params);
            $relatedData = array(/*'tblHoaDonBanHangs' => $_POST['SanPham']['tblHoaDonBanHangs'] === '' ? null : $_POST['SanPham']['tblHoaDonBanHangs'],
				'tblHoaDonTraHangs' => $_POST['SanPham']['tblHoaDonTraHangs'] === '' ? null : $_POST['SanPham']['tblHoaDonTraHangs'],
				'tblPhieuNhaps' => $_POST['SanPham']['tblPhieuNhaps'] === '' ? null : $_POST['SanPham']['tblPhieuNhaps'],
				'tblPhieuXuats' => $_POST['SanPham']['tblPhieuXuats'] === '' ? null : $_POST['SanPham']['tblPhieuXuats'],
				'tblChiNhanhs' => $_POST['SanPham']['tblChiNhanhs'] === '' ? null : $_POST['SanPham']['tblChiNhanhs'],*/
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
        // kiem tra du lieu con bi trung hay chua
        $uniqueKeyLabel = $this->timKhoaUnique($this->getAttributes());
        // lay ma_ cu
        $uniqueKeyOldVal = $this->getAttribute($uniqueKeyLabel);
        $exist = $this->exists($uniqueKeyLabel . '=:' . $uniqueKeyLabel, array(':' . $uniqueKeyLabel => $params[$uniqueKeyLabel]));
        $relatedData = array(/*'tblHoaDonBanHangs' => $_POST['SanPham']['tblHoaDonBanHangs'] === '' ? null : $_POST['SanPham']['tblHoaDonBanHangs'],
				'tblHoaDonTraHangs' => $_POST['SanPham']['tblHoaDonTraHangs'] === '' ? null : $_POST['SanPham']['tblHoaDonTraHangs'],
				'tblPhieuNhaps' => $_POST['SanPham']['tblPhieuNhaps'] === '' ? null : $_POST['SanPham']['tblPhieuNhaps'],
				'tblPhieuXuats' => $_POST['SanPham']['tblPhieuXuats'] === '' ? null : $_POST['SanPham']['tblPhieuXuats'],
				'tblChiNhanhs' => $_POST['SanPham']['tblChiNhanhs'] === '' ? null : $_POST['SanPham']['tblChiNhanhs'],*/
        );
        if (!$exist) {
            $this->setAttributes($params);
            if ($this->saveWithRelated($relatedData))
                return 'ok';
            else
                return 'fail';
        } else {

            // so sanh ma cu == ma moi
            if ($uniqueKeyOldVal == $params[$uniqueKeyLabel]) {
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


    public function layDanhSachTrangThai()
    {
        return array('Chưa kích hoạt', 'Kích hoạt');
    }

    public function layTenTrangThai() {
        $danhSachTrangThai = $this->layDanhSachTrangThai();
        return $danhSachTrangThai[$this->trang_thai];
    }

    public function layDanhSachTrangThaiKhuyenMai() {
        return array('Chưa khuyến mãi', 'Khuyến mãi');
    }

    /*
     * custom search method to return result of searching with related data
     */

    public function search() {

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('ma_vach', $this->ma_vach, true);
        $criteria->compare('ten_san_pham', $this->ten_san_pham, true);
        $criteria->compare('ten_tieng_viet', $this->ten_tieng_viet, true);
        $criteria->compare('trang_thai', $this->trang_thai);
        $criteria->compare('nha_cung_cap_id', $this->nha_cung_cap_id);
        $criteria->compare('loai_san_pham_id', $this->loai_san_pham_id);

        if(!empty($this->ma_chi_nhanh)) {
            //search with related data
            // connect SanPham Model with it own relations

            $criteria->with = 'tblChiNhanhs';
            $criteria->compare('tblChiNhanhs.id',$this->ma_chi_nhanh,true);
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /*
     * Lay danh sach cac moc gia cua san pham
     */
    public function layDanhSachMocGia() {
        $criteria = new CDbCriteria();
        $criteria->compare('san_pham_id',$this->id,true);
        $criteria->order = 'thoi_gian_bat_dau ASC';
        $this->danhSachMocGia = new CActiveDataProvider('MocGia', array('criteria' => $criteria));
        return $this->danhSachMocGia;

    }
    /*
     * Lay moc gia cua san pham.
     * Neu Thoi gian bat dau <= Now < Thoi gian ket thuc.
     *      return CActiveRecord MocGia
     * Neu Now < Thoi_gian_ket_thuc
     *      return NULL (san pham chua co Moc gia)
     */
    public function layMocGiaHienTai() {
       $hien_tai = time();
       $i=0;
       if($this->danhSachMocGia==null)
            $this->layDanhSachMocGia();
       $danhSachMocGia = $this->danhSachMocGia->getData();


       if(count($danhSachMocGia)<1)    // san pham chua co set moc gia
           return null;
        $thoiGianBatDau =  strtotime($danhSachMocGia[0]->getAttribute('thoi_gian_bat_dau'));

       if($thoiGianBatDau > $hien_tai)
           return 'no-price';     // san pham chua co gia trong thoi diem hien tai

        if(count($danhSachMocGia)==1 && $thoiGianBatDau <= $hien_tai)
            return $danhSachMocGia[0];

        foreach($danhSachMocGia as $mocGia) {
           $thoiGianBatDau =  strtotime($mocGia->getAttribute('thoi_gian_bat_dau'));
           if($thoiGianBatDau <= $hien_tai)
               $i++;
           else
               return $danhSachMocGia[$i-1];
        }
    }

    public function layGiaHienTai() {
        $mocGiaHienTai = $this->layMocGiaHienTai();
        if($mocGiaHienTai == null)
            return Yii::t('viLib','No price level set');
        if($mocGiaHienTai == 'no-price')
            return Yii::t('viLib','No price at this time');
        if($mocGiaHienTai instanceof CActiveRecord )
            return $mocGiaHienTai->getAttribute('gia_ban');
    }


}