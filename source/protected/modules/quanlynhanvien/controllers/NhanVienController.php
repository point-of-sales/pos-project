<?php

class NhanVienController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'NhanVien'),
		));
	}

	public function actionCreate() {
		$model = new NhanVien;


		if (isset($_POST['NhanVien'])) {
			$model->setAttributes($_POST['NhanVien']);
			$relatedData = array(
				'tblQuyens' => $_POST['NhanVien']['tblQuyens'] === '' ? null : $_POST['NhanVien']['tblQuyens'],
				);

			if ($model->saveWithRelated($relatedData)) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'NhanVien');


		if (isset($_POST['NhanVien'])) {
			$model->setAttributes($_POST['NhanVien']);
			$relatedData = array(
				'tblQuyens' => $_POST['NhanVien']['tblQuyens'] === '' ? null : $_POST['NhanVien']['tblQuyens'],
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
			$this->loadModel($id, 'NhanVien')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('NhanVien');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new NhanVien('search');
		$model->unsetAttributes();

		if (isset($_GET['NhanVien']))
			$model->setAttributes($_GET['NhanVien']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}