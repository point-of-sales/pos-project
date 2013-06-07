<?php

Yii::import('application.models._base.BaseHoaDonBanHang');

class HoaDonBanHang extends BaseHoaDonBanHang
{



    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function pivotModels()
    {
        return array(
            'tblSanPhams' => 'ChiTietHoaDonBan',
            'tblSanPhamTangs' => 'ChiTietHoaDonTang',
        );
    }

    public function relations()
    {
        return array(
            'tblSanPhams' => array(self::MANY_MANY, 'SanPham', 'tbl_ChiTietHoaDonBan(hoa_don_ban_id, san_pham_id)'),
            'chungTu' => array(self::BELONGS_TO, 'ChungTu', 'id'),
            'khachHang' => array(self::BELONGS_TO, 'KhachHang', 'khach_hang_id'),
            'hoaDonTraHangs' => array(self::HAS_MANY, 'HoaDonTraHang', 'hoa_don_ban_id'),
            'tblSanPhamTangs' => array(self::MANY_MANY, 'SanPhamTang', 'tbl_ChiTietHoaDonTang(hoa_don_ban_id,san_pham_tang_id)'),
            'chiTietHoaDonBan' => array(self::HAS_MANY, 'ChiTietHoaDonBan', 'hoa_don_ban_id'),
            'chiTietHoaDonTang' => array(self::HAS_MANY, 'ChiTietHoaDonTang', 'hoa_don_ban_id'),
        );
    }

    public function them($params)
    {
        // kiem tra du lieu con bi trung hay chua

        if (!$this->baseModel->kiemTraTonTai($params[$this->baseTableName])) {
            //neu khoa chua ton tai
            $this->setAttributes($params);
            if (!empty($params['ChiTietHoaDonBan'])) {

                $cthd_hang_ban = Helpers::formatArray($params['ChiTietHoaDonBan']);
                if (!empty($params['ChiTietHoaDonTang'])) {
                    $cthd_hang_tang = Helpers::formatArray($params['ChiTietHoaDonTang']);
                    $relatedData = array(
                        // fill related with data from the Session
                        'tblSanPhams' => $cthd_hang_ban,
                        'tblSanPhamTangs' => $cthd_hang_tang,
                    );
                } else {
                    $relatedData = array(
                        // fill related with data from the Session
                        'tblSanPhams' => $cthd_hang_ban,
                    );
                }
            } else
                return 'detail-error';


            if ($this->saveWithRelated($relatedData)) {

                // Tru vao so luong tung chi nhanh tblSanPhamChiNhanh
                $chiNhanh = ChiNhanh::model()->findByPk($this->baseModel->chi_nhanh_id);

                foreach ($cthd_hang_ban as $key => $itemsInfo) {

                    $product = SanPham::model()->findByPk($key); // update scenario
                    $product->chi_nhanh_id = $this->baseModel->chi_nhanh_id;
                    $currentQuantity = $product->laySoLuongTonHienTai();
                    $newQuantity = $currentQuantity - $itemsInfo['so_luong'];
                    $relatedQuantitySanPhams[$key] = array('so_ton' => $newQuantity, 'trang_thai' => 1);
                }

                if (isset($cthd_hang_tang)) {
                    foreach ($cthd_hang_tang as $key => $itemsInfo) {
                        $product = SanPhamTang::model()->findByPk($key); // update scenario
                        $product->chi_nhanh_id = $this->baseModel->chi_nhanh_id;
                        $currentQuantity = $product->laySoLuongTonHienTai();
                        $newQuantity = $currentQuantity - $itemsInfo['so_luong'];
                        $relatedQuantitySanPhamTangs[$key] = array('so_ton' => $newQuantity, 'trang_thai' => 1);
                    }
                    $relatedQuantityData = array(
                        'tblSanPhams' => $relatedQuantitySanPhams,
                        'tblSanPhamTangs' => $relatedQuantitySanPhamTangs,
                    );
                } else {
                    $relatedQuantityData = array(
                        'tblSanPhams' => $relatedQuantitySanPhams,
                    );
                }

                if ($chiNhanh->saveWithRelated($relatedQuantityData, false, null, array(), true, true))
                    return 'ok';
            } else
                return 'fail';
        } else
            return 'dup-error';
    }

