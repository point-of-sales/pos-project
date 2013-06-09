<?php

class KhachHangController extends CPOSController
{


    public function actionChiTiet($id)
    {
        if (Yii::app()->user->checkAccess('Quanlykhachhang.KhachHang.ChiTiet')) {
            
            //hoa don ban hang
            $criteria = new CDbCriteria();
            $criteria->condition = 'khach_hang_id=:khach_hang_id';
            $criteria->params = array(':khach_hang_id' => $id);
            $hoaDonBan = new CActiveDataProvider('HoaDonBanHang', array('criteria' => $criteria));
            
            $this->render('chitiet', array(
                'model' => $this->loadModel($id, 'KhachHang'),
                'hoa_don_ban' => $hoaDonBan,
            ));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionThem()
    {
        if (Yii::app()->user->checkAccess('Quanlykhachhang.KhachHang.Them')) {
            $model = new KhachHang;

            if (isset($_POST['KhachHang'])) {
                $result = $model->them($_POST['KhachHang']);
                switch ($result) {
                    case 'ok':
                    {
                        if (Yii::app()->getRequest()->getIsAjaxRequest())
                            Yii::app()->end();
                        else
                            $this->redirect(array('chitiet', 'id' => $model->id));
                        break;
                    }
                    case 'dup-error':
                    {
                        Yii::app()->user->setFlash('info-board', Yii::t('viLib', 'Data existed in sytem. Please try another one!'));
                        break;
                    }
                    case 'fail':
                    {
                        // co the lam them canh bao cho nguoi dung
                        break;
                    }
                }
            }
            $this->render('them', array('model' => $model));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionCapNhat($id)
    {
        if (Yii::app()->user->checkAccess('Quanlykhachhang.KhachHang.CapNhat')) {
            $model = $this->loadModel($id, 'KhachHang');
            if (isset($_POST['KhachHang'])) {
                $result = $model->capNhat($_POST['KhachHang']);
                switch ($result) {
                    case 'ok':
                    {
                        $this->redirect(array('chitiet', 'id' => $id));
                        break;
                    }
                    case 'dup-error':
                    {
                        Yii::app()->user->setFlash('info-board', Yii::t('viLib', 'Data existed in sytem. Please try another one!'));
                        break;
                    }
                    case 'fail':
                    {
                        // co the lam them canh bao cho nguoi dung
                        break;
                    }
                }
            }
            $this->render('capnhat', array('model' => $model));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionXoaGrid($id)
    {
        if (Yii::app()->user->checkAccess('Quanlykhachhang.KhachHang.XoaGrid')) {
            if (Yii::app()->getRequest()->getIsPostRequest()) {
                $delModel = $this->loadModel($id, 'KhachHang');
                $result = $delModel->xoa();
                switch ($result) {
                    case 'ok':
                    {
                        break;
                    }
                    case 'rel-error':
                    {
                        echo Yii::t('viLib', 'Can not delete this item because it contains relative data');
                        break;
                    }
                    case 'fail':
                    {
                        echo Yii::t('viLib', 'Some errors occur in delete process. Please check your DBMS!');
                        break;
                    }
                }
                if (!Yii::app()->getRequest()->getIsAjaxRequest())
                    $this->redirect(array('danhsach'));
            } else
                throw new CHttpException(400, Yii::t('viLib', 'Your request is invalid.'));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionXoa($id)
    {
        if (Yii::app()->user->checkAccess('Quanlykhachhang.KhachHang.Xoa')) {
            if (Yii::app()->getRequest()->getIsPostRequest()) {
                $delModel = $this->loadModel($id, 'KhachHang');
                $message = '';
                $canDelete = true;
                $result = $delModel->xoa();
                switch ($result) {
                    case 'ok':
                    {
                        break;
                    }
                    case 'rel-error':
                    {
                        $message = Yii::t('viLib', 'Can not delete this item because it contains relative data');
                        $canDelete = false;
                        break;
                    }
                    case 'fail':
                    {
                        $message = Yii::t('viLib', 'Some errors occur in delete process. Please check your DBMS!');
                        $canDelete = false;
                        break;
                    }
                }
                if ($canDelete) {
                    if (!Yii::app()->getRequest()->getIsAjaxRequest())
                        $this->redirect(array('danhsach'));
                } else {
                    Yii::app()->user->setFlash('info-board', $message);
                    $this->redirect(array('chitiet', 'id' => $id));
                }
                /*if (!Yii::app()->getRequest()->getIsAjaxRequest())
                    $this->redirect(array('danhsach'));*/
            } else
                throw new CHttpException(400, Yii::t('viLib', 'Your request is invalid.'));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }

    public function actionDanhSach()
    {

        if (Yii::app()->user->checkAccess('Quanlykhachhang.KhachHang.DanhSach')) {
            
            $model = new KhachHang('search');
            $model->unsetAttributes();
            Yii::app()->CPOSSessionManager->clearKey('ExportData');
            if (isset($_GET['KhachHang'])) {
                // set vao session
                Yii::app()->CPOSSessionManager->setItem('ExportData', $_GET['KhachHang']);
                $model->setAttributes($_GET['KhachHang']);
            }
            $this->render('danhsach', array('model' => $model));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }


    public function  actionXuat()
    {
        if (Yii::app()->user->checkAccess('Quanlykhachhang.KhachHang.Xuat')) {
            $model = new KhachHang('search');
            $model->unsetAttributes();
            if (!Yii::app()->CPOSSessionManager->isEmpty('ExportData')) {
                $dk = Yii::app()->CPOSSessionManager->getKey('ExportData');
                $model->setAttributes($dk[0]);
                $dataProvider = $model->xuatFileExcel();
                $this->render('xuat', array('dataProvider' => $dataProvider));
            }
            $this->render('xuat', array('dataProvider' => new CActiveDataProvider('KhachHang')));
        } else
            throw new CHttpException(403, Yii::t('viLib', 'You are not allowed to access this section. Please contact to your administrator for help'));
    }
    
    /////////////////////////////////////////////////// CUSTOM GRID ////////////////////////////////////////////////
    
    public function gridCoHoaDonTra($data,$row){
        $result = '';
        if($data->trang_thai){
            $result = '<img alt="Trả Hàng" src="'.Yii::app()->theme->baseUrl.'/images/icons/return.png"/>';
        }
        return $result;
    }
    
    public function gridSoSanPhamThuc($data,$row){
        $result = '';
        $ct_hd_thuc = HoaDonBanHang::layChiTietHoaDonHienTai($data->id)->getData();
        return count($ct_hd_thuc);
    }
    public function gridTriGiaThuc($data,$row){
        return number_format(HoaDonBanHang::layTriGiaHoaDonThuc($data->id),0,".",",");
    }

}