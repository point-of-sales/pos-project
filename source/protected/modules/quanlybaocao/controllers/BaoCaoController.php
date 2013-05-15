<?php

class BaoCaoController extends CPOSController
{
    public function actionDanhSach()
    {
        $this->render('danhsach');
    }

    public function actionNhapXuatTon()
    {
        if (isset($_POST['CPOSNhapXuatTonForm'])) {

            $chi_nhanh_id = $_POST['CPOSNhapXuatTonForm']['chi_nhanh_id'];
            $thoi_gian_bat_dau = $_POST['CPOSNhapXuatTonForm']['thoi_gian_bat_dau'];
            $thoi_gian_ket_thuc = $_POST['CPOSNhapXuatTonForm']['thoi_gian_ket_thuc'];
            $chiNhanh = $this->loadModel($chi_nhanh_id, 'ChiNhanh');
            if (strtotime($thoi_gian_ket_thuc) > strtotime($thoi_gian_bat_dau)) {
                $criteria = new CDbCriteria();
                $criteria->with = 'chungTu';
                $criteria->together = true;
                $criteria->addBetweenCondition('chungTu.ngay_lap', date('Y-m-d', strtotime($thoi_gian_bat_dau)), date('Y-m-d', strtotime($thoi_gian_ket_thuc)));
                $criteria->addCondition(array('chi_nhanh_id' => $chi_nhanh_id));
                $danhSachPhieuNhapTrongKy = PhieuNhap::model()->findAll($criteria);
                $danhSachPhieuXuatTrongKy = PhieuXuat::model()->findAll($criteria);
                $danhSachHoaDonBan = HoaDonBanHang::model()->findAll($criteria);

                $criteria2 = new CDbCriteria();
                $criteria2->with = 'chungTu';
                $criteria2->together = true;
                $criteria2->addCondition(array('chi_nhanh_id' => $chi_nhanh_id));
                $criteria2->compare('chungTu.ngay_lap', date('Y-m-d', strtotime($thoi_gian_bat_dau)), false, '<');
                $danhSachPhieuNhapDauKy = PhieuNhap::model()->findAll($criteria2);

                $criteria3 = new CDbCriteria();
                $criteria3->with = 'sanPhamChiNhanh';
                $criteria3->together = true;
                $criteria3->compare('sanPhamChiNhanh.chi_nhanh_id', $chi_nhanh_id, false);

                $danhSachSanPham = new CActiveDataProvider('SanPham', array('criteria' => $criteria3));
                $danhSachSanPhamData = $danhSachSanPham->getData();

                foreach ($danhSachSanPhamData as $sanPham) {
                    foreach ($danhSachPhieuNhapDauKy as $phieuNhapDauKy) {
                        $so_luong_nhap_dau_ky = Yii::app()->db->createCommand()
                            ->select('so_luong')
                            ->from('tbl_ChiTietPhieuNhap')
                            ->where('phieu_nhap_id=:phieu_nhap_id AND san_pham_id=:san_pham_id', array(':phieu_nhap_id' => $phieuNhapDauKy->id, ':san_pham_id' => $sanPham->id))
                            ->queryScalar();
                        $sanPham->ton_dau_ky = $sanPham->ton_dau_ky + $so_luong_nhap_dau_ky;
                    }
                    foreach ($danhSachPhieuNhapTrongKy as $phieuNhap) {
                        $so_luong_nhap = Yii::app()->db->createCommand()
                            ->select('so_luong')
                            ->from('tbl_ChiTietPhieuNhap')
                            ->where('phieu_nhap_id=:phieu_nhap_id AND san_pham_id=:san_pham_id', array(':phieu_nhap_id' => $phieuNhap->id, ':san_pham_id' => $sanPham->id))
                            ->queryScalar();
                        $sanPham->so_luong_nhap = $sanPham->so_luong_nhap + $so_luong_nhap;
                    }
                    foreach ($danhSachPhieuXuatTrongKy as $phieuXuat) {
                        $so_luong_xuat = Yii::app()->db->createCommand()
                            ->select('so_luong')
                            ->from('tbl_ChiTietPhieuXuat')
                            ->where('phieu_xuat_id=:phieu_xuat_id AND san_pham_id=:san_pham_id', array(':phieu_xuat_id' => $phieuXuat->id, ':san_pham_id' => $sanPham->id))
                            ->queryScalar();
                        $sanPham->so_luong_xuat = $sanPham->so_luong_xuat + $so_luong_xuat;
                    }
                    foreach ($danhSachHoaDonBan as $hoaDonBan) {
                        $so_luong_ban = Yii::app()->db->createCommand()
                            ->select('so_luong')
                            ->from('tbl_ChiTietHoaDonBan')
                            ->where('hoa_don_ban_id=:hoa_don_ban_id AND san_pham_id=:san_pham_id', array(':hoa_don_ban_id' => $hoaDonBan->id, ':san_pham_id' => $sanPham->id))
                            ->queryScalar();
                        $sanPham->so_luong_ban = $sanPham->so_luong_ban + $so_luong_ban;

                    }
                    $sanPham->so_luong_thuc_ton = ($sanPham->ton_dau_ky + $sanPham->so_luong_nhap) - ($sanPham->so_luong_ban + $sanPham->so_luong_xuat);
                }

            } else
                Yii::app()->user->setFlash('info-board', Yii::t('viLib', 'Time period is wrong format'));

        }
        if (isset($chiNhanh))
            $this->render('nhapxuatton', array('model' => (isset($danhSachSanPham)) ? $danhSachSanPham : null, 'chiNhanh' => $chiNhanh, 'thoi_gian_bat_dau' => $thoi_gian_bat_dau, 'thoi_gian_ket_thuc' => $thoi_gian_ket_thuc));
        // render content
        else
            $this->render('nhapxuatton'); // render intro
    }

