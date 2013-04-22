<?php

class ChungTuController extends CPOSController
{


    public function actionChiTiet($id)
    {
        $this->render('chitiet', array(
            'model' => $this->loadModel($id, 'ChungTu'),
        ));
    }

    public function actionThemPhieuNhap()
    {
        $this->layout = '//layouts/column1';
        $model = new ChungTu;
        $model->phieuNhap = new PhieuNhap();

        //$model->phieuNhap->tblSanPhams = new
        if (isset($_POST['ChungTu'])) {
            $_POST['ChungTu']['id'] = 999;
            $model->phieuNhap->setAttribute('chi_nhanh_xuat_id','dasdsa');
            $model->phieuNhap->tblSanPhams = new ChiTietPhieuNhap();
            $model->phieuNhap->tblSanPhams->setAttribute('san_pham_id','BKBH003');
            $model->phieuNhap->tblSanPhams->setAttribute('phieu_nhap_id',$_POST['ChungTu']['id']);
            $result = $model->them($_POST['ChungTu']);
            //$model->phieuNhap->them()
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
        $this->render('themphieunhap', array('model' => $model));
    }

    public function actionThemPhieuXuat()
    {
        $model = new ChungTu;

        if (isset($_POST['ChungTu'])) {
            $result = $model->them($_POST['ChungTu']);
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
    }

    public function actionCapNhat($id)
    {
        $model = $this->loadModel($id, 'ChungTu');


        if (isset($_POST['ChungTu'])) {
            $result = $model->capNhat($_POST['ChungTu']);
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
            $delModel = $this->loadModel($id, 'ChungTu');
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
            $delModel = $this->loadModel($id, 'ChungTu');
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

        $model = new ChungTu('search');
        $model->unsetAttributes();

        if (isset($_GET['ChungTu'])) {
            // set vao session
            Yii::app()->session['ChungTu'] = $_GET['ChungTu'];
            $model->setAttributes($_GET['ChungTu']);
        }
        $this->render('danhsach', array('model' => $model));
    }

    public function  actionXuat()
    {
        $model = new ChungTu('search');
        $model->unsetAttributes();

        if (isset(Yii::app()->session['ChungTu'])) {
            $model->setAttributes(Yii::app()->session['ChungTu']);
            // Gan handler voi event
            $handler = new CPOSEventHandler();
            $model->onAfterExport = array($handler, 'clearExportSession');
            $dataProvider = $model->xuatFileExcel();
            $this->render('xuat', array('dataProvider' => $dataProvider));
        }
        $this->render('xuat', array('dataProvider' => new CActiveDataProvider('ChungTu')));
    }


}