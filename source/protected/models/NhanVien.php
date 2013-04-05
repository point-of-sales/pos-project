<?php

Yii::import('application.models._base.BaseNhanVien');

class NhanVien extends BaseNhanVien
{
    public function getSex(){
        return array('Nam','Nữ');
    }
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
    public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'ma_nhan_vien' => Yii::t('app', 'Mã nhân viên'),
			'ho_ten' => Yii::t('app', 'Họ tên'),
			'email' => Yii::t('app', 'Email'),
			'dien_thoai' => Yii::t('app', 'Điện thoại'),
			'dia_chi' => Yii::t('app', 'Địa chỉ'),
			'gioi_tinh' => Yii::t('app', 'Giới tính'),
			'ngay_sinh' => Yii::t('app', 'Ngày sinh'),
			'trinh_do' => Yii::t('app', 'Trình độ'),
			'luong_co_ban' => Yii::t('app', 'Lương cơ bản'),
			'chuyen_mon' => Yii::t('app', 'Chuyên môn'),
			'trang_thai' => Yii::t('app', 'Trạng thái'),
			'mat_khau' => Yii::t('app', 'Mật khẩu'),
			'ngay_vao_lam' => Yii::t('app', 'Ngày vào làm'),
			'lan_dang_nhap_cuoi' => Yii::t('app', 'Lần đăng nhập cuối'),
			'loai_nhan_vien_id' => null,
			'chi_nhanh_id' => null,
			'chungTus' => null,
			'tblQuyens' => null,
			'chiNhanh' => null,
			'loaiNhanVien' => null,
		);
	}
}