    public function actionBanHang()
    {
        if (isset($_POST['CPOSBanHangForm'])) {
            $chi_nhanh_id = $_POST['CPOSBanHangForm']['chi_nhanh_id'];
            $thoi_gian_bat_dau = $_POST['CPOSBanHangForm']['thoi_gian_bat_dau'];
            $thoi_gian_ket_thuc = $_POST['CPOSBanHangForm']['thoi_gian_ket_thuc'];

            if (strtotime($thoi_gian_bat_dau) < strtotime($thoi_gian_ket_thuc)) {

                if (!empty($chi_nhanh_id)) { // lay ket qua ban hang tung chi nhanh
                    $chiNhanh = $this->loadModel($chi_nhanh_id, 'ChiNhanh');
                } else {
                    // lay tat ca
                    $data = array();
                    $data[] = array($thoi_gian_bat_dau, 0); // first init 0 0


                    do {
                        $thoi_gian_ket_thuc_moc = date('d-m-Y',(strtotime($thoi_gian_bat_dau) + 30 * 24 * 60 * 60));

                        if (strtotime($thoi_gian_ket_thuc_moc) > strtotime($thoi_gian_ket_thuc))
                            $thoi_gian_ket_thuc_moc = $thoi_gian_ket_thuc;
                        else
                            $thoi_gian_ket_thuc_moc = date('d-m-Y', strtotime($thoi_gian_ket_thuc_moc));

                        $criteria = new CDbCriteria();
                        $criteria->with = 'chungTu';
                        $criteria->together = true;
                        $criteria->addBetweenCondition('chungTu.ngay_lap', date('Y-m-d', strtotime($thoi_gian_bat_dau)), date('Y-m-d', strtotime($thoi_gian_ket_thuc_moc)));

                        $danhSachHoaDonTrongMoc = HoaDonBanHang::model()->findAll($criteria);
                        $tri_gia = 0;
                        foreach ($danhSachHoaDonTrongMoc as $hoaDon)
                            $tri_gia = $tri_gia + $hoaDon->getBaseModel()->tri_gia;

                        $data[] = array($thoi_gian_ket_thuc_moc, $tri_gia);
                    } while ($thoi_gian_ket_thuc_moc < strtotime($thoi_gian_ket_thuc));

                }
            }

        }
        $this->render('banhang');
    }

}