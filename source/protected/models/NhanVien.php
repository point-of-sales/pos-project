<?php

Yii::import('application.models._base.BaseNhanVien');

class NhanVien extends BaseNhanVien
{


    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function rules() {
        return array(
            array('ma_nhan_vien, ho_ten, trang_thai, loai_nhan_vien_id, chi_nhanh_id,mat_khau', 'required','on'=>'them'),
            array('ma_nhan_vien, ho_ten, trang_thai, loai_nhan_vien_id, chi_nhanh_id', 'required','on'=>'capnhat'),
            array('gioi_tinh, trang_thai, loai_nhan_vien_id, chi_nhanh_id', 'numerical', 'integerOnly'=>true),
            array('luong_co_ban', 'numerical'),
            array('ma_nhan_vien', 'length', 'max'=>10),
            array('ho_ten, dia_chi, chuyen_mon', 'length', 'max'=>200),
            array('email, trinh_do, mat_khau', 'length', 'max'=>100),
            array('dien_thoai', 'length', 'max'=>12),
            array('ngay_sinh, ngay_vao_lam, lan_dang_nhap_cuoi', 'safe'),
            array('email, dien_thoai, dia_chi, gioi_tinh, ngay_sinh, trinh_do, luong_co_ban, chuyen_mon, ngay_vao_lam, lan_dang_nhap_cuoi', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, ma_nhan_vien, ho_ten, email, dien_thoai, dia_chi, gioi_tinh, ngay_sinh, trinh_do, luong_co_ban, chuyen_mon, trang_thai, ngay_vao_lam, lan_dang_nhap_cuoi, loai_nhan_vien_id, chi_nhanh_id', 'safe', 'on'=>'search'),
        );
    }

    public function relations()
    {
        return array(
            'chungTus' => array(self::HAS_MANY, 'ChungTu', 'nhan_vien_id'),
            'loaiNhanVien' => array(self::BELONGS_TO, 'LoaiNhanVien', 'loai_nhan_vien_id'),
            'chiNhanh' => array(self::BELONGS_TO, 'ChiNhanh', 'chi_nhanh_id'),
            'quyen' => array(self::HAS_MANY, 'AuthAssignment', 'userid'),
        );
    }

    public function attributeLabels()
    {
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
            'loai_nhan_vien_id' => Yii::t('viLib', 'Employee type'),
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

        if (!$this->kiemTraTonTai($params['NhanVien'])) {
            //neu khoa chua ton tai
            $this->setAttributes($params['NhanVien']);
            $this->mat_khau = md5($this->mat_khau);
            $relatedData = array( //'tblQuyens' => $_POST['NhanVien']['tblQuyens'] === '' ? null : $_POST['NhanVien']['tblQuyens'],
            );
            if ($this->saveWithRelated($relatedData)) {
                // add userid to $_POST['AuthAssignment'] to for assign right;
                $nhanVienSaved = NhanVien::model()->findByAttributes(array('ma_nhan_vien' => $this->ma_nhan_vien));

                $this->quyen->itemname = $params['AuthAssignment']['itemname'];
                $this->quyen->userid = $nhanVienSaved->getAttribute('id');
                if ($this->quyen->save())
                    return 'ok';
                else
                    return 'fail';
            }
        } else
            return 'dup-error';
    }

    public function layDanhSachThuocTinhKhongMatKhau(){
        $danhSachThuocTinh = $this->getAttributes();
        $danhsachThuoTinhKhongMatKhau = array();
        foreach($danhSachThuocTinh as $key=>$value) {
            if($key!='mat_khau') {
                $danhsachThuoTinhKhongMatKhau[$key] = $value;
            }
        }
        return $danhsachThuoTinhKhongMatKhau;

    }

    public function updateProcess($params)
    {
        $relatedData = array( /*'tblQuyens' => $_POST['NhanVien']['tblQuyens'] === '' ? null : $_POST['NhanVien']['tblQuyens'],*/);
        if (!$this->kiemTraTonTai($params['NhanVien'])) { // kiem tra du lieu con bi trung hay chua
            $this->setAttributes($params['NhanVien']);
            if ($this->saveAttributes($this->layDanhSachThuocTinhKhongMatKhau())) {
                $this->quyen->itemname = $params['AuthAssignment']['itemname'];
                if ($this->quyen->save())
                    return 'ok';
                else
                    return 'fail';
            }
        } else {
            // so sanh ma cu == ma moi
            if ($this->soKhopMa($params['NhanVien'])) {
                $this->setAttributes($params['NhanVien']);
                if ($this->saveAttributes($this->layDanhSachThuocTinhKhongMatKhau())) {
                    $this->quyen->itemname = $params['AuthAssignment']['itemname'];
                    if ($this->quyen->save())
                        return 'ok';
                    else
                        return 'fail';
                }
            } else
                return 'dup-error';
        }
    }

    public function deleteProcess()
    {
        $this->quyen = AuthAssignment::model()->find('userid=:userid', array(':userid' => $this->id));
        if ($this->quyen->delete()) {
            if ($this->delete())
                return 'ok';
            else
                return 'fail';
        }
    }

    public function capNhat($params)
    {
        if (RightsWeight::getRoleWeight(Yii::app()->user->id) == 999) { //user hien hanh la quan tri
            if (RightsWeight::getRoleWeight($this->id) < 999)
                    return $this->updateProcess($params);
            else {
                if($this->id == Yii::app()->user->id)
                    return $this->updateProcess($params);
                else
                    return 'override-update-error';         // loi khong cho ghi de
            }

        } else {
            $idChiNhanhCapNhat = $this->chiNhanh->id;

            $idChiNhanhHienHanh = NhanVien::model()->findByPk(Yii::app()->user->id)->chiNhanh->id;

            if ($idChiNhanhCapNhat == $idChiNhanhHienHanh) {
                if (RightsWeight::getRoleWeight($this->id) == 999)
                    return 'override-update-error';
                else
                    return $this->updateProcess($params);
            } else
                return 'place-update-error';
        }
    }

    public function xoa()
    {
        $relation = $this->kiemTraQuanHe($this->id);
        if (!$relation) {
            if (Yii::app()->user->id != $this->id && RightsWeight::getRoleWeight($this->id) < 999) { // kiem tra nguoi dung hien hanh
                // kiem tra user xoa co thuoc chi nhanh minh quan ly hay khong. Neu khong thi khong duoc xoa
                if (RightsWeight::getRoleWeight(Yii::app()->user->id) == 999) // kiem tra co phai la quan tri he thong khong
                return $this->deleteProcess();
                else { // khong la quan tri chi co quyen xoa nhan vien thuoc chi nhanh cua minh va
                    $idChiNhanhXoa = $this->chiNhanh->id;
                    $idChiNhanhHienHanh = NhanVien::model()->findByPk(Yii::app()->user->id)->chiNhanh->id;
                    if ($idChiNhanhHienHanh == $idChiNhanhXoa) // xoa cung 1 chu nhanh
                    return $this->deleteProcess();
                    else
                        return 'place-delete-error';
                }

            } else
                return 'override-delete-error'; // bao loi khong duoc xoa nguoi dung hien hanh

        } else
            return 'rel-error';

    }

    public function search() {
        $criteria = new CDbCriteria;
        $cauHinh = CauHinh::model()->findByPk(1);
        $criteria->compare('ma_nhan_vien', $this->ma_nhan_vien, true);
        $criteria->compare('ho_ten', $this->ho_ten, true);
        $criteria->compare('gioi_tinh', $this->gioi_tinh);
        $criteria->compare('trang_thai', $this->trang_thai);
        $criteria->compare('loai_nhan_vien_id', $this->loai_nhan_vien_id);
        $criteria->compare('chi_nhanh_id', $this->chi_nhanh_id);

        if(RightsWeight::getRoleWeight(Yii::app()->user->id)<999) {    // neu nguoi dung la quan tri co quyen truy cap tat ca
            $nhanVien = NhanVien::model()->findByPk(Yii::app()->user->id);
            $criteria->compare('chi_nhanh_id', $nhanVien->chiNhanh->id);
        }                                                        // neu nguoi dung la quan ly chi nhanh chi cho phep xem nhan vien trong chi nhanh cua minh
        $numberRecords = $cauHinh->so_muc_tin_tren_trang;

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>$numberRecords,
            ),
        ));
    }

    public function xuatFileExcel()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('ma_nhan_vien', $this->ma_nhan_vien, true);
        $criteria->compare('ho_ten', $this->ho_ten, true);
        $criteria->compare('gioi_tinh', $this->gioi_tinh);
        $criteria->compare('trang_thai', $this->trang_thai);
        $criteria->compare('loai_nhan_vien_id', $this->loai_nhan_vien_id);
        $criteria->compare('chi_nhanh_id', $this->chi_nhanh_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function layDanhSachGioiTinh()
    {
        return array('Nam', 'Nữ');
    }

    public function layTenGioiTinh()
    {
        $danhSachGioiTinh = NhanVien::layDanhSachGioiTinh();
        return $danhSachGioiTinh[$this->gioi_tinh];
    }


}