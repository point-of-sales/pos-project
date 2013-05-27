<?php

class PhieuNhapController extends CPOSController
{


    public function actionChiTiet($id)
    {
        if (Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuNhap.ChiTiet')) {
            $model = $this->loadModel($id, 'PhieuNhap');
            $model->getBaseModel();
            $criteria = new CDbCriteria();
            $criteria->condition = 'phieu_nhap_id=:phieu_nhap_id';
            $criteria->params = array(':phieu_nhap_id' => $id);
            $chiTietPhieuNhapDataProvider = new CActiveDataProvider('ChiTietPhieuNhap', array('criteria' => $criteria));
            $this->render('chitiet', array(
                'model' => $model,
                'dataProvider' => $chiTietPhieuNhapDataProvider,
            ));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionChiTietXuatSanPhamTang($id)
    {
        if (Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuNhap.ChiTietXuatSanPhamTang')) {
            $model = $this->loadModel($id, 'PhieuNhap');
            $model->getBaseModel();
            $criteria = new CDbCriteria();
            $criteria->condition = 'phieu_nhap_id=:phieu_nhap_id';
            $criteria->params = array(':phieu_nhap_id' => $id);
            $chiTietPhieuNhapSanPhamTangDataProvider = new CActiveDataProvider('ChiTietPhieuNhapSanPhamTang', array('criteria' => $criteria));
            $this->render('chitiet', array(
                'model' => $model,
                'dataProvider' => $chiTietPhieuNhapSanPhamTangDataProvider,
            ));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }


    public function actionThem($id = null)
    {
        if (Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuNhap.Them')) {
            $this->layout = '//layouts/column1';
            $model = new PhieuNhap;
            $model->getBaseModel()->ma_chung_tu = PhieuNhap::layMaChungTuMoi('PhieuNhap', 'PN');
            if (isset($_POST['ChungTu'])) {
                $result = $model->them($_POST);
                switch ($result) {
                    case 'ok':
                    {
                        // clear Session
                        Yii::app()->CPOSSessionManager->clearKey('ChiTietPhieuNhap');
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

    public function actionNhapSanPhamTang($id = null)
    {
        if (Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuNhap.NhapSanPhamTang')) {
            $this->layout = '//layouts/column1';
            $model = new PhieuNhap;
            $model->getBaseModel()->ma_chung_tu = PhieuNhap::layMaChungTuMoi('PhieuNhap', 'PN');
            if (isset($_POST['ChungTu'])) {
                $result = $model->nhapHangTang($_POST);
                switch ($result) {
                    case 'ok':
                    {
                        // clear Session
                        Yii::app()->CPOSSessionManager->clearKey('ChiTietPhieuNhap');
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
                $this->render('nhapsanphamtang', array('model' => $model, 'id' => $id));
            else
                $this->render('nhapsanphamtang', array('model' => $model));

        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionCapNhat($id)
    {
        if (Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuNhap.CapNhat')) {
            $model = $this->loadModel($id, 'PhieuNhap');


            if (isset($_POST['PhieuNhap'])) {
                $result = $model->capNhat($_POST['PhieuNhap']);
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
        if (Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuNhap.XoaGrid')) {
            if (Yii::app()->getRequest()->getIsPostRequest()) {
                $delModel = $this->loadModel($id, 'PhieuNhap');
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
        if (Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuNhap.Xoa')) {
            if (Yii::app()->getRequest()->getIsPostRequest()) {
                $delModel = $this->loadModel($id, 'PhieuNhap');
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
        if (Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuNhap.DanhSach')) {
            $model = new PhieuNhap('search');
            $model->unsetAttributes();
            Yii::app()->CPOSSessionManager->clearKey('ExportData');
            if (isset($_GET['ChungTu'])) {
                // set vao session
                Yii::app()->CPOSSessionManager->setItem('ExportData', $_GET['PhieuNhap']);
                $model->setAttributes($_GET);
                $model->setAttribute('id', $model->baseModel->getAttribute('id'));

            }
            $this->render('danhsach', array('model' => $model));

        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function  actionXuat($id)
    {
        if (Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuNhap.Xuat')) {
            if (isset($id)) {
                $criteria = new CDbCriteria();
                $criteria->condition = 'phieu_nhap_id=:phieu_nhap_id';
                $criteria->params = array(':phieu_nhap_id' => $id);
                $chiTietPhieuNhapDataProvider = new CActiveDataProvider('ChiTietPhieuNhap', array('criteria' => $criteria));
                $this->render('xuat', array('dataProvider' => $chiTietPhieuNhapDataProvider));
            }
            throw new CHttpException(404, 'Id not found');
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionSyncData()
    {
        if (Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuNhap.SyncData')) {
            Yii::app()->CPOSSessionManager->clearKey('ChiTietPhieuNhap');
            Yii::app()->CPOSSessionManager->clearKey('ChiTietPhieuNhapSanPhamTang');
            if (isset($_POST['items'])) {
                if ($_POST['type']) // xuat san pham ban
                Yii::app()->CPOSSessionManager->setItem('ChiTietPhieuNhap', $_POST['items'], array('items'));
                else
                    Yii::app()->CPOSSessionManager->setItem('ChiTietPhieuNhapSanPhamTang', $_POST['items'], array('items'));
            }

        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionReCheckBeforeSent()
    {
        if (Yii::app()->user->checkAccess('Quanlynhapxuat.PhieuNhap.ReCheckBeforeSent')) {
            $result = 'ok';
            if (Yii::app()->request->isAjaxRequest) {
                // check valid quantity
                if (!Yii::app()->CPOSSessionManager->isEmpty('ChiTietPhieuNhap')) {
                    $sessionItems = Yii::app()->CPOSSessionManager->getKey('ChiTietPhieuNhap');
                    $items = $sessionItems['items'];
                    foreach ($items as $item) {
                        if ($item['so_luong'] <= 0 || $item['gia_nhap'] <= 0) {
                            $result = 'fail';
                            break;
                        }
                    }
                } else
                    $result = 'fail';
                echo $result;
            } else
                throw new CHttpException(400, Yii::t('viLib', 'Your request is invalid.'));

        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

}
