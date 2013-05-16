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
                $criteria->with = 'sanPhamChiNhanh';
                $criteria->together = true;
                $criteria->compare('sanPhamChiNhanh.chi_nhanh_id', $chi_nhanh_id, false);
                $danhSachSanPham = new CActiveDataProvider('SanPham', array('criteria' => $criteria));
                $danhSachSanPhamData = $danhSachSanPham->getData();

                foreach ($danhSachSanPhamData as $sanPham) {
                    $sanPham->chi_nhanh_id = $chi_nhanh_id;
                    $sanPham->tinhNhapXuatTon($thoi_gian_bat_dau, $thoi_gian_ket_thuc);
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
            $data = array();
            if (strtotime($thoi_gian_bat_dau) < strtotime($thoi_gian_ket_thuc)) {
                if (!empty($chi_nhanh_id)) {
                    $criteria = new CDbCriteria();
                    $criteria->compare('id',$chi_nhanh_id);
                    $chiNhanh = new CActiveDataProvider('ChiNhanh',array('criteria'=>$criteria));
                    $danhSachChiNhanhData = $chiNhanh->getData();
                    foreach ($danhSachChiNhanhData as $cn)
                        $cn->tinhDoanhSoTheoKhoangThoiGian($thoi_gian_bat_dau,$thoi_gian_ket_thuc);
                } else {
                    $criteria = new CDbCriteria();
                    $criteria->addCondition(array('trang_thai' => 1));
                    $criteria->compare('id',1,false,'>');
                    $chiNhanh = new CActiveDataProvider('ChiNhanh', array('criteria' => $criteria));
                    $danhSachChiNhanhData = $chiNhanh->getData();
                    foreach ($danhSachChiNhanhData as $cn)
                        $cn->tinhDoanhSoTheoKhoangThoiGian($thoi_gian_bat_dau,$thoi_gian_ket_thuc);

                }

            } else
                Yii::app()->user->setFlash('info-board', Yii::t('viLib', 'Time period is wrong format'));
        }
        $this->render('banhang', array('chiNhanh' => isset($chiNhanh) ? $chiNhanh : null, 'thoi_gian_bat_dau' => isset($thoi_gian_bat_dau) ? $thoi_gian_bat_dau : null, 'thoi_gian_ket_thuc' => isset($thoi_gian_ket_thuc) ? $thoi_gian_ket_thuc : null));
    }

}