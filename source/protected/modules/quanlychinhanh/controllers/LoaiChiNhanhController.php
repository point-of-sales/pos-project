<?php

class LoaiChiNhanhController extends GxController {


	public function actionChiTiet($id) {
		$this->render('chitiet', array(
			'model' => $this->loadModel($id, 'LoaiChiNhanh'),
		));
	}

	public function actionThem() {
		$model = new LoaiChiNhanh;

		if (isset($_POST['LoaiChiNhanh'])) {
            $result = $model->them($_POST['LoaiChiNhanh']);
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
		$model = $this->loadModel($id, 'LoaiChiNhanh');


		if (isset($_POST['LoaiChiNhanh'])) {
            $result = $model->capNhat($_POST['LoaiChiNhanh']);
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
            $delModel = $this->loadModel($id, 'LoaiChiNhanh');
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
            $delModel = $this->loadModel($id, 'LoaiChiNhanh');
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

        $model = new LoaiChiNhanh('search');
        $model->unsetAttributes();
        if(isset($_GET['LoaiChiNhanh'])) {
            // set vao session
            Yii::app()->session['LoaiChiNhanh'] = $_GET['LoaiChiNhanh'];
            $model->setAttributes($_GET['LoaiChiNhanh']);
        }
        $this->render('danhsach',array('model'=>$model));
    }

    public function  actionXuat() {
        $model = new LoaiChiNhanh('search');
        $model->unsetAttributes();

        if(isset(Yii::app()->session['LoaiChiNhanh'])) {
            $model->setAttributes(Yii::app()->session['LoaiChiNhanh']);
            // Gan handler voi event
            $handler = new CPOSEventHandler();
            $model->onAfterExport = array($handler,'clearExportSession');
            $dataProvider = $model->xuatFileExcel();
            $this->render('xuat',array('dataProvider'=>$dataProvider));
        }
        $this->render('xuat',array('dataProvider'=>new CActiveDataProvider('LoaiChiNhanh')));
    }
}