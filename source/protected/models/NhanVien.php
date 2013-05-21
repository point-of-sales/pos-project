<?php

Yii::import('application.models._base.BaseNhanVien');

class NhanVien extends BaseNhanVien
{


    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function attributeLabels() {
        return array(
            'id' => Yii::t('viLib', 'ID'),
            'ma_nhan_vien' => Yii::t('viLib', 'Employee code'),
            'ho_ten' => Yii::t('viLib', 'Fullname'),
            'email' => Yii::t('viLib', 'Email'),
            'dien_thoai' => Yii::t('viLib', 'Phone'),
            'dia_chi' => Yii::t('viLib', 'Addess'),
            'gioi_tinh' => Yii::t('viLib', 'Gender'),
            'ngay_sinh' => Yii::t('viLib', 'Birthday'),
            'trinh_do' => Yii::t('viLib', 'Qualification'),
            'luong_co_ban' => Yii::t('viLib', 'Base Salary'),
            'chuyen_mon' => Yii::t('viLib', 'Specialize'),
            'trang_thai' => Yii::t('viLib', 'Status'),
            'mat_khau' => Yii::t('viLib', 'Password'),
            'ngay_vao_lam' => Yii::t('viLib', 'Day start up'),
            'lan_dang_nhap_cuoi' => Yii::t('viLib', 'Last login'),
            'loai_nhan_vien_id' => Yii::t('viLib','Employee type'),
            'chi_nhanh_id' => null,
            'chungTus' => null,
            'tblQuyens' => null,
            'loaiNhanVien' => null,
            'chiNhanh' => null,
        );
    }


    public function them($params)
    {
        // kiem tra du lieu con bi trung hay chua

        if (!$this->kiemTraTonTai($params)) {
            //neu khoa chua ton tai
            $this->setAttributes($params);
            $this->mat_khau = md5($this->mat_khau);
            $relatedData = array( //'tblQuyens' => $_POST['NhanVien']['tblQuyens'] === '' ? null : $_POST['NhanVien']['tblQuyens'],
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

        $relatedData = array( /*'tblQuyens' => $_POST['NhanVien']['tblQuyens'] === '' ? null : $_POST['NhanVien']['tblQuyens'],*/);
        if (!$this->kiemTraTonTai($params)) {
            $this->setAttributes($params);
            $this->mat_khau = md5($this->mat_khau);
            if ($this->saveWithRelated($relatedData))
                return 'ok';
            else
                return 'fail';
        } else {

            // so sanh ma cu == ma moi
            if ($this->soKhopMa($params)) {
                $this->setAttributes($params);
                $this->mat_khau = md5($this->mat_khau);
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
        $criteria->compare('ma_nhan_vien', $this->ma_nhan_vien, true);
        $criteria->compare('ho_ten', $this->ho_ten, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('dien_thoai', $this->dien_thoai, true);
        $criteria->compare('dia_chi', $this->dia_chi, true);
        $criteria->compare('gioi_tinh', $this->gioi_tinh);
        $criteria->compare('ngay_sinh', $this->ngay_sinh, true);
        $criteria->compare('trinh_do', $this->trinh_do, true);
        $criteria->compare('luong_co_ban', $this->luong_co_ban);
        $criteria->compare('chuyen_mon', $this->chuyen_mon, true);
        $criteria->compare('trang_thai', $this->trang_thai);
        $criteria->compare('mat_khau', $this->mat_khau, true);
        $criteria->compare('ngay_vao_lam', $this->ngay_vao_lam, true);
        $criteria->compare('lan_dang_nhap_cuoi', $this->lan_dang_nhap_cuoi, true);
        $criteria->compare('loai_nhan_vien_id', $this->loai_nhan_vien_id);
        $criteria->compare('chi_nhanh_id', $this->chi_nhanh_id);

        /*$event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['NhanVien'];
        $this->onAfterExport($event);*/

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function layDanhSachGioiTinh()
    {
        return array('Nam', 'Nữ');
    }
    public function layTenGioiTinh() {
        $danhSachGioiTinh = $this->layDanhSachGioiTinh();
        return $danhSachGioiTinh[$this->gioi_tinh];
    }

    public static function getRole($id) {
        return  Yii::app()->db->createCommand()
            ->select('itemname')
            ->from('AuthAssignment')
            ->where('userid=:nhan_vien_id')
            ->queryScalar(array(':nhan_vien_id'=>$id));

    }


}