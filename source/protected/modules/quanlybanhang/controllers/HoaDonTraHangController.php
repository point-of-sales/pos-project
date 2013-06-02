<?php

class HoaDonTraHangController extends CPOSController {


	public function actionChiTiet($id) {
        $model = $this->loadModel($id, 'HoaDonTraHang');
       
        $criteria = new CDbCriteria();
        $criteria->condition = 'hoa_don_tra_id=:hoa_don_tra_id';
        $criteria->params = array(':hoa_don_tra_id' => $id);
        $chiTietHangTraProvider = new CActiveDataProvider('ChiTietHoaDonTra', array('criteria' => $criteria));
        
        $criteria = new CDbCriteria();
        $hoa_don_ban_id = $model->hoa_don_ban_id;
        $criteria->condition = 'hoa_don_ban_id=:hoa_don_ban_id';
        $criteria->params = array(':hoa_don_ban_id' => $hoa_don_ban_id);
        $chiTietHangBanProvider = new CActiveDataProvider('ChiTietHoaDonBan', array('criteria' => $criteria));
       
		$this->render('chitiet', array(
			'model' => $model,
            'chiTietHangBanProvider' => $chiTietHangBanProvider,
            'chiTietHangTraProvider' => $chiTietHangTraProvider,
		));
	}

	public function actionThem($id) {
	   /*
		$model = new HoaDonTraHang;

		if (isset($_POST['HoaDonTraHang'])) {
            $result = $model->them($_POST['HoaDonTraHang']);
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
        */
	}

	public function actionCapNhat($id) {
		$model = $this->loadModel($id, 'HoaDonTraHang');


		if (isset($_POST['HoaDonTraHang'])) {
            $result = $model->capNhat($_POST['HoaDonTraHang']);
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
            $delModel = $this->loadModel($id, 'HoaDonTraHang');
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
            $delModel = $this->loadModel($id, 'HoaDonTraHang');
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

        $model = new HoaDonTraHang('search');
        $model->unsetAttributes();
        Yii::app()->CPOSSessionManager->clearKey('ExportData');
        if(isset($_GET['HoaDonTraHang'])) {
            // set vao session
            Yii::app()->CPOSSessionManager->setItem('ExportData',$_GET['HoaDonTraHang']);
            $model->setAttributes($_GET['HoaDonTraHang']);
        }
        $this->render('danhsach',array('model'=>$model));
    }

    public function  actionXuat() {
        $model = new HoaDonTraHang('search');
        $model->unsetAttributes();

        if(!Yii::app()->CPOSSessionManager->isEmpty('ExportData')) {
            $model->setAttributes(Yii::app()->CPOSSessionManager->getItem('ExportData'));
            $dataProvider = $model->xuatFileExcel();
            $this->render('xuat',array('dataProvider'=>$dataProvider));
        }
        $this->render('xuat',array('dataProvider'=>new CActiveDataProvider('HoaDonTraHang')));
    }


}