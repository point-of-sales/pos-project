<?php

class ChiNhanhController extends CPOSController
{


    public function actionChiTiet($id)
    {
        if (Yii::app()->user->checkAccess('Quanlynhapxuat.ChiNhanh.ChiTiet')) {
            $this->render('chitiet', array(
                'model' => $this->loadModel($id, 'ChiNhanh'),
            ));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionDanhSach()
    {
        if (Yii::app()->user->checkAccess('Quanlynhapxuat.ChiNhanh.DanhSach')) {
            $model = new ChiNhanh('search');
            $model->unsetAttributes();
            Yii::app()->CPOSSessionManager->clearKey('ExportData');
            if (isset($_GET['ChiNhanh'])) {
                // set vao session
                Yii::app()->CPOSSessionManager->setItem('ExportData', $_GET['ChiNhanh']);
                $model->setAttributes($_GET['ChiNhanh']);
            }
            $this->render('danhsach', array('model' => $model));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function  actionXuat()
    {
        if (Yii::app()->user->checkAccess('Quanlynhapxuat.ChiNhanh.Xuat')) {
            $model = new ChiNhanh('search');
            $model->unsetAttributes();
            if (!Yii::app()->CPOSSessionManager->isEmpty('ExportData')) {
                $dk = Yii::app()->CPOSSessionManager->getItem('ExportData');
                $model->setAttributes($dk[0]);
                $dataProvider = $model->xuatFileExcel();
                $this->render('xuat', array('dataProvider' => $dataProvider));
            }
            $this->render('xuat', array('dataProvider' => new CActiveDataProvider('ChiNhanh')));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

}