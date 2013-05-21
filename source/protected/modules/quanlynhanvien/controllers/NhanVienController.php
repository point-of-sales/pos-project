<?php

class NhanVienController extends CPOSController
{


    public function actionChiTiet($id)
    {
        if (Yii::app()->user->checkAccess('Quanlynhanvien.NhanVien.ChiTiet')) {
            $this->render('chitiet', array(
                'model' => $this->loadModel($id, 'NhanVien'),
            ));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionThem()
    {
        if (Yii::app()->user->checkAccess('Quanlynhanvien.NhanVien.Them')) {
            $model = new NhanVien;
            $model->gioi_tinh = 0;
            $model->trang_thai = 1;

            if (isset($_POST['NhanVien'])) {
                $result = $model->them($_POST['NhanVien']);
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
        if (Yii::app()->user->checkAccess('Quanlynhanvien.NhanVien.CapNhat')) {
            $model = $this->loadModel($id, 'NhanVien');
            if (isset($_POST['NhanVien'])) {
                $result = $model->capNhat($_POST['NhanVien']);
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
        if (Yii::app()->user->checkAccess('Quanlynhanvien.NhanVien.XoaGrid')) {
            if (Yii::app()->getRequest()->getIsPostRequest()) {
                $delModel = $this->loadModel($id, 'NhanVien');
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
        if (Yii::app()->user->checkAccess('Quanlynhanvien.NhanVien.Xao')) {
            if (Yii::app()->getRequest()->getIsPostRequest()) {
                $delModel = $this->loadModel($id, 'NhanVien');
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
        if (Yii::app()->user->checkAccess('Quanlynhanvien.NhanVien.DanhSach')) {
            $model = new NhanVien('search');
            $model->unsetAttributes();
            Yii::app()->CPOSSessionManager->clearKey('ExportData');
            if (isset($_GET['NhanVien'])) {
                // set vao session
                Yii::app()->CPOSSessionManager->setItem('ExportData', $_GET['NhanVien']);
                $model->setAttributes($_GET['NhanVien']);
            }
            $this->render('danhsach', array('model' => $model));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function  actionXuat()
    {
        if (Yii::app()->user->checkAccess('Quanlynhanvien.NhanVien.Xuat')) {
            $model = new NhanVien('search');
            $model->unsetAttributes();
            if (!Yii::app()->CPOSSessionManager->isEmpty('ExportData')) {
                $model->setAttributes(Yii::app()->CPOSSessionManager->getItem('ExportData'));
                $dataProvider = $model->xuatFileExcel();
                $this->render('xuat', array('dataProvider' => $dataProvider));
            }
            $this->render('xuat', array('dataProvider' => new CActiveDataProvider('NhanVien')));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionAjaxActive($id)
    {
        if (Yii::app()->user->checkAccess('Quanlynhanvien.NhanVien.AjaxActive')) {
            if (Yii::app()->getRequest()->getIsPostRequest()) {
                $model = $this->loadModel($id, 'NhanVien');
                $active = ($model->trang_thai == 1) ? 0 : 1;
                $result = $model->saveAttributes(array('trang_thai' => $active));
                if ($result) {
                    //break;
                } else {
                    echo Yii::t('viLib', 'Some errors occur in delete process. Please check your DBMS!');
                    //break;
                }
                if (!Yii::app()->getRequest()->getIsAjaxRequest())
                    $this->redirect(array('danhsach'));
            } else
                throw new CHttpException(400, Yii::t('viLib', 'Your request is invalid.'));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }


}