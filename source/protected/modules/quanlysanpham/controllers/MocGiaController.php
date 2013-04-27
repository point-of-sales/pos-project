<?php

class MocGiaController extends CPOSController {

    public $layout = '//layouts/column1';

    public function actionThem($spid) {
        $model = new MocGia;
        $model->setScenario('them');
        if (isset($_POST['MocGia']) && isset($spid)) {
            // kiem tra ngay thang hop le : ngay bat dau > ngay hien tai
            $_POST['MocGia']['san_pham_id'] = $spid;
            $result = $model->them($_POST['MocGia']);
            switch($result) {
                case 'ok': {
                    if (Yii::app()->getRequest()->getIsAjaxRequest())
                        Yii::app()->end();
                    else {
                            if(isset(Yii::app()->request->urlReferrer))
                                $this->redirect(array('sanPham/chitiet','id'=>$spid));
                            else
                                $this->redirect(array('sanPham/danhsach'));

                        }
                    break;
                }
                case 'dup-error': {
                    Yii::app()->user->setFlash('info-board',Yii::t('viLib','Data existed in sytem. Please try another one!'));
                    break;
                }
                case 'fail': {
                    // co the lam them canh bao cho nguoi dung
                    break;
                }
            }
        }
        $this->render('them', array( 'model' => $model,
            'spid'=>$spid,
        ));
    }

    public function actionCapNhat($id) {
        $model = $this->loadModel($id, 'MocGia');
        if (isset($_POST['MocGia'])) {
            $result = $model->capNhat($_POST['MocGia']);
            switch($result) {
                case 'ok': {
                    if(isset(Yii::app()->request->urlReferrer))
                        $this->redirect(array('sanPham/chitiet','id'=>$model->getAttribute('san_pham_id')));
                    else
                        $this->redirect(array('sanPham/danhsach'));
                    break;
                }
                case 'dup-error': {
                    Yii::app()->user->setFlash('info-board',Yii::t('viLib','Data existed in sytem. Please try another one!'));
                    break;
                }
                case 'fail': {
                    // co the lam them canh bao cho nguoi dung
                    break;
                }
            }
        }
        $this->render('capnhat', array( 'model' => $model));
    }

    public function actionXoaGrid($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $delModel = $this->loadModel($id, 'MocGia');
            $result = $delModel->xoa();
            switch($result) {
                case 'ok': {
                    break;
                }
                case 'rel-error': {
                    echo Yii::t('viLib','Can not delete this item because it contains relative data');
                    break;
                }
                case 'fail': {
                    echo Yii::t('viLib','Some errors occur in delete process. Please check your DBMS!');
                    break;
                }
            }
            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('danhsach'));
        } else
            throw new CHttpException(400, Yii::t('viLib', 'Your request is invalid.'));
    }

    public function actionXoa($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $delModel = $this->loadModel($id, 'MocGia');
            $message = '';
            $canDelete = true;
            $result = $delModel->xoa();
            switch($result) {
                case 'ok': {
                    break;
                }
                case 'rel-error': {
                    $message =  Yii::t('viLib','Can not delete this item because it contains relative data');
                    $canDelete = false;
                    break;
                }
                case 'fail': {
                    $message = Yii::t('viLib','Some errors occur in delete process. Please check your DBMS!');
                    $canDelete = false;
                    break;
                }
            }
            if($canDelete) {
                if (!Yii::app()->getRequest()->getIsAjaxRequest())
                    $this->redirect(array('danhsach'));
            } else  {
                Yii::app()->user->setFlash('info-board',$message);
                $this->redirect(array('chitiet', 'id' => $id));
            }
            /*if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('danhsach'));*/
        } else
            throw new CHttpException(400, Yii::t('viLib', 'Your request is invalid.'));
    }



    public function  actionXuat() {
        $model = new MocGia('search');
        $model->unsetAttributes();

        if(isset(Yii::app()->session['MocGia'])) {
            $model->setAttributes(Yii::app()->session['MocGia']);
            // Gan handler voi event
            $handler = new CPOSEventHandler();
            $model->onAfterExport = array($handler,'clearExportSession');
            $dataProvider = $model->xuatFileExcel();
            $this->render('xuat',array('dataProvider'=>$dataProvider));
        }
        $this->render('xuat',array('dataProvider'=>new CActiveDataProvider('MocGia')));
    }

}