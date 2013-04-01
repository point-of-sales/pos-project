<?php

class ChinhanhController extends GxController
{
    public function actionView($id) {
        $this->render('view', array(
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
                'actions'=>array('index','view','them','update','delete','admin'),
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

            if ($model->saveWithRelated($relatedData)) {
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else
                    $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('them', array( 'model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id, 'ChiNhanh');


        if (isset($_POST['ChiNhanh'])) {
            $model->setAttributes($_POST['ChiNhanh']);
            $relatedData = array(
                'tblKhuyenMais' => $_POST['ChiNhanh']['tblKhuyenMais'] === '' ? null : $_POST['ChiNhanh']['tblKhuyenMais'],
                'tblSanPhams' => $_POST['ChiNhanh']['tblSanPhams'] === '' ? null : $_POST['ChiNhanh']['tblSanPhams'],
                'tblSanPhamTangs' => $_POST['ChiNhanh']['tblSanPhamTangs'] === '' ? null : $_POST['ChiNhanh']['tblSanPhamTangs'],
            );

            if ($model->saveWithRelated($relatedData)) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'ChiNhanh')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('ChiNhanh');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new ChiNhanh('search');
        //print_r($model);exit;
        $model->unsetAttributes();
        if (isset($_GET['ChiNhanh']))
            $model->setAttributes($_GET['ChiNhanh']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

}