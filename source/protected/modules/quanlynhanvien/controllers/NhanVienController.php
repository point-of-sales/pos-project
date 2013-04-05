<?php

class NhanVienController extends GxController {

    public $defaultAction = 'DanhSach';
	public function actionChiTiet($id) {
		$this->render('chitiet', array(
			'model' => $this->loadModel($id, 'NhanVien'),
		));
	}

	public function actionThem() {
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
					$this->redirect(array('chitiet', 'id' => $model->id));
			}
		}

		$this->render('them', array( 'model' => $model));
	}

	public function actionCapNhat($id) {
		$model = $this->loadModel($id, 'NhanVien');


		if (isset($_POST['NhanVien'])) {
			$model->setAttributes($_POST['NhanVien']);
			$relatedData = array(
				'tblQuyens' => $_POST['NhanVien']['tblQuyens'] === '' ? null : $_POST['NhanVien']['tblQuyens'],
				);

			if ($model->saveWithRelated($relatedData)) {
				$this->redirect(array('chitiet', 'id' => $model->id));
			}
		}

		$this->render('capnhat', array(
				'model' => $model,
				));
	}

	public function actionXoa($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'NhanVien')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('DanhSach'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('NhanVien');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionDanhSach() {
		$model = new NhanVien('search');
		$model->unsetAttributes();

		if (isset($_GET['NhanVien']))
			$model->setAttributes($_GET['NhanVien']);

		$this->render('danhsach', array(
			'model' => $model,
		));
	}
    public function actionAjaxActive($id){
        $model = $this->loadModel($id,'NhanVien');
        $model->trang_thai = ($model->trang_thai==0)?1:0;
        $model->save();
        echo $model->trang_thai;
    }
}