<?php

class ThongTinCongTyController extends CPOSController
{


    public function actionChiTiet($id)
    {
        if (Yii::app()->user->checkAccess('Quanlycauhinh.ThongTinCongTy.ChiTiet')) {
            $this->render('chitiet', array(
                'model' => $this->loadModel($id, 'ThongTinCongTy'),
            ));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionThem()
    {
        if (Yii::app()->user->checkAccess('Quanlycauhinh.ThongTinCongTy.Them')) {
            $model = new ThongTinCongTy;

            if (isset($_POST['ThongTinCongTy'])) {
                $result = $model->them($_POST['ThongTinCongTy']);
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

        if (Yii::app()->user->checkAccess('Quanlycauhinh.ThongTinCongTy.CapNhat')) {
            $model = $this->loadModel($id, 'ThongTinCongTy');
            if (isset($_POST['ThongTinCongTy'])) {
                $result = $model->capNhat($_POST['ThongTinCongTy']);
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
        if (Yii::app()->user->checkAccess('Quanlycauhinh.ThongTinCongTy.DanhSach')) {
            $model = new ThongTinCongTy('search');
            $model->unsetAttributes();
            Yii::app()->CPOSSessionManager->clearKey('ExportData');
            if (isset($_GET['ThongTinCongTy'])) {
                // set vao session
                Yii::app()->CPOSSessionManager->setItem('ExportData', $_GET['ThongTinCongTy']);
                $model->setAttributes($_GET['ThongTinCongTy']);
            }
            $this->render('danhsach', array('model' => $model));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }


}