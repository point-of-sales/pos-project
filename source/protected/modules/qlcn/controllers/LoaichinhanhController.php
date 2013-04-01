<?php

class LoaichinhanhController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'LoaiChiNhanh'),
		));
	}

	public function actionCreate() {
        $loaiChiNhanh = new LoaiChiNhanh;
        if(isset($_POST['LoaiChiNhanh'])) {
            $loaiChiNhanh->setAttributes($_POST['LoaiChiNhanh']);
            //check unique

            $exist = LoaiChiNhanh::model()->exists('ma_loai_chi_nhanh=:ma_loai_chi_nhanh',array(':ma_loai_chi_nhanh'=>$_POST['LoaiChiNhanh']['ma_loai_chi_nhanh']));
            if(!$exist) {
                if($loaiChiNhanh->save()) {
                    Yii::app()->user->setFlash('success','Thêm mới thành công!');
                }
            } else {
                Yii::app()->user->setFlash('error-duplicate','Loại chi nhánh này đã tồn tại trong hệ thống. Xin vui lòng chọn một chi nhánh khác!');
            }
        }
        $this->render('create',array(
            'model'=>$loaiChiNhanh,
        ));

	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'LoaiChiNhanh');


		if (isset($_POST['LoaiChiNhanh'])) {
			$model->setAttributes($_POST['LoaiChiNhanh']);

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
			$this->loadModel($id, 'LoaiChiNhanh')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('LoaiChiNhanh');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new LoaiChiNhanh('search');
		$model->unsetAttributes();

		if (isset($_GET['LoaiChiNhanh']))
			$model->setAttributes($_GET['LoaiChiNhanh']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}