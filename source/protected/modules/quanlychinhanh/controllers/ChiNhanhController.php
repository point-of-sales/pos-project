<?php

class ChiNhanhController extends CPOSController
{


    public function actionChiTiet($id)
    {
        if (Yii::app()->user->checkAccess('Quanlychinhanh.ChiNhanh.ChiTiet')) {
            $this->render('chitiet', array(
                'model' => $this->loadModel($id, 'ChiNhanh'),
            ));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionThem()
    {
        if (Yii::app()->user->checkAccess('Quanlychinhanh.ChiNhanh.Them')) {
            $model = new ChiNhanh;

            if (isset($_POST['ChiNhanh'])) {
                $result = $model->them($_POST['ChiNhanh']);
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
        if (Yii::app()->user->checkAccess('Quanlychinhanh.ChiNhanh.CapNhat')) {

            if (!isset($id) || !is_numeric($id) || $id < 1) {
                throw new CHttpException(400, Yii::t('viLib', 'Your request is invalid.'));
                exit;
            }
            $model = $this->loadModel($id, 'ChiNhanh');
            if (isset($_POST['ChiNhanh'])) {
                $result = $model->capNhat($_POST['ChiNhanh']);
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
        if (Yii::app()->user->checkAccess('Quanlychinhanh.ChiNhanh.XoaGrid')) {

            if (Yii::app()->getRequest()->getIsPostRequest()) {
                $delModel = $this->loadModel($id, 'ChiNhanh');
                if (!$delModel->coChiNhanhCon()) {
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
                } else
                    echo Yii::t('viLib', 'Can not delete this branch because it contains sub-branchs');
                if (!Yii::app()->getRequest()->getIsAjaxRequest())
                    $this->redirect(array('danhsach'));
            } else
                throw new CHttpException(400, Yii::t('viLib', 'Your request is invalid.'));
        } else

            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionXoa($id)
    {
        if (Yii::app()->user->checkAccess('Quanlychinhanh.ChiNhanh.Xoa')) {
            if (Yii::app()->getRequest()->getIsPostRequest()) {
                $delModel = $this->loadModel($id, 'ChiNhanh');
                $message = '';
                $canDelete = true;
                if (!$delModel->coChiNhanhCon()) {
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
                            $this->loadModel($id, 'ChiNhanh');
                            break;
                        }
                        case 'fail':
                        {
                            $message = Yii::t('viLib', 'Some errors occur in delete process. Please check your DBMS!');
                            $canDelete = false;
                            break;
                        }
                    }
                } else {
                    $message = Yii::t('viLib', 'Can not delete this branch because it contains sub-branchs');
                    $canDelete = false;
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
        if (Yii::app()->user->checkAccess('Quanlychinhanh.ChiNhanh.DanhSach')) {
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
        if (Yii::app()->user->checkAccess('Quanlychinhanh.ChiNhanh.Xuat')) {
            $model = new ChiNhanh('search');
            $model->unsetAttributes();
            if (!Yii::app()->CPOSSessionManager->isEmpty('ExportData')) {
                $model->setAttributes(Yii::app()->CPOSSessionManager->getItem('ExportData'));
                $dataProvider = $model->xuatFileExcel();
                $this->render('xuat', array('dataProvider' => $dataProvider));
            }
            $this->render('xuat', array('dataProvider' => new CActiveDataProvider('ChiNhanh')));
        } else

            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionAjaxActiveStatusProduct($cnid, $spid)
    {
        if (Yii::app()->user->checkAccess('Quanlychinhanh.ChiNhanh.AjaxActiveStatusProduct')) {
            if (Yii::app()->request->isAjaxRequest) {
                if (isset($cnid) && isset($spid)) {
                    $sanPhamChiNhanh = $this->loadModel(array('san_pham_id' => $spid, 'chi_nhanh_id' => $cnid), 'SanPhamChiNhanh');
                    if ($sanPhamChiNhanh->trang_thai == '')
                        $sanPhamChiNhanh->trang_thai = 1;
                    else {
                        $sanPhamChiNhanh->trang_thai = ($sanPhamChiNhanh->trang_thai) ? 0 : 1;
                    }
                    if ($sanPhamChiNhanh->save(false))
                        echo 'ok';
                }
            } else
                throw new CHttpException(404, 'Page not found');
        } else

            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }



    public function actionAjaxActiveStatusGiftProduct($cnid, $spid){

        if (Yii::app()->user->checkAccess('Quanlychinhanh.ChiNhanh.AjaxActiveStatusGiftProduct')) {
          //  if (Yii::app()->request->isAjaxRequest) {
                if (isset($cnid) && isset($spid)) {
                    $sanPhamTangChiNhanh = $this->loadModel(array('san_pham_tang_id' => $spid, 'chi_nhanh_id' => $cnid), 'SanPhamTangChiNhanh');
                    if ($sanPhamTangChiNhanh->trang_thai == '')
                        $sanPhamTangChiNhanh->trang_thai = 1;
                    else {
                        $sanPhamTangChiNhanh->trang_thai = ($sanPhamTangChiNhanh->trang_thai) ? 0 : 1;
                    }
                    if ($sanPhamTangChiNhanh->save(false))
                        echo 'ok';
                }
           /* } else
                throw new CHttpException(404, 'Page not found');*/
        } else

            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

}