<?php

class SanPhamController extends CPOSController
{


    public function actionChiTiet($id)
    {
        if (Yii::app()->user->checkAccess('Quanlysanpham.SanPham.ChiTiet')) {
            $model = $this->loadModel($id, 'SanPham');
            //lay danh sach cac moc gia cua san pham nay
            $this->render('chitiet', array(
                'model' => $model,
            ));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionThem()
    {
        if (Yii::app()->user->checkAccess('Quanlysanpham.SanPham.Them')) {
            $model = new SanPham;

            if (isset($_POST['SanPham'])) {
                $result = $model->them($_POST['SanPham']);
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

    public function actionThemAjax()
    {
        if (Yii::app()->user->checkAccess('Quanlysanpham.SanPham.ThemAjax')) {
            $model = new SanPham;
            $flag = true;
            if (isset($_POST['SanPham'])) {
                $flag = false;
                $model->trang_thai = 1; // mac dinh kich hoat san
                $result = $model->them($_POST['SanPham']);
                echo $result;
            }
            if ($flag) {
                Yii::app()->clientScript->scriptMap['jquery.js'] = false;
                $this->renderPartial('themajax', array('model' => $model), false, true);
            }
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionCapNhat($id)
    {
        if (Yii::app()->user->checkAccess('Quanlysanpham.SanPham.CapNhat')) {
            $model = $this->loadModel($id, 'SanPham');
            $this->performAjaxValidation($model);
            if (isset($_POST['SanPham'])) {
                $result = $model->capNhat($_POST['SanPham']);
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
        if (Yii::app()->user->checkAccess('Quanlysanpham.SanPham.XoaGrid')) {
            if (Yii::app()->getRequest()->getIsPostRequest()) {
                $delModel = $this->loadModel($id, 'SanPham');
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
        if (Yii::app()->user->checkAccess('Quanlysanpham.SanPham.Xoa')) {
            if (Yii::app()->getRequest()->getIsPostRequest()) {
                $delModel = $this->loadModel($id, 'SanPham');
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

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'san-pham-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionDanhSach()
    {
        if (Yii::app()->user->checkAccess('Quanlysanpham.SanPham.DanhSach')) {
            $model = new SanPham('search');
            $model->unsetAttributes();
            Yii::app()->CPOSSessionManager->clearKey('ExportData');
            if (isset($_GET['SanPham'])) {
                // set vao session
                Yii::app()->CPOSSessionManager->setItem('ExportData', $_GET['SanPham']);
                $model->setAttributes($_GET['SanPham']);
                $model->setAttribute('chi_nhanh_id', $_GET['SanPham']['tblChiNhanhs']);

            }
            $this->render('danhsach', array('model' => $model));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function  actionXuat()
    {
        if (Yii::app()->user->checkAccess('Quanlysanpham.SanPham.Xuat')) {
            $model = new SanPham('search');
            $model->unsetAttributes();
            if (!Yii::app()->CPOSSessionManager->isEmpty('ExportData')) {
                $model->setAttributes(Yii::app()->CPOSSessionManager->getItem('ExportData'));
                $tmp = Yii::app()->CPOSSessionManager->getItem('ExportData');
                $chi_nhanh_id = $tmp['tblChiNhanhs'];
                $model->setAttribute('chi_nhanh_id', $chi_nhanh_id);
                $dataProvider = $model->xuatFileExcel();
                $this->render('xuat', array('dataProvider' => $dataProvider));
            }
            $this->render('xuat', array('dataProvider' => new CActiveDataProvider('SanPham')));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

}