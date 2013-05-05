<?php

Yii::import('application.models._base.BaseSanPham');

class SanPham extends BaseSanPham
{
    public $chi_nhanh_id;
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

    public function them($params)
    {
        // kiem tra du lieu con bi trung hay chua

        if (!$this->kiemTraTonTai($params)) {
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

        $relatedData = array(/*'tblHoaDonBanHangs' => $_POST['SanPham']['tblHoaDonBanHangs'] === '' ? null : $_POST['SanPham']['tblHoaDonBanHangs'],
				'tblHoaDonTraHangs' => $_POST['SanPham']['tblHoaDonTraHangs'] === '' ? null : $_POST['SanPham']['tblHoaDonTraHangs'],
				'tblPhieuNhaps' => $_POST['SanPham']['tblPhieuNhaps'] === '' ? null : $_POST['SanPham']['tblPhieuNhaps'],
				'tblPhieuXuats' => $_POST['SanPham']['tblPhieuXuats'] === '' ? null : $_POST['SanPham']['tblPhieuXuats'],
				'tblChiNhanhs' => $_POST['SanPham']['tblChiNhanhs'] === '' ? null : $_POST['SanPham']['tblChiNhanhs'],*/
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
        $criteria->compare('t.trang_thai', $this->trang_thai);
        $criteria->compare('nha_cung_cap_id', $this->nha_cung_cap_id);
        $criteria->compare('loai_san_pham_id', $this->loai_san_pham_id);

        if(!empty($this->chi_nhanh_id)) {
            //search with related data
            // connect SanPham Model with it own relations
            $criteria->with = 'tblChiNhanhs';
            $criteria->together = true;
            $criteria->compare('tblChiNhanhs.id',$this->chi_nhanh_id,true);
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


    public function layDanhSachChiNhanh() {
        $chiNhanh = new ChiNhanh();
        $chiNhanh->san_pham_id = $this->id;
        $dataProvider = $chiNhanh->search();
        $danhSachChiNhanh = $dataProvider->getData();
        foreach($danhSachChiNhanh as $chiNhanhCon)
            $chiNhanhCon->san_pham_id = $this->id;
        $dataProvider->model = $danhSachChiNhanh;
        return $dataProvider;
    }

    public function layTongSoLuongTon() {
        return  Yii::app()->db->createCommand()
                    ->select('sum(so_ton)')
                    ->from('tbl_SanPhamChiNhanh')
                    ->where('san_pham_id=:san_pham_id',array(':san_pham_id'=>$this->id))
                    ->queryScalar();
    }


    public function xuatFileExcel() {

        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('ma_vach', $this->ma_vach, true);
        $criteria->compare('ten_san_pham', $this->ten_san_pham, true);
        $criteria->compare('ten_tieng_viet', $this->ten_tieng_viet, true);
        $criteria->compare('t.trang_thai', $this->trang_thai);
        $criteria->compare('nha_cung_cap_id', $this->nha_cung_cap_id);
        $criteria->compare('loai_san_pham_id', $this->loai_san_pham_id);
        if(!empty($this->chi_nhanh_id)) {
            //search with related data
            // connect SanPham Model with it own relations
            $criteria->with = 'tblChiNhanhs';
            $criteria->together = true;
            $criteria->compare('tblChiNhanhs.id',$this->chi_nhanh_id,true);
        }

        /*$event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['SanPham'];
        $this->onAfterExport($event);*/

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function laySoLuongTonHienTai() {
        return Yii::app()->db->createCommand()
            ->select("so_ton")
            ->from('tbl_SanPhamChiNhanh')
            ->where('san_pham_id=:san_pham_id AND chi_nhanh_id=:chi_nhanh_id',array(':san_pham_id'=>$this->id, ':chi_nhanh_id'=>$this->chi_nhanh_id))
            ->queryScalar();
    }
}