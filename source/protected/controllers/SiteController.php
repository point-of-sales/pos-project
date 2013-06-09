<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );

    }


    /*public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('*'),
                'users' => array('@'),
            ),
            array('allow',
                'controllers' => array('quanlyphanquyen'),
                'users' => array('QTHT001'),
            ),
            array('deny', // deny all users
                'users' => array('?'),
            ),

        );
    }*/


	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
        if(!Yii::app()->user->isGuest) {
            $this->redirect('/site/index');
        }

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()) {

                // cap nhat lan dang nhap cuoi
                $nhanVienModel = NhanVien::model()->findByPk(Yii::app()->user->id);
                //$nhanVienModel->lan_dang_nhap_cuoi =

                $fullModuleList = array(
                    'Quanlybanhang' => array('label' => Yii::t('viLib', 'Sales management'), 'url' => array('/quanlybanhang/hoaDonBanHang/danhsach')),
                    'Quanlykhachhang' => array('label' => Yii::t('viLib', 'Customer management'), 'url' => array('/quanlykhachhang/khachHang/danhsach')),
                    'Quanlychinhanh' => array('label' => Yii::t('viLib', 'Branch management'), 'url' => array('/quanlychinhanh/chiNhanh/danhsach')),
                    'Quanlysanpham' => array('label' => Yii::t('viLib', 'Product management'), 'url' => array('/quanlysanpham/sanPham/danhsach')),
                    'Quanlynhapxuat' => array('label' => Yii::t('viLib', 'Import/Export management'), 'url' => array('/quanlynhapxuat/chiNhanh/danhsach')),
                    'Quanlynhanvien' => array('label' => Yii::t('viLib', 'Employee management'), 'url' => array('/quanlynhanvien/nhanVien/danhsach')),
                    'Quanlynhacungcap' => array('label' => Yii::t('viLib', 'Supplier management'), 'url' => array('/quanlynhacungcap/nhaCungCap/danhsach')),
                    'Quanlykhuyenmai' => array('label' => Yii::t('viLib', 'Promotion management'), 'url' => array('/quanlykhuyenmai/khuyenMai/danhsach')),
                    'Quanlybaocao' => array('label' => Yii::t('viLib', 'Report management'), 'url' => array('/quanlybaocao/baoCao/danhsach')),
                    'Quanlyphanquyen' => array('label' => Yii::t('viLib', 'Decentralization management'), 'url' => array('/quanlyphanquyen/assignment/danhsach')),
                    'Quanlycauhinh' => array('label' => Yii::t('viLib', 'Config management'), 'url' => array('/quanlycauhinh/cauHinh/chitiet/id/1')),
                );

                if (!Yii::app()->user->isGuest) {
                    $currentUserModuleList = Rights::getCurrentUserModuleList();
                    $menuItems = array();
                    $currentRoleWeight = RightsWeight::getRoleWeight(Yii::app()->user->id);
                    if ($currentRoleWeight < 999) {
                        foreach ($fullModuleList as $key => $value) {
                            if (in_array($key, $currentUserModuleList)) {
                                $menuItems[] = $value;
                            }
                        }
                    } else {
                        // render full module for quan ly he thong
                        foreach ($fullModuleList as $key => $value) {
                            $menuItems[] = $value;
                        }

                    }
                }
                Yii::app()->CPOSSessionManager->setItem('menuItems',$menuItems);
                $this->redirect('index');
            }
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
        Yii::app()->CPOSSessionManager->clearKey('menuItems');
		$this->redirect(Yii::app()->homeUrl);
	}

    public function actionContact() {
        $this->render('contact');
    }

}