<?php

class KhuVucController extends CPOSController {


	public function actionChiTiet($id) {
		$this->render('chitiet', array(
			'model' => $this->loadModel($id, 'KhuVuc'),
		));
	}

	public function actionThem() {

        if(empty(Yii::app()->session['url'])) {
            $longUrl = Yii::app()->request->urlReferrer;
            $shortUrl = Helpers::getShortURL($longUrl);
            Yii::app()->session['url'] = $shortUrl;
        }
		$model = new KhuVuc;
		if (isset($_POST['KhuVuc'])) {
            $result = $model->them($_POST['KhuVuc']);
            switch($result) {
                case 'ok': {
                    if (Yii::app()->getRequest()->getIsAjaxRequest())
                        Yii::app()->end();
                    else {
                        $url = array();
                        if(isset(Yii::app()->session['url'])) {
                            $url = Yii::app()->session['url'];
                            unset(Yii::app()->session['url']);
                        }
                        if(Helpers::getControllerFromShortUrl($url[0])=='KhuVuc') {
                            $this->redirect($url);
                        }
                        else {
                            $this->redirect(array('chitiet', 'id' => $model->id));
                        }
                    }
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
		$model = $this->loadModel($id, 'KhuVuc');
		if (isset($_POST['KhuVuc'])) {
            $result = $model->capNhat($_POST['KhuVuc']);
            switch($result) {
                case 'ok': {
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
		$this->render('capnhat', array( 'model' => $model));
	}

    public function actionXoaGrid($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $delModel = $this->loadModel($id, 'KhuVuc');
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
            $delModel = $this->loadModel($id, 'KhuVuc');
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

        $model = new KhuVuc('search');
        $model->unsetAttributes();
        if(isset($_GET['KhuVuc'])) {
            // set vao session
            Yii::app()->session['KhuVuc'] = $_GET['KhuVuc'];
            $model->setAttributes($_GET['KhuVuc']);
        }
        $this->render('danhsach',array('model'=>$model));
    }

    public function  actionXuat() {
        $model = new KhuVuc('search');
        $model->unsetAttributes();

        if(isset(Yii::app()->session['KhuVuc'])) {
            $model->setAttributes(Yii::app()->session['KhuVuc']);
            // Gan handler voi event
            $handler = new CPOSEventHandler();
            $model->onAfterExport = array($handler,'clearExportSession');
            $dataProvider = $model->xuatFileExcel();
            $this->render('xuat',array('dataProvider'=>$dataProvider));
        }
        $this->render('xuat',array('dataProvider'=>new CActiveDataProvider('KhuVuc')));
    }

}