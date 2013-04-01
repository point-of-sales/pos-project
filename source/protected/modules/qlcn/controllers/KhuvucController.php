<?php

class KhuvucController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'KhuVuc'),
		));
	}

	public function actionCreate() {

        $khuVuc = new KhuVuc;
        if(isset($_POST['KhuVuc'])) {
            $khuVuc->setAttributes($_POST['KhuVuc']);
            $exist = KhuVuc::model()->exists('ma_khu_vuc=:ma_khu_vuc',array(':ma_khu_vuc'=>$_POST['KhuVuc']['ma_khu_vuc']));
            if(!$exist) {
                if($khuVuc->save()) {
                    Yii::app()->user->setFlash('success','Thêm mới thành công!');
                }
            } else {
                Yii::app()->user->setFlash('error-duplicate','Khu vực này đã tồn tại trong hệ thống. Xin vui lòng chọn một khu vực khác!');
            }
        }
        $this->render('create',array(
            'model'=>$khuVuc,
        ));


	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'KhuVuc');


		if (isset($_POST['KhuVuc'])) {
			$model->setAttributes($_POST['KhuVuc']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'KhuVuc')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('KhuVuc');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new KhuVuc('search');
		$model->unsetAttributes();

		if (isset($_GET['KhuVuc']))
			$model->setAttributes($_GET['KhuVuc']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}