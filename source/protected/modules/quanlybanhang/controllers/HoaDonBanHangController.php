<?php

class HoaDonBanHangController extends GxController {
    public $layout = '//layouts/column2';

	public function actionChiTiet($id) {
		$this->render('chitiet', array(
			'model' => $this->loadModel($id, 'HoaDonBanHang'),
		));
	}

	public function actionThem() {
		$model = new HoaDonBanHang;

        /*if (isset($_POST['HoaDonBanHang'])) {
            $result = $model->them($_POST['HoaDonBanHang']);
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
		}*/
        $this->layout = '//layouts/column1';
		$this->render('them', array( 'model' => $model));
	}

	public function actionCapNhat($id) {
		$model = $this->loadModel($id, 'HoaDonBanHang');


		if (isset($_POST['HoaDonBanHang'])) {
            $result = $model->capNhat($_POST['HoaDonBanHang']);
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
            $delModel = $this->loadModel($id, 'HoaDonBanHang');
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
            $delModel = $this->loadModel($id, 'HoaDonBanHang');
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

        $model = new HoaDonBanHang('search');
        $model->unsetAttributes();

        if (isset($_GET['HoaDonBanHang']))
        $model->setAttributes($_GET['HoaDonBanHang']);

        $this->render('danhsach', array(
        'model' => $model,
        ));
	}

	public function actionAdmin() {
		$model = new HoaDonBanHang('search');
		$model->unsetAttributes();

		if (isset($_GET['HoaDonBanHang']))
			$model->setAttributes($_GET['HoaDonBanHang']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

    public function  actionXuat() {

        $model = new HoaDonBanHang('search');
        $model->unsetAttributes();
        if(isset($_GET['HoaDonBanHang'])) {
        $model->setAttributes($_GET['HoaDonBanHang']);
        $dataProvider = $model->search();
        }
        $this->render('xuat',array('dataProvider'=>$dataProvider));
    }
    
    public function actionGetSanPhamBan($ma_vach){
        $model = new SanPham('search');
        $model->unsetAttributes();
        if(isset($ma_vach)){
            $arr = array('ma_vach'=>$ma_vach);
            $model->setAttributes($arr);
            $this->render('them', array(
		  	   'model' => $model,
            ));
        }
        return false;
    }

}