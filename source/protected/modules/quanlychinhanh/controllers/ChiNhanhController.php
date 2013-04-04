<?php

class ChiNhanhController extends GxController
{
    public $defaultAction = 'danhsach';

    public function actionChiTiet($id) {
        $this->render('chitiet', array(
            'model' => $this->loadModel($id, 'ChiNhanh'),
        ));
    }


    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array(
                'allow',
                'actions'=>array('danhsach','chitiet','them','capnhat','xoa','xoagrid'),
                'users'=>array('@'),
            ),
            array('deny',
                'users'=>array('*')),
        );
    }

    public function actionThem() {
        $model = new ChiNhanh;

        if (isset($_POST['ChiNhanh'])) {
            $model->setAttributes($_POST['ChiNhanh']);
            // check exist in system
            $exist = ChiNhanh::model()->exists('ma_chi_nhanh=:ma_chi_nhanh',array(':ma_chi_nhanh'=>$model->ma_chi_nhanh));
            if(!$exist) {
                /*$relatedData = array(
                    'tblKhuyenMais' => $_POST['ChiNhanh']['tblKhuyenMais'] === '' ? null : $_POST['ChiNhanh']['tblKhuyenMais'],
                    'tblSanPhams' => $_POST['ChiNhanh']['tblSanPhams'] === '' ? null : $_POST['ChiNhanh']['tblSanPhams'],
                    'tblSanPhamTangs' => $_POST['ChiNhanh']['tblSanPhamTangs'] === '' ? null : $_POST['ChiNhanh']['tblSanPhamTangs'],
                );*/

                if ($model->save()) {
                    if (Yii::app()->getRequest()->getIsAjaxRequest())
                        Yii::app()->end();
                    else
                        $this->redirect(array('chitiet', 'id' => $model->id));
                }
            } else {
                Yii::app()->user->setFlash('dup-error',Yii::t('viLib','Data existed in sytem. Please try another one!'));
            }

        }

        $this->render('them', array( 'model' => $model));
    }

    public function actionCapNhat($id) {
        $model = $this->loadModel($id, 'ChiNhanh');
        if (isset($_POST['ChiNhanh'])) {
            $ma_chi_nhanh_old = $model->ma_chi_nhanh;
            $model->setAttributes($_POST['ChiNhanh']);
            // check exist in system
            $exist = ChiNhanh::model()->exists('ma_chi_nhanh=:ma_chi_nhanh',array(':ma_chi_nhanh'=>$model->ma_chi_nhanh));
                if(!$exist) {
                $relatedData = array(
                    //'tblKhuyenMais' => $_POST['ChiNhanh']['tblKhuyenMais'] === '' ? null : $_POST['ChiNhanh']['tblKhuyenMais'],
                    //'tblSanPhams' => $_POST['ChiNhanh']['tblSanPhams'] === '' ? null : $_POST['ChiNhanh']['tblSanPhams'],
                    //'tblSanPhamTangs' => $_POST['ChiNhanh']['tblSanPhamTangs'] === '' ? null : $_POST['ChiNhanh']['tblSanPhamTangs'],
                );
                    if ($model->save()) {
                        $this->redirect(array('chitiet', 'id' => $model->id));
                    }
            } else {
                // check ma_chi_nhanh_old and ma_chi_nhanh_new
                if($ma_chi_nhanh_old == $model->ma_chi_nhanh) {
                    if($model->save()) {
                        $this->redirect(array('chitiet', 'id' => $model->id));
                    }
                } else {
                    Yii::app()->user->setFlash('dup-error',Yii::t('viLib','Data existed in sytem. Please try another one!'));
                }
            }
        }
        $this->render('capnhat', array(
            'model' => $model,
        ));
    }



    public function actionXoaGrid($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $delModel = $this->loadModel($id, 'ChiNhanh');
            $idDel = $delModel->getAttribute('id');
            // kiem tra chi nhanh co chi nhanh con hay khong va chi nhanh do co nhan vien hay khong ?
            if(!ChiNhanh::hasChildBranchs($idDel)) {
                if(ChiNhanh::checkNoneRelative($idDel)) {
                    $delModel->delete();
                } else  {
                    echo 'Không thể xóa chi nhánh này vì chi nhánh đang chứa dữ liệu liên quan!';
                }

            } else {
                echo 'Không thể xóa chi nhánh này vì chi nhánh này đang có nhiều chi nhánh con!';
            }

           /* if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));*/
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionXoa($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $delModel = $this->loadModel($id, 'ChiNhanh');
            $idDel = $delModel->getAttribute('id');
            // kiem tra chi nhanh co chi nhanh con hay khong va chi nhanh do co nhan vien hay khong ?
            $message = '';
            $canDelete = true;
            if(!ChiNhanh::hasChildBranchs($idDel)) {
                if(ChiNhanh::checkNoneRelative($idDel)) {
                    $delModel->delete();
                } else  {
                    $message =  'Không thể xóa chi nhánh này vì chi nhánh đang chứa dữ liệu liên quan!';
                    $canDelete = false;
                }
            } else {
                $message = 'Không thể xóa chi nhánh này vì chi nhánh này đang có nhiều chi nhánh con!';
                $canDelete = false;
            }
            if($canDelete) {
                if (!Yii::app()->getRequest()->getIsAjaxRequest())
                     $this->redirect(array('danhsach'));
            } else  {
                Yii::app()->user->setFlash('del-error',$message);
                $this->render('chitiet', array(
                    'model' => $this->loadModel($id, 'ChiNhanh'),
                ));
            }

        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }



    public function actionDanhSach() {

        $model = new ChiNhanh('search');
        $model->unsetAttributes();
        if (isset($_GET['ChiNhanh']))
            $model->setAttributes($_GET['ChiNhanh']);

        $this->render('danhsach', array(
            'model' => $model,
        ));

    }

}