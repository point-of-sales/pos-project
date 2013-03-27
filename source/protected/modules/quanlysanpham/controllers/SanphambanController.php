<?php

class SanphambanController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'SanPhamBan'),
		));
	}

	public function actionCreate() {
		$model = new SanPhamBan;


		if (isset($_POST['SanPhamBan'])) {
			$model->setAttributes($_POST['SanPhamBan']);
			$relatedData = array(
				'tblHoaDonBanHangs' => $_POST['SanPhamBan']['tblHoaDonBanHangs'] === '' ? null : $_POST['SanPhamBan']['tblHoaDonBanHangs'],
				'tblHoaDonTraHangs' => $_POST['SanPhamBan']['tblHoaDonTraHangs'] === '' ? null : $_POST['SanPhamBan']['tblHoaDonTraHangs'],
				'tblPhieuNhaps' => $_POST['SanPhamBan']['tblPhieuNhaps'] === '' ? null : $_POST['SanPhamBan']['tblPhieuNhaps'],
				'tblPhieuXuats' => $_POST['SanPhamBan']['tblPhieuXuats'] === '' ? null : $_POST['SanPhamBan']['tblPhieuXuats'],
				'tblChiNhanhs' => $_POST['SanPhamBan']['tblChiNhanhs'] === '' ? null : $_POST['SanPhamBan']['tblChiNhanhs'],
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
		$model = $this->loadModel($id, 'SanPhamBan');


		if (isset($_POST['SanPhamBan'])) {
			$model->setAttributes($_POST['SanPhamBan']);
			$relatedData = array(
				'tblHoaDonBanHangs' => $_POST['SanPhamBan']['tblHoaDonBanHangs'] === '' ? null : $_POST['SanPhamBan']['tblHoaDonBanHangs'],
				'tblHoaDonTraHangs' => $_POST['SanPhamBan']['tblHoaDonTraHangs'] === '' ? null : $_POST['SanPhamBan']['tblHoaDonTraHangs'],
				'tblPhieuNhaps' => $_POST['SanPhamBan']['tblPhieuNhaps'] === '' ? null : $_POST['SanPhamBan']['tblPhieuNhaps'],
				'tblPhieuXuats' => $_POST['SanPhamBan']['tblPhieuXuats'] === '' ? null : $_POST['SanPhamBan']['tblPhieuXuats'],
				'tblChiNhanhs' => $_POST['SanPhamBan']['tblChiNhanhs'] === '' ? null : $_POST['SanPhamBan']['tblChiNhanhs'],
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
			$this->loadModel($id, 'SanPhamBan')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('SanPhamBan');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new SanPhamBan('search');
		$model->unsetAttributes();

		if (isset($_GET['SanPhamBan']))
			$model->setAttributes($_GET['SanPhamBan']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}