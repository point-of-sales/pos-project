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
                'actions'=>array('danhsach','chitiet','them','capnhat','xoa'),
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
            $relatedData = array(
                //'tblKhuyenMais' => $_POST['ChiNhanh']['tblKhuyenMais'] === '' ? null : $_POST['ChiNhanh']['tblKhuyenMais'],
                //'tblSanPhams' => $_POST['ChiNhanh']['tblSanPhams'] === '' ? null : $_POST['ChiNhanh']['tblSanPhams'],
                //'tblSanPhamTangs' => $_POST['ChiNhanh']['tblSanPhamTangs'] === '' ? null : $_POST['ChiNhanh']['tblSanPhamTangs'],
            );

            if ($model->save()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else
                    $this->redirect(array('chitiet', 'id' => $model->id));
            }
        }

        $this->render('them', array( 'model' => $model));
    }

    public function actionCapNhat($id) {
        $model = $this->loadModel($id, 'ChiNhanh');
        if (isset($_POST['ChiNhanh'])) {
            $model->setAttributes($_POST['ChiNhanh']);
            $relatedData = array(
                //'tblKhuyenMais' => $_POST['ChiNhanh']['tblKhuyenMais'] === '' ? null : $_POST['ChiNhanh']['tblKhuyenMais'],
                //'tblSanPhams' => $_POST['ChiNhanh']['tblSanPhams'] === '' ? null : $_POST['ChiNhanh']['tblSanPhams'],
                //'tblSanPhamTangs' => $_POST['ChiNhanh']['tblSanPhamTangs'] === '' ? null : $_POST['ChiNhanh']['tblSanPhamTangs'],
            );

            if ($model->save()) {
                $this->redirect(array('chitiet', 'id' => $model->id));
            }
        }

        $this->render('capnhat', array(
            'model' => $model,
        ));
    }

    public function actionXoa($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {

            $delModel = $this->loadModel($id, 'ChiNhanh');
            if(!$delModel->hasChildBranchs()) {

                //$delModel->delete();
            } else {
                echo "xxxx";
                Yii::app()->user->setFlash('del-error','Không thể xóa chi nhánh này vì chi nhánh này đang có nhiều chi nhánh con!');
            }

           /* if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));*/
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