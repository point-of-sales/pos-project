<?php

class NhanVienController extends GxController {

<<<<<<< HEAD

=======
    public $defaultAction = 'DanhSach';
>>>>>>> cc04ae6b14d1e9954bc50c540b31af7101184802
	public function actionChiTiet($id) {
		$this->render('chitiet', array(
			'model' => $this->loadModel($id, 'NhanVien'),
		));
	}

	public function actionThem() {
		$model = new NhanVien;

		if (isset($_POST['NhanVien'])) {
<<<<<<< HEAD
            $result = $model->them($_POST['NhanVien']);
            switch($result) {
                case 'ok': {
                    if (Yii::app()->getRequest()->getIsAjaxRequest())
                        Yii::app()->end();
                    else
                        $this->redirect(array('chitiet', 'id' => $model->id));
                    break;
                }
            case 'dup-error': {
                    Yii::app()->user->setFlash('dup-error',Yii::t('viLib','Data existed in sytem. Please try another one!'));
                    break;
            }
            case 'fail': {
                    // co the lam them canh bao cho nguoi dung
                    }
            }
		}
=======
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

>>>>>>> cc04ae6b14d1e9954bc50c540b31af7101184802
		$this->render('them', array( 'model' => $model));
	}

	public function actionCapNhat($id) {
		$model = $this->loadModel($id, 'NhanVien');


		if (isset($_POST['NhanVien'])) {
<<<<<<< HEAD
            $result = $model->capNhat($_POST['NhanVien']);
            switch($result) {
                case 'ok': {
                    $this->redirect(array('chitiet', 'id' => $id));
                    break;
                }
                case 'dup-error': {
                    Yii::app()->user->setFlash('dup-error',Yii::t('viLib','Data existed in sytem. Please try another one!'));
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
            $delModel = $this->loadModel($id, 'NhanVien');
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
        throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

	public function actionXoa($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
            $delModel = $this->loadModel($id, 'NhanVien');
            $message = '';
            $canDelete = true;
            $result = $delModel->xoa();
                switch($result) {
                    case 'ok': {
                        break;
                    }
                    case 'rel-error': {
                        $message =  Yii::t('viLib','Can not delete this item because it contains relative data');
                        $canDelete = false;$this->loadModel($id, 'ChiNhanh');
                        break;
                    }
                    case 'fail': {
                        $message = Yii::t('viLib','Some errors occur in delete process. Please check your DBMS!');
                        break;
                    }
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
			/*if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('danhsach'));*/
=======
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
>>>>>>> cc04ae6b14d1e9954bc50c540b31af7101184802
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
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