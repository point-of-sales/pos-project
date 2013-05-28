<?php

Yii::import('application.models._base.BaseKhachHang');

class KhachHang extends BaseKhachHang
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    public function attributeLabels() {
        return array(
            'id' => Yii::t('viLib', 'ID'),
            'ma_khach_hang' => Yii::t('viLib', 'Customer code'),
            'ho_ten' => Yii::t('viLib', 'Fullname'),
            'ngay_sinh' => Yii::t('viLib', 'Birthday'),
            'dia_chi' => Yii::t('viLib', 'Address'),
            'thanh_pho' => Yii::t('viLib', 'City'),
            'dien_thoai' => Yii::t('viLib', 'Phone'),
            'email' => Yii::t('viLib', 'Email'),
            'mo_ta' => Yii::t('viLib', 'Description'),
            'diem_tich_luy' => Yii::t('viLib', 'Cumulative score'),
            'loai_khach_hang_id' => Yii::t('viLib', 'Customer type'),
            'hoaDonBanHangs' => null,
            'loaiKhachHang' => null,
        );
    }

    public function them($params)
    {
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
        // kiem tra du lieu con bi trung hay chua
        if (!$this->kiemTraTonTai($params)) {
            $this->setAttributes($params);
            if ($this->save())
                return 'ok';
            else
                return 'fail';
        } else {

            // so sanh ma cu == ma moi
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


    public function xuatFileExcel()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('ma_khach_hang', $this->ma_khach_hang, true);
        $criteria->compare('ho_ten', $this->ho_ten, true);
        $criteria->compare('ngay_sinh', $this->ngay_sinh, true);
        $criteria->compare('dia_chi', $this->dia_chi, true);
        $criteria->compare('thanh_pho', $this->thanh_pho, true);
        $criteria->compare('dien_thoai', $this->dien_thoai, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('mo_ta', $this->mo_ta, true);
        $criteria->compare('diem_tich_luy', $this->diem_tich_luy);
        $criteria->compare('loai_khach_hang_id', $this->loai_khach_hang_id);

        /*$event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['KhachHang'];
        $this->onAfterExport($event);*/

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    public static function layTenLoaiKhachHang($ma_khach_hang){
        $model = KhachHang::model()->findByAttributes(array('ma_khach_hang'=>$ma_khach_hang));
        if(!empty($model)){
            return $model->loaiKhachHang->ten_loai;
        }
        return false;
    }

    public static function capNhatTriGia($id,$tri_gia){ 
        $model = KhachHang::model()->findByAttributes(array('id'=>$id));
        if(!empty($model)){
            //truong hop le khach hang mua le
            $ma_khach_hang_mua_le = 'KHBT';
            if($model->getAttribute('ma_khach_hang')==$ma_khach_hang_mua_le){
                return 'kl';
            }
            
            $diem_tich_luy_hien_tai = $model->getAttribute('diem_tich_luy');
            $diem_tich_luy = $tri_gia + $diem_tich_luy_hien_tai;
            
            $id_loai_khach_hang_hien_tai = $model->loaiKhachHang->id;
            $loai_khach_hang_cap_nhat = LoaiKhachHang::layLoaiKhachHangHienTai($diem_tich_luy);
            
            $model->setAttribute('diem_tich_luy',$diem_tich_luy);
            //up level cho khach hang
            $up_level = false;
            if($id_loai_khach_hang_hien_tai != $loai_khach_hang_cap_nhat['id']){
                $model->setAttribute('loai_khach_hang_id',$loai_khach_hang_cap_nhat['id']);
                $up_level = true;      
            }   
            if($model->save()){
                if($up_level)
                    return 'ok-up';
                else
                    return 'ok';
            }
            else{
                return 'fail';
            }
        }
        else{
            return 'fail';
        }
    }
    
}