    public function capNhat($params)
    {
        // kiem tra du lieu con bi trung hay chua
        $relatedData = array(
            'tblSanPhams' => $_POST['HoaDonBanHang']['tblSanPhams'] === '' ? null : $_POST['HoaDonBanHang']['tblSanPhams'],
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


    public function xuatFileExcel()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('chiet_khau', $this->chiet_khau);
        $criteria->compare('khach_hang_id', $this->khach_hang_id);

        /*$event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['HoaDonBanHang'];
        $this->onAfterExport($event);*/

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function layMaHoaDonMoi()
    {

        $maxId = Yii::app()->db->createCommand()
            ->select('max(id)')
            ->from('tbl_HoaDonBanHang')
            ->queryScalar();

        $model = HoaDonBanHang::model()->findByPk($maxId);
        if (isset($model)) {

            $ma_chung_tu = $model->getBaseModel()->ma_chung_tu;
            $str = parent::taoMaChungTuMoi($ma_chung_tu, 'BH', 13);
        } else {
            $str = parent::taoMaChungTuMoi('', 'BH', 13);
        }
        return $str;
    }


    public function search()
    {
        $criteria = new CDbCriteria;
        $cauHinh = CauHinh::model()->findByPk(1);
        $criteria->with = array('chungTu', 'khachHang');
        $criteria->together = true;

        $criteria->compare('chungTu.ma_chung_tu', $this->getBaseModel()->ma_chung_tu,true);
        $criteria->compare('chiet_khau', $this->chiet_khau);
        $criteria->compare('khachHang.ma_khach_hang', $this->khachHang->ma_khach_hang,true);

        if(!empty($this->getBaseModel()->ngay_lap) && !empty($this->getBaseModel()->ngay_ket_thuc)) {

            $criteria->addBetweenCondition('chungTu.ngay_lap',date('Y-m-d',strtotime($this->getBaseModel()->ngay_lap)),date('Y-m-d',strtotime($this->getBaseModel()->ngay_ket_thuc)));

        }
        $criteria->compare('trang_thai',$this->trang_thai);
        $criteria->order = 'chungTu.ngay_lap DESC';
        $numberRecords = $cauHinh->so_muc_tin_tren_trang;

        return new CActiveDataProvider('HoaDonBanHang', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => $numberRecords,
            ),
        ));
    }

    public static function layHoaDonBanHang($id)
    {
        $model = HoaDonBanHang::model()->findByAttributes(array('id' => $id));
        $hd_ban_hang = array();
        if (!empty($model)) {
            $khach_hang = array(
                'id' => $model->khachHang->id,
                'ma_khach_hang' => $model->khachHang->ma_khach_hang,
                'ho_ten' => $model->khachHang->ho_ten,
                'diem_tich_luy' => $model->khachHang->diem_tich_luy,
                'loai_khach_hang_id' => $model->khachHang->loaiKhachHang->id,
                'ten_loai' => $model->khachHang->loaiKhachHang->ten_loai,
                'dien_thoai' => $model->khachHang->dien_thoai,
                'dia_chi' => $model->khachHang->dia_chi,
            );
            $model_cthd = $model->chiTietHoaDonBan;
            $cthd_ban_hang = array();
            $tong = 0;
            foreach ($model_cthd as $md) {
                $cthd_ban_hang[] = array(
                    'id' => $md->getAttribute('id'),
                    'ma_vach' => $md->sanPham->getAttribute('ma_vach'),
                    'ten_san_pham' => $md->sanPham->getAttribute('ten_san_pham'),
                    'don_gia' => $md->don_gia,
                    'so_luong' => $md->so_luong,
                    'thanh_tien' => ($md->don_gia * $md->so_luong),
                );
                $tong += $md->don_gia * $md->so_luong;
            }
            $model_hang_tang = $model->chiTietHoaDonTang;
            $cthd_hang_tang = array();
            foreach ($model_hang_tang as $md) {
                $cthd_hang_tang[] = array(
                    'ma_vach' => $md->sanPhamTang->getAttribute('ma_vach'),
                    'ten_san_pham' => $md->sanPhamTang->getAttribute('ten_san_pham'),
                    'so_luong' => $md->getAttribute('so_luong'),
                );
            }

            $hd_ban_hang = array(
                'cthd_ban_hang' => $cthd_ban_hang,
                'cthd_hang_tang' => $cthd_hang_tang,
                'khach_hang' => $khach_hang,
                'chiet_khau' => $model->chiet_khau,
                'ma_chung_tu' => $model->getBaseModel()->ma_chung_tu,
                'ngay_lap' => $model->getBaseModel()->ngay_lap,
                'tri_gia' => $model->getBaseModel()->tri_gia,
                'tong' => $tong,
                'tien_nhan' => 0,
                'tien_du' => 0,
                'ghi_chu' => $model->getBaseModel()->ghi_chu,
                'nhan_vien_id' => $model->getBaseModel()->nhan_vien_id,
                'nhan_vien_ho_ten' => $model->getBaseModel()->nhanVien->ho_ten,
                'chi_nhanh_id' => $model->getBaseModel()->chi_nhanh_id,
            );
        }
        return $hd_ban_hang;
    }
    
    //neu co hoa don tra lay chi tiet hoa don tra
    public function layChiTietHoaDon(){
        $criteria = new CDbCriteria();
        if(isset($this->trang_thai)){
            return HoaDonBanHang::layChiTietHoaDonHienTai($this->id);  
        }
        else{
            $criteria->condition = 'hoa_don_ban_id=:hoa_don_ban_id';
            $criteria->params = array(':hoa_don_ban_id' => $this->id);
            $chiTietDataProvider = new CActiveDataProvider('ChiTietHoaDonBan', array('criteria' => $criteria));
            return $chiTietDataProvider;  
        }
    }
    
    public static function layChiTietHoaDonHienTai($hoa_don_ban_id){
        $arr_sp_hd_tra = Yii::app()->db->createCommand()
            ->select('sum(so_luong) so_luong,san_pham_id')
            ->from('tbl_ChiTietHoaDonTra ct, tbl_HoaDonTraHang hd')
            ->where('hd.id = hoa_don_tra_id and hoa_don_ban_id = :hoa_don_ban_id',array(':hoa_don_ban_id'=>$hoa_don_ban_id))
            ->group('hoa_don_ban_id,san_pham_id')
            ->having('sum(so_luong)')
            ->queryAll();
        
        $criteria = new CDbCriteria();
        $criteria->condition = 'hoa_don_ban_id=:hoa_don_ban_id';
        $criteria->params = array(':hoa_don_ban_id' => $hoa_don_ban_id);
        
        $ct_hd_ban_goc = new CActiveDataProvider('ChiTietHoaDonBan', array('criteria' => $criteria));
        $data_ct_hd_ban_goc = $ct_hd_ban_goc->getData();
        foreach($data_ct_hd_ban_goc as $key=>$value){
            $san_pham_id = $value->san_pham_id;
            foreach($arr_sp_hd_tra as $row){
                if($san_pham_id == $row['san_pham_id']){
                    $value->so_luong -= $row['so_luong'];
                    //voi truong hop tra het hang
                    if($value->so_luong<=0){
                        unset($data_ct_hd_ban_goc[$key]);
                    }
                    break;
                }
            }
        }
        $data_ct_hd_ban_goc = array_values($data_ct_hd_ban_goc);
        $ct_hd_ban_goc->setData($data_ct_hd_ban_goc);
        return $ct_hd_ban_goc;
    }
    
    //tri gia hoa don hien tai da tinh chiet khau
    public static function layTriGiaHoaDonThuc($hoa_don_ban_id){
        $model = HoaDonBanHang::model()->findByAttributes(array('id'=>$hoa_don_ban_id));
        $tri_gia_goc = $model->getBaseModel()->tri_gia;
        $chiet_khau = $model->chiet_khau/100;
        if($model->trang_thai==1){
            $tri_gia_hd_tra = Yii::app()->db->createCommand()
                ->select('sum(tri_gia) tri_gia')
                ->from('tbl_HoaDonTraHang hd,tbl_ChungTu ct')
                ->where('hd.id=ct.id AND hoa_don_ban_id = :hoa_don_ban_id',array(':hoa_don_ban_id'=>$hoa_don_ban_id))
                ->queryScalar();
            /*if($chiet_khau!=0){
                $tri_gia_goc_chua_km = $tri_gia_goc/(1-$chiet_khau);
                return ($tri_gia_goc_chua_km-$tri_gia_hd_tra)*(1-$chiet_khau);   
            }*/
            //else{
                return $tri_gia_goc-$tri_gia_hd_tra;
            //}
        }
        else{
            return $tri_gia_goc;
        }
    }
    
    //kiem tra xem san pham nay co trong cac hoa don tra thuoc 1 hoa don ban khong
    public static function kiemTraSanPhamTrongChiTietHoaDonTra($san_pham_id,$hoa_don_ban_id){
        $ct_hd_tra = Yii::app()->db->createCommand()
            ->select('*')
            ->from('tbl_HoaDonTraHang hd,tbl_ChiTietHoaDonTra ct')
            ->where('hd.id = ct.hoa_don_tra_id AND hoa_don_ban_id = :hoa_don_ban_id AND san_pham_id = :san_pham_id',
                array(':hoa_don_ban_id'=>$hoa_don_ban_id,':san_pham_id'=>$san_pham_id))
            ->queryScalar();
        if($ct_hd_tra)
            return true;
        return false;
    }



}