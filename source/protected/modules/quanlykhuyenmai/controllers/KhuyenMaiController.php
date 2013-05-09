<?php

class KhuyenMaiController extends CPOSController {


	public function actionChiTiet($id) {

        $model = $this->loadModel($id, 'KhuyenMai');
        $danhSachChiNhanh = $model->tblChiNhanhs;
		$this->render('chitiet', array(
			'model' => $model,
		));
	}

	public function actionThem() {
		$model = new KhuyenMai;

		if (isset($_POST['KhuyenMai'])) {
            $result = $model->them($_POST['KhuyenMai']);
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
		$model = $this->loadModel($id, 'KhuyenMai');


		if (isset($_POST['KhuyenMai'])) {
            $result = $model->capNhat($_POST['KhuyenMai']);
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
            $delModel = $this->loadModel($id, 'KhuyenMai');
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
            $delModel = $this->loadModel($id, 'KhuyenMai');
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

        $model = new KhuyenMai('search');
        $model->unsetAttributes();
        Yii::app()->CPOSSessionManager->clearKey('ExportData');
        if(isset($_GET['KhuyenMai'])) {
            // set vao session
            Yii::app()->CPOSSessionManager->setItem('ExportData',$_GET['KhuyenMai']);
            $model->setAttributes($_GET['KhuyenMai']);
            $model->search();
        }
        $this->render('danhsach',array('model'=>$model));
    }

    public function  actionXuat() {
        $model = new KhuyenMai('search');
        $model->unsetAttributes();

        if(!Yii::app()->CPOSSessionManager->isEmpty('ExportData')) {
            $model->setAttributes(Yii::app()->CPOSSessionManager->getItem('ExportData'));
            $dataProvider = $model->xuatFileExcel();
            $this->render('xuat',array('dataProvider'=>$dataProvider));
        }
        $this->render('xuat',array('dataProvider'=>new CActiveDataProvider('KhuyenMai')));
    }

    public function actionKhuyenMaiChiNhanh() {
        $chiNhanhProvider = new CActiveDataProvider('ChiNhanh');
        $this->render('khuyenmaichinhanh',array('chiNhanhProvider'=>$chiNhanhProvider));
    }

    public function actionKhuyenMaiSanPham() {
        $criteria = new CDbCriteria();
//       / $criteria->with = ''

        $sanPhamProvider = new CActiveDataProvider('SanPham');
        $this->render('khuyenmaisanpham',array('sanPhamProvider'=>$sanPhamProvider));
    }


}