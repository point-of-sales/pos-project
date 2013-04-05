<?php

class NhaCungCapController extends GxController {


	public function actionChiTiet($id) {
		$this->render('chitiet', array(
			'model' => $this->loadModel($id, 'NhaCungCap'),
		));
	}

	public function actionThem() {
		$model = new NhaCungCap;


		if (isset($_POST['NhaCungCap'])) {
			$model->setAttributes($_POST['NhaCungCap']);

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
		$model = $this->loadModel($id, 'NhaCungCap');


		if (isset($_POST['NhaCungCap'])) {
			$model->setAttributes($_POST['NhaCungCap']);

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
			$this->loadModel($id, 'NhaCungCap')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('danhsach'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionDanhSach() {

        $model = new NhaCungCap('search');
        $model->unsetAttributes();

        if (isset($_GET['NhaCungCap']))
        $model->setAttributes($_GET['NhaCungCap']);

        $this->render('danhsach', array(
        'model' => $model,
        ));
	}

	public function actionAdmin() {
		$model = new NhaCungCap('search');
		$model->unsetAttributes();

		if (isset($_GET['NhaCungCap']))
			$model->setAttributes($_GET['NhaCungCap']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}