<?php

class ChiNhanhController extends GxController
{


    public function actionChiTiet($id)
    {
        $this->render('chitiet', array(
            'model' => $this->loadModel($id, 'ChiNhanh'),
        ));
    }

    public function actionThem()
    {
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
    }

    public function actionCapNhat($id)
    {
        if(!isset($id) || !is_numeric($id) || $id<1) {
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
    }

    public function actionXoaGrid($id)
    {
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
    }

    public function actionXoa($id)
    {
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
    }

    public function actionDanhSach()
    {
        $model = new ChiNhanh('search');
        $model->unsetAttributes();

        if (isset($_GET['ChiNhanh']))
            $model->setAttributes($_GET['ChiNhanh']);

        $this->render('danhsach', array(
            'model' => $model,
        ));
    }


    public function  actionXuat() {
        $model = new ChiNhanh('search');
        $model->unsetAttributes();
        if(isset($_GET['ChiNhanh'])) {
            $model->setAttributes($_GET['ChiNhanh']);
            $dataProvider = $model->search();
        }
        $this->render('xuat',array('dataProvider'=>$dataProvider));
    }


}