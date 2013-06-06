<?php

class PhieuXuatController extends CPOSController
{


    public function actionChiTiet($id)
    {
        if (Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuXuat.ChiTiet')) {
            $model = $this->loadModel($id, 'PhieuXuat');
            $model->getBaseModel();
            $criteria = new CDbCriteria();
            $criteria->condition = 'phieu_xuat_id=:phieu_xuat_id';
            $criteria->params = array(':phieu_xuat_id' => $id);
            $chiTietPhieuXuatDataProvider = new CActiveDataProvider('ChiTietPhieuXuat', array('criteria' => $criteria));
            $this->render('chitiet', array(
                'model' => $model,
                'dataProvider' => $chiTietPhieuXuatDataProvider,
            ));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionChiTietXuatSanPhamTang($id)
    {
        if (Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuXuat.ChiTietXuatSanPhamTang')) {
            $model = $this->loadModel($id, 'PhieuXuat');
            $model->getBaseModel();
            $criteria = new CDbCriteria();
            $criteria->condition = 'phieu_xuat_id=:phieu_xuat_id';
            $criteria->params = array(':phieu_xuat_id' => $id);
            $chiTietPhieuXuatSanPhamTangDataProvider = new CActiveDataProvider('ChiTietPhieuXuatSanPhamTang', array('criteria' => $criteria));
            $this->render('chitietxuatsanphamtang', array(
                'model' => $model,
                'dataProvider' => $chiTietPhieuXuatSanPhamTangDataProvider,
            ));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionThem($id = null)
    {
        if (Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuXuat.Them')) {
            $this->layout = '//layouts/column1';
            $model = new PhieuXuat;
            $model->getBaseModel()->ma_chung_tu = PhieuNhap::layMaChungTuMoi('PhieuXuat', 'PX');
            if (isset($_POST['ChungTu'])) {
                $result = $model->them($_POST);
                switch ($result) {
                    case 'ok':
                    {
                        Yii::app()->CPOSSessionManager->clearKey('ChiTietPhieuXuat');
                        if (Yii::app()->getRequest()->getIsAjaxRequest())
                            Yii::app()->end();
                        else
                            $this->redirect(array('chitiet', 'id' => $model->id));
                        break;
                    }
                    case 'dup-error':
                    {
                        Yii::app()->user->setFlash('info-board', Yii::t('viLib', 'Data existed in sytem. Please try another one!'));
                        break;
                    }
                    case 'detail-error':
                    {
                        Yii::app()->user->setFlash('info-board', Yii::t('viLib', 'Detail import is not existed. Please fill it'));
                        break;
                    }
                    case 'fail':
                    {
                        // co the lam them canh bao cho nguoi dung
                        break;
                    }
                }
            }
            if (isset($id))
                $this->render('them', array('model' => $model, 'id' => $id));
            else
                $this->render('them', array('model' => $model));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }


    public function actionXuatSanPhamTang($id = null)
    {
        if (Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuXuat.XuatSanPhamTang')) {
            $this->layout = '//layouts/column1';
            $model = new PhieuXuat;
            $model->getBaseModel()->ma_chung_tu = PhieuNhap::layMaChungTuMoi('PhieuXuat', 'PX');
            if (isset($_POST['ChungTu'])) {
                $result = $model->themPhieuXuatSanPhamTang($_POST);
                switch ($result) {
                    case 'ok':
                    {
                        Yii::app()->CPOSSessionManager->clearKey('ChiTietPhieuXuatSanPhamTang');
                        if (Yii::app()->getRequest()->getIsAjaxRequest())
                            Yii::app()->end();
                        else
                            $this->redirect(array('chitietxuatsanphamtang', 'id' => $model->id));
                        break;
                    }
                    case 'dup-error':
                    {
                        Yii::app()->user->setFlash('info-board', Yii::t('viLib', 'Data existed in sytem. Please try another one!'));
                        break;
                    }
                    case 'detail-error':
                    {
                        Yii::app()->user->setFlash('info-board', Yii::t('viLib', 'Detail import is not existed. Please fill it'));
                        break;
                    }
                    case 'fail':
                    {
                        // co the lam them canh bao cho nguoi dung
                        break;
                    }
                }

            }
            if (isset($id))
                $this->render('xuatsanphamtang', array('model' => $model, 'id' => $id));
            else
                $this->render('xuatsanphamtang', array('model' => $model));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionDanhSach()
    {
        if (Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuXuat.DanhSach')) {
            $model = new PhieuXuat('search');

            $model->unsetAttributes();
            Yii::app()->CPOSSessionManager->clearKey('ExportData');
            if (isset($_GET['ChungTu'])) {
                // set vao session
                Yii::app()->CPOSSessionManager->setItem('ExportData', $_GET['PhieuXuat']);
                $model->setAttributes($_GET);
                $model->setAttribute('id', $model->baseModel->getAttribute('id'));
            }
            $this->render('danhsach', array('model' => $model));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function  actionXuat($id)
    {
        if (Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuXuat.Xuat')) {
            if (isset($id)) {
                $criteria = new CDbCriteria();
                $criteria->condition = 'phieu_xuat_id=:phieu_xuat_id';
                $criteria->params = array(':phieu_xuat_id' => $id);
                $chiTietPhieuXuatDataProvider = new CActiveDataProvider('ChiTietPhieuXuat', array('criteria' => $criteria));
                $this->render('xuat', array('dataProvider' => $chiTietPhieuXuatDataProvider));
            }
            throw new CException(404, 'Page not found');
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionLaySoLuongTon($ma_vach, $chi_nhanh_id)
    {
        if (Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuXuat.LaySoLuongTon')) {
            if (Yii::app()->getRequest()->getIsAjaxRequest()) {
                if (isset($chi_nhanh_id) && isset($ma_vach)) {
                    $model = SanPham::model()->findByAttributes(array('ma_vach' => $ma_vach));
                    $model->chi_nhanh_id = $chi_nhanh_id;
                    $tonHienTai = $model->laySoLuongTonHienTai();
                    $item = array(
                        'so_ton' => $tonHienTai,
                        'ton_toi_thieu' => $model->ton_toi_thieu,
                    );
                }
                echo json_encode($item);
            } else
                throw new CHttpException(400, Yii::t('viLib', 'Your request is invalid.'));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));

    }

    public function actionLaySoLuongTonSanPhamTang($ma_vach, $chi_nhanh_id)
    {
        if (Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuXuat.LaySoLuongTonSanPhamTang')) {
            if (Yii::app()->getRequest()->getIsAjaxRequest()) {
                if (isset($chi_nhanh_id) && isset($ma_vach)) {
                    $model = SanPhamTang::model()->findByAttributes(array('ma_vach' => $ma_vach));
                    $model->chi_nhanh_id = $chi_nhanh_id;

                    $tonHienTai = $model->laySoLuongTonHienTai();
                    $item = array(
                        'so_ton' => $tonHienTai,
                    );
                }
                echo json_encode($item);
            } else
                throw new CHttpException(400, Yii::t('viLib', 'Your request is invalid.'));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));

    }

    public function actionSyncData()
    {
        if (Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuXuat.SyncData')) {
            Yii::app()->CPOSSessionManager->clearKey('ChiTietPhieuXuat');
            Yii::app()->CPOSSessionManager->clearKey('ChiTietPhieuXuatSanPhamTang');
            if (isset($_POST['items'])) {
                if ($_POST['type']) // xuat san pham ban
                Yii::app()->CPOSSessionManager->setItem('ChiTietPhieuXuat', $_POST['items'], array('items'));
                else
                    Yii::app()->CPOSSessionManager->setItem('ChiTietPhieuXuatSanPhamTang', $_POST['items'], array('items'));
            }

        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionReCheckBeforeSent($cnid)
    {
        if (Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuXuat.ReCheckBeforeSent')) {
            $result = 'ok';
            if (Yii::app()->request->isAjaxRequest) {

                if (!Yii::app()->CPOSSessionManager->isEmpty('ChiTietPhieuXuat')) {
                    // check valid quantity + check enought instock
                    $sessionItems = Yii::app()->CPOSSessionManager->getKey('ChiTietPhieuXuat');
                    $items = $sessionItems['items'];

                    foreach ($items as $item) {

                        $sanPham = SanPham::model()->find('id=:id', array(':id' => $item['id']));
                        $sanPham->chi_nhanh_id = $cnid;

                        $soTon = ($sanPham->laySoLuongTonHienTai() - $sanPham->ton_toi_thieu);
                        if ($item['so_luong'] <= 0 || $item['gia_xuat'] <= 0 || $item['so_luong'] > $soTon) {
                            $result = 'fail';
                            break;
                        }
                    }

                }
                else if (!Yii::app()->CPOSSessionManager->isEmpty('ChiTietPhieuXuatSanPhamTang')) {
                    // check valid quantity + check enought instock
                    $sessionItems = Yii::app()->CPOSSessionManager->getKey('ChiTietPhieuXuatSanPhamTang');
                    $items = $sessionItems['items'];

                    foreach ($items as $item) {

                        $sanPhamTang = SanPhamTang::model()->find('id=:id', array(':id' => $item['id']));
                        $sanPhamTang->chi_nhanh_id = $cnid;

                        $soTon = ($sanPhamTang->laySoLuongTonHienTai() - $sanPhamTang->ton_toi_thieu);
                        if ($item['so_luong'] <= 0 || $item['gia_xuat'] <= 0 || $item['so_luong'] > $soTon) {
                            $result = 'fail';
                            break;
                        }
                    }

                }
                else
                    $result = 'fail';
                echo $result;
            } else
                throw new CHttpException(400, Yii::t('viLib', 'Your request is invalid.'));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }


}