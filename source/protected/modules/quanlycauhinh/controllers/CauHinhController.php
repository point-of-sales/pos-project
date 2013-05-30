<?php

class CauHinhController extends CPOSController
{


    public function actionChiTiet($id)
    {
        if (Yii::app()->user->checkAccess('Quanlycauhinh.CauHinh.ChiTiet')) {
            $this->render('chitiet', array(
                'model' => $this->loadModel($id, 'CauHinh'),
            ));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionThem()
    {
        if (Yii::app()->user->checkAccess('Quanlycauhinh.CauHinh.Them')) {
            $model = new CauHinh;

            if (isset($_POST['CauHinh'])) {
                $result = $model->them($_POST['CauHinh']);
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
        if (Yii::app()->user->checkAccess('Quanlycauhinh.CauHinh.CapNhat')) {

            $model = $this->loadModel($id, 'CauHinh');


            if (isset($_POST['CauHinh'])) {
                $result = $model->capNhat($_POST['CauHinh']);
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

    public function actionDanhSach()
    {
        if (Yii::app()->user->checkAccess('Quanlycauhinh.CauHinh.DanhSach')) {
            $model = new CauHinh('search');
            $model->unsetAttributes();
            Yii::app()->CPOSSessionManager->clearKey('ExportData');
            if (isset($_GET['CauHinh'])) {
                // set vao session
                Yii::app()->CPOSSessionManager->setItem('ExportData', $_GET['CauHinh']);
                $model->setAttributes($_GET['CauHinh']);
            }
            $this->render('danhsach', array('model' => $model));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }


}