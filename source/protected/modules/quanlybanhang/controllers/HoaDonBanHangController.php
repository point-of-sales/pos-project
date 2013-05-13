<?php

class HoaDonBanHangController extends CPOSController {
    public $layout = '//layouts/column2';

	public function actionChiTiet($id) {
		$this->render('chitiet', array(
			'model' => $this->loadModel($id, 'HoaDonBanHang'),
		));
	}

	public function actionThem() {
		$model = new HoaDonBanHang;

        if (isset($_POST['HoaDonBanHang'])) {
            $hd_ban_hang = Yii::app()->CPOSSessionManager->getKey('hd_ban_hang');
            $post = array(
                'ChungTu' => array(
                    'ma_chung_tu' => $hd_ban_hang['ma_chung_tu'],
                    'ngay_lap' => $hd_ban_hang['ngay_lap'],
                    'tri_gia' => $hd_ban_hang['tri_gia'],
                    'ghi_chu' => $hd_ban_hang['ghi_chu'],
                    'nhan_vien_id' => $hd_ban_hang['nhan_vien_id'],
                    'chi_nhanh_id' => $hd_ban_hang['chi_nhanh_id'],
                ),
                'HoaDonBanHang' => array(
                    'chiet_khau' => $hd_ban_hang['chiet_khau'],
                    'khach_hang_id' => $hd_ban_hang['khach_hang']['id'],
                ),
            );
            foreach($hd_ban_hang['cthd_ban_hang'] as $item){
                $post['ChiTietHoaDonBan'][] = array(
                    'id' => $item['id'],
                    'so_luong' => $item['so_luong'],
                    'don_gia' => $item['don_gia'],
                );
            }
            //$result = $model->them($post);
            $result = 'ok';
            switch($result) {
                case 'ok':{
                    //$this->actionHoaDonMoi();
                    $this->redirect(array('them'));
                }break;
                case 'detail-error':{
                    Yii::app()->user->setFlash('info-board','Vui lòng nhập đầu đủ thông tin hóa đơn');
                }break;
                case 'fail':{
                    Yii::app()->user->setFlash('info-board','Lưu hóa đơn thất bại');
                }break;
                case 'dup-error':{
                    Yii::app()->user->setFlash('info-board','dup-error');
                }break;
            }
		}
        if(Yii::app()->CPOSSessionManager->isEmpty('hd_ban_hang')){
            $this->actionHoaDonMoi();   
        }
        $this->layout = '//layouts/column1';
		$this->render('them', array( 'model' => $model));
	}
    
    public function actionHoaDon(){
        $this->layout = '//layouts/column1';
        $this->forward('hoadon');
        Yii::app()->CPOSSessionManager->setItem('hd_ban_hang',false,array('in_hoa_don'));
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
    
    public function actionLayKhachHang(){
        if (Yii::app()->getRequest()->getIsAjaxRequest()==true && isset($_POST['ma_khach_hang'])==true) {
            $ma_khach_hang = $_POST['ma_khach_hang'];
            //$khach_hang = Yii::app()->CPOSSessionManager->getItem('hd_ban_hang',array('khach_hang'));   
            $model = KhachHang::model()->findByAttributes(array('ma_khach_hang'=>$ma_khach_hang));
            if(!empty($model)){
                $khach_hang = array(
                    'id' => $model->getAttribute('id'),
                    'ma_khach_hang' => $model->getAttribute('ma_khach_hang'),
                    'ho_ten' => $model->getAttribute('ho_ten'),
                    'diem_tich_luy' => $model->getAttribute('diem_tich_luy'),
                    'loai_khach_hang_id' => $model->getAttribute('loai_khach_hang_id'),
                );
                Yii::app()->CPOSSessionManager->setItem('hd_ban_hang',$khach_hang,array('khach_hang'));
                //set giam gia cho hd ban hang
                Yii::app()->CPOSSessionManager->setItem('hd_ban_hang',$model->loaiKhachHang->giam_gia,array('chiet_khau'));
                $result = array(
                    'status' => 'ok',
                    'msg' => 'ok'
                );
            }
            else{
                $result = array(
                    'status' => 'error',
                    'msg' => 'Mã khách hàng không đúng',
                );   
            }
            echo json_encode($result);
        }
        else
            throw new CHttpException(400, Yii::t('viLib', 'Your request is invalid.'));
    }
    
    public function actionCapNhatSoLuong(){
        if (Yii::app()->getRequest()->getIsAjaxRequest()==true && isset($_POST['ma_vach'])==true) {
            $ma_vach = $_POST['ma_vach'];
            $so_luong = $_POST['so_luong'];
            $chi_nhanh = 10;
            
            if($so_luong<=0){
                $result = array(
                    'status' => 'error',
                    'msg' => 'Số lượng không hợp lệ',
                );
                echo json_encode($result);
                return;
            }
            $cthd_ban_hang = Yii::app()->CPOSSessionManager->getItem('hd_ban_hang',array('cthd_ban_hang'));
            $index = $this->kiemTraMaVach($ma_vach);
            if($index != -1){
                if($this->kiemTraSoLuong($ma_vach,$chi_nhanh,$so_luong)){
                    $cthd_ban_hang[$index]['so_luong'] = $so_luong;
                    Yii::app()->CPOSSessionManager->setItem('hd_ban_hang',$cthd_ban_hang,array('cthd_ban_hang'));
                    $result = array(
                        'status' => 'ok',
                        'msg' => 'ok'
                    );      
                }
                else{
                    $result = array(
                        'status' => 'error',
                        'msg' => 'Không đủ số lượng',
                    );
                }   
            }
            else{
                $result = array(
                    'status' => 'error',
                    'msg' => 'Mã vạch không đúng',
                );
            }
            echo json_encode($result);
        }
        else
            throw new CHttpException(400, Yii::t('viLib', 'Your request is invalid.'));
    }
    
    public function actionXoaSanPhamBan(){
        if (Yii::app()->getRequest()->getIsAjaxRequest()==true && isset($_POST['ma_vach'])==true) {
            $ma_vach = $_POST['ma_vach'];
            $cthd_ban_hang = Yii::app()->CPOSSessionManager->getItem('hd_ban_hang',array('cthd_ban_hang'));
            $index = $this->kiemTraMaVach($ma_vach);
            if($index != -1){
                //xoa phan tu khoi array
                unset($cthd_ban_hang[$index]);
                //re index lai array
                $cthd_ban_hang = array_values($cthd_ban_hang);
                Yii::app()->CPOSSessionManager->setItem('hd_ban_hang',$cthd_ban_hang,array('cthd_ban_hang'));
                $result = array(
                    'status' => 'ok',
                    'msg' => 'ok',
                );
            }
            else{
                $result = array(
                    'status' => 'error',
                    'msg' => 'Mã vạch không đúng',
                );
            }
            echo json_encode($result);
        }
        else
            throw new CHttpException(400, Yii::t('viLib', 'Your request is invalid.'));
    }
    
    public function actionLaySanPhamBan(){
        if (Yii::app()->getRequest()->getIsAjaxRequest()==true && isset($_POST['ma_vach'])==true) {
            $ma_vach = $_POST['ma_vach'];
            $so_luong = $_POST['so_luong'];
            $chi_nhanh = 10;
        
            $cthd_ban_hang = Yii::app()->CPOSSessionManager->getItem('hd_ban_hang',array('cthd_ban_hang'));
            //ma vach da co trong cthd ban, cap nhat so luong
            $index = $this->kiemTraMaVach($ma_vach);
            if($index != -1){
                $so_luong += $cthd_ban_hang[$index]['so_luong'];
                if($this->kiemTraSoLuong($ma_vach,$chi_nhanh,$so_luong)){
                    $cthd_ban_hang[$index]['so_luong'] = $so_luong;
                    //cap nhat session cthd ban
                    Yii::app()->CPOSSessionManager->setItem('hd_ban_hang',$cthd_ban_hang,array('cthd_ban_hang'));
                    $result = array(
                        'status' => 'ok',
                        'msg' => 'ok'
                    );      
                }
                else{
                    $result = array(
                        'status' => 'error',
                        'msg' => 'Không đủ số lượng',
                    );
                }
            }
            else{
                $model = SanPham::model()->findByAttributes(array('ma_vach'=>$ma_vach));
                if(!empty($model)){
                    if($this->kiemTraSoLuong($ma_vach,$chi_nhanh,$so_luong)){
                        $item = array(
                            'id' => $model->getAttribute('id'), 
                            'ma_vach' => $model->getAttribute('ma_vach'),
                            'ten_san_pham' => $model->getAttribute('ten_san_pham'),
                            'don_gia'=> $model->layGiaHienTaiKemKhuyenMai(),
                            'so_luong' => 1
                        );
                        $cthd_ban_hang[] = $item;
                        //cap nhat session cthd ban
                        Yii::app()->CPOSSessionManager->setItem('hd_ban_hang',$cthd_ban_hang,array('cthd_ban_hang'));
                        
                        $result = array(
                            'status' => 'ok',
                            'msg' => 'ok'
                        );
                    }
                    else{
                        $result = array(
                            'status' => 'error',
                            'msg' => 'Không đủ số lượng',
                        );
                    }
                }
                else{
                    $result = array(
                        'status' => 'error',
                        'msg' => 'Mã vạch không đúng',
                    );
                }
            }
            echo json_encode($result);
        }
        else
            throw new CHttpException(400, Yii::t('viLib', 'Your request is invalid.'));
    }
    
    public function actionDongBoDuLieu(){
        $hd_ban_hang = Yii::app()->CPOSSessionManager->getKey('hd_ban_hang');
        //tinh tri gia hoa don
        if(isset($hd_ban_hang['cthd_ban_hang'])){
            $tong = 0;
            $cthd_ban_hang = $hd_ban_hang['cthd_ban_hang'];
            for($i=0;$i<count($cthd_ban_hang);$i++){
                $tong += $cthd_ban_hang[$i]['don_gia']*$cthd_ban_hang[$i]['so_luong'];
            }
            if(isset($hd_ban_hang['chiet_khau']))
                $chiet_khau = $hd_ban_hang['chiet_khau'];
            else
                $chiet_khau = 0;
            $tri_gia = $tong - $tong*($chiet_khau/100);
            Yii::app()->CPOSSessionManager->setItem('hd_ban_hang',$tri_gia,array('tri_gia'));
            Yii::app()->CPOSSessionManager->setItem('hd_ban_hang',$tong,array('tong'));
        }
        echo json_encode(Yii::app()->CPOSSessionManager->getKey('hd_ban_hang'));
    }
    
    public function kiemTraSoLuong($ma_vach,$chi_nhanh,$so_luong){
        $model = SanPham::model()->findByAttributes(array('ma_vach'=>$ma_vach));
        if(!empty($model)){
            $model->chi_nhanh_id = $chi_nhanh;
            $so_ton = $model->laySoLuongTonHienTai();
            if($so_ton >= $so_luong)
                return true;
        }
        return false;
    }
    
    public function kiemTraMaVach($ma_vach){
        $model = SanPham::model()->findByAttributes(array('ma_vach'=>$ma_vach));
        if(!empty($model)){
            $ma_vach = $model->getAttribute('ma_vach');
        }
        else{
            return -1;
        }
        $cthd_ban_hang = Yii::app()->CPOSSessionManager->getItem('hd_ban_hang',array('cthd_ban_hang'));
        if(!isset($cthd_ban_hang))
            return -1;
        for($i=0;$i<count($cthd_ban_hang);$i++){
            if($cthd_ban_hang[$i]['ma_vach']==$ma_vach){
                return $i;
            }
        }
        return -1;
    }
    
    public function actionHoaDonMoi(){
        //lay khach hang mac dinh la khach mua le
        $ma_khach_hang = 'KHBT';   
        $model = KhachHang::model()->findByAttributes(array('ma_khach_hang'=>$ma_khach_hang));
        if(!empty($model)){
            $khach_hang = array(
                'id' => $model->getAttribute('id'),
                'ma_khach_hang' => $model->getAttribute('ma_khach_hang'),
                'ho_ten' => $model->getAttribute('ho_ten'),
                'diem_tich_luy' => $model->getAttribute('diem_tich_luy'),
                'loai_khach_hang_id' => $model->getAttribute('loai_khach_hang_id'),
            );
        }
        
        $hd_ban_hang = array(
            'cthd_ban_hang' => array(),
            'cthd_hang_tang' => array(),
            'khach_hang' => $khach_hang,
            'chiet_khau' => 0,
            'ma_chung_tu' => HoaDonBanHang::layMaHoaDonMoi(),
            'ngay_lap' => date('Y-m-d'),
            'tri_gia' => 0,
            'tong' => 0,
            'tien_nhan' => 0,
            'tien_du' => 0,
            'ghi_chu' => '',
            'nhan_vien_id' => 2,
            'chi_nhanh_id' => 10,
        );
        Yii::app()->CPOSSessionManager->clear('hd_ban_hang');
        Yii::app()->CPOSSessionManager->add('hd_ban_hang',$hd_ban_hang);
    }
    
    public function actionCapNhatTienNhan(){
        if (Yii::app()->getRequest()->getIsAjaxRequest()==true) {
            $tien_nhan = $_POST['tien_nhan'];
            $tien_du = $_POST['tien_du'];
            Yii::app()->CPOSSessionManager->setItem('hd_ban_hang',$tien_nhan,array('tien_nhan'));
            Yii::app()->CPOSSessionManager->setItem('hd_ban_hang',$tien_du,array('tien_du'));
        }
    }

}