<?php

class KhuyenMaiController extends CPOSController
{


    public function actionChiTiet($id)
    {
        if (Yii::app()->user->checkAccess('Quanlykhuyenmai.KhuyenMai.ChiTiet')) {
            $model = $this->loadModel($id, 'KhuyenMai');
            $danhSachChiNhanh = $model->tblChiNhanhs;
            $this->render('chitiet', array(
                'model' => $model,
            ));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionThem()
    {
        if (Yii::app()->user->checkAccess('Quanlykhuyenmai.KhuyenMai.Them')) {
            $model = new KhuyenMai;

            if (isset($_POST['KhuyenMai'])) {
                $result = $model->them($_POST['KhuyenMai']);
                switch ($result) {
                    case 'ok':
                    {
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
                    case 'fail':
                    {
                        // co the lam them canh bao cho nguoi dung
                        break;
                    }
                }
            }
            $this->render('them', array('model' => $model));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionCapNhat($id)
    {
        if (Yii::app()->user->checkAccess('Quanlykhuyenmai.KhuyenMai.CapNhat')) {
            $model = $this->loadModel($id, 'KhuyenMai');


            if (isset($_POST['KhuyenMai'])) {
                $result = $model->capNhat($_POST['KhuyenMai']);
                switch ($result) {
                    case 'ok':
                    {
                        $this->redirect(array('chitiet', 'id' => $id));
                        break;
                    }
                    case 'dup-error':
                    {
                        Yii::app()->user->setFlash('info-board', Yii::t('viLib', 'Data existed in sytem. Please try another one!'));
                        break;
                    }
                    case 'fail':
                    {
                        // co the lam them canh bao cho nguoi dung
                        break;
                    }
                }
            }
            $this->render('capnhat', array('model' => $model));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionXoaGrid($id)
    {
        if (Yii::app()->user->checkAccess('Quanlykhuyenmai.KhuyenMai.XoaGrid')) {
            if (Yii::app()->getRequest()->getIsPostRequest()) {
                $delModel = $this->loadModel($id, 'KhuyenMai');
                $result = $delModel->xoa();
                switch ($result) {
                    case 'ok':
                    {
                        break;
                    }
                    case 'rel-error':
                    {
                        echo Yii::t('viLib', 'Can not delete this item because it contains relative data');
                        break;
                    }
                    case 'fail':
                    {
                        echo Yii::t('viLib', 'Some errors occur in delete process. Please check your DBMS!');
                        break;
                    }
                }
                if (!Yii::app()->getRequest()->getIsAjaxRequest())
                    $this->redirect(array('danhsach'));
            } else
                throw new CHttpException(400, Yii::t('viLib', 'Your request is invalid.'));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionXoa($id)
    {
        if (Yii::app()->user->checkAccess('Quanlykhuyenmai.KhuyenMai.Xoa')) {
            if (Yii::app()->getRequest()->getIsPostRequest()) {
                $delModel = $this->loadModel($id, 'KhuyenMai');
                $message = '';
                $canDelete = true;
                $result = $delModel->xoa();
                switch ($result) {
                    case 'ok':
                    {
                        break;
                    }
                    case 'rel-error':
                    {
                        $message = Yii::t('viLib', 'Can not delete this item because it contains relative data');
                        $canDelete = false;
                        break;
                    }
                    case 'fail':
                    {
                        $message = Yii::t('viLib', 'Some errors occur in delete process. Please check your DBMS!');
                        $canDelete = false;
                        break;
                    }
                }
                if ($canDelete) {
                    if (!Yii::app()->getRequest()->getIsAjaxRequest())
                        $this->redirect(array('danhsach'));
                } else {
                    Yii::app()->user->setFlash('info-board', $message);
                    $this->redirect(array('chitiet', 'id' => $id));
                }
                /*if (!Yii::app()->getRequest()->getIsAjaxRequest())
                    $this->redirect(array('danhsach'));*/
            } else
                throw new CHttpException(400, Yii::t('viLib', 'Your request is invalid.'));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionDanhSach()
    {
        if (Yii::app()->user->checkAccess('Quanlykhuyenmai.KhuyenMai.DanhSach')) {
            $model = new KhuyenMai('search');
            $model->unsetAttributes();
            Yii::app()->CPOSSessionManager->clearKey('ExportData');
            if (isset($_GET['KhuyenMai'])) {
                // set vao session
                Yii::app()->CPOSSessionManager->setItem('ExportData', $_GET['KhuyenMai']);
                $model->setAttributes($_GET['KhuyenMai']);
                $model->search();
            }
            $this->render('danhsach', array('model' => $model));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function  actionXuat()
    {
        if (Yii::app()->user->checkAccess('Quanlykhuyenmai.KhuyenMai.Xuat')) {
            $model = new KhuyenMai('search');
            $model->unsetAttributes();

            if (!Yii::app()->CPOSSessionManager->isEmpty('ExportData')) {
                $model->setAttributes(Yii::app()->CPOSSessionManager->getItem('ExportData'));
                $dataProvider = $model->xuatFileExcel();
                $this->render('xuat', array('dataProvider' => $dataProvider));
            }
            $this->render('xuat', array('dataProvider' => new CActiveDataProvider('KhuyenMai')));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function  actionXuatKhuyenMaiSanPham()
    {
        if (Yii::app()->user->checkAccess('Quanlykhuyenmai.KhuyenMai.XuatKhuyenMaiSanPham')) {
            $model = new SanPham('search');
            $model->unsetAttributes();
            Yii::app()->CPOSSessionManager->clearKey('ExportData');
            if (isset($_GET['SanPham'])) {
                // set vao session
                Yii::app()->CPOSSessionManager->setItem('ExportData', $_GET['SanPham']);
                $model->setAttributes($_GET['SanPham']);
                $model->setAttribute('chi_nhanh_id', $_GET['SanPham']['tblChiNhanhs']);
                $sanPhamDataProvider = $model->search();
            }
            if (!isset($sanPhamDataProvider))
                $sanPhamDataProvider = new CActiveDataProvider('SanPham');

            $this->render('xuatkhuyenmaisanpham', array('dataProvider' => $sanPhamDataProvider));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));

    }

    public function actionKhuyenMaiChiNhanh()
    {
        if (Yii::app()->user->checkAccess('Quanlykhuyenmai.KhuyenMai.KhuyenMaiChiNhanh')) {
            $chiNhanhProvider = new CActiveDataProvider('ChiNhanh');
            $this->render('khuyenmaichinhanh', array('chiNhanhProvider' => $chiNhanhProvider));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionKhuyenMaiSanPham()
    {
        if (Yii::app()->user->checkAccess('Quanlykhuyenmai.KhuyenMai.KhuyenMaiSanPham')) {
            $model = new SanPham('search');
            $model->unsetAttributes();
            Yii::app()->CPOSSessionManager->clearKey('ExportData');
            if (isset($_GET['SanPham'])) {
                // set vao session
                Yii::app()->CPOSSessionManager->setItem('ExportData', $_GET['SanPham']);
                $model->setAttributes($_GET['SanPham']);
                $model->setAttribute('chi_nhanh_id', $_GET['SanPham']['tblChiNhanhs']);
                $sanPhamDataProvider = $model->search();
            }
            if (!isset($sanPhamDataProvider))
                $sanPhamDataProvider = new CActiveDataProvider('SanPham');

            $this->render('khuyenmaisanpham', array('sanPhamDataProvider' => $sanPhamDataProvider, 'model' => $model));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));

    }

    public function actionCapNhatKhuyenMai($spid, $kmid)
    {
        if (Yii::app()->user->checkAccess('Quanlykhuyenmai.KhuyenMai.CapNhatKhuyenMai')) {
            if (Yii::app()->getRequest()->getIsAjaxRequest()) {
                if (isset($spid) && isset($kmid)) {
                    $model = SanPham::model()->findByAttributes(array("id" => $spid));
                    if ($kmid < 1)
                        $kmid = ''; // xoa khuyen mai cho san pham nay

                    $model->setAttribute('khuyen_mai_id', $kmid);
                    if ($model->save(false, null)) ;
                    echo 'ok';
                }
            } else
                throw new CHttpException(400, Yii::t('viLib', 'Your request is invalid.'));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

}