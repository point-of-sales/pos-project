<?php

class PhieuNhapController extends CPOSController
{


    public function actionChiTiet($id)
    {
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
    }

    public function actionThem($id = null)
    {
        $this->layout = '//layouts/column1';
        $model = new PhieuNhap;
        if (isset($_POST['ChungTu'])) {
            $result = $model->them($_POST);
            switch ($result) {
                case 'ok':
                {
                    // clear Session
                    Yii::app()->CPOSSessionManager->clear('ChiTietPhieuNhap');
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
    }

    public function actionNhapHangTang($id = null)
    {
        $this->layout = '//layouts/column1';
        $model = new PhieuNhap;
        if (isset($_POST['ChungTu'])) {
            $result = $model->them($_POST);
            switch ($result) {
                case 'ok':
                {
                    // clear Session
                    Yii::app()->CPOSSessionManager->clear('ChiTietPhieuNhap');
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
    }

    public function actionCapNhat($id)
    {
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
    }

    public function actionXoaGrid($id)
    {
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
    }

    public function actionXoa($id)
    {
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
    }

    public function actionDanhSach()
    {

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
    }

    public function  actionXuat($id)
    {
        if (isset($id)) {
            $criteria = new CDbCriteria();
            $criteria->condition = 'phieu_nhap_id=:phieu_nhap_id';
            $criteria->params = array(':phieu_nhap_id' => $id);
            $chiTietPhieuNhapDataProvider = new CActiveDataProvider('ChiTietPhieuNhap', array('criteria' => $criteria));
            $this->render('xuat', array('dataProvider' => $chiTietPhieuNhapDataProvider));
        }
        throw new CHttpException('404', 'Id not found');

    }

    public function actionSyncData()
    {
        Yii::app()->CPOSSessionManager->clear('ChiTietPhieuNhap');
        if (isset($_POST['items']))
            Yii::app()->CPOSSessionManager->setItem('ChiTietPhieuNhap', $_POST['items'], array('items'));

    }

    public function actionReCheckBeforeSent()
    {
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
    }

}
