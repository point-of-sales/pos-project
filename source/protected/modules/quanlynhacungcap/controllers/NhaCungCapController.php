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
            $result = $model->them($_POST['NhaCungCap']);
            switch($result) {
                case 'ok': {
                    if (Yii::app()->getRequest()->getIsAjaxRequest())
                        Yii::app()->end();
                    else
                        $this->redirect(array('chitiet', 'id' => $model->id));
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
		$this->render('them', array( 'model' => $model));
	}

	public function actionCapNhat($id) {
		$model = $this->loadModel($id, 'NhaCungCap');


		if (isset($_POST['NhaCungCap'])) {
            $result = $model->capNhat($_POST['NhaCungCap']);
            switch($result) {
                case 'ok': {
                    $this->redirect(array('chitiet', 'id' => $id));
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
            $delModel = $this->loadModel($id, 'NhaCungCap');
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
            $delModel = $this->loadModel($id, 'NhaCungCap');
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

    public function  actionXuat() {

        $model = new NhaCungCap('search');
        $model->unsetAttributes();
        if(isset($_GET['NhaCungCap'])) {
        $model->setAttributes($_GET['NhaCungCap']);
        $dataProvider = $model->search();
        }
        $this->render('xuat',array('dataProvider'=>$dataProvider));
    }

}