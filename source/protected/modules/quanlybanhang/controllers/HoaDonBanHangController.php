<?php

class HoaDonBanHangController extends CPOSController {
    public $layout = '//layouts/column2';

	public function actionChiTiet($id) {
		/*$this->render('chitiet', array(
			'model' => $this->loadModel($id, 'HoaDonBanHang'),
		));
        */
        //hoa don ban hang
        $model = $this->loadModel($id, 'HoaDonBanHang');
        //chi tiet hoa don ban hang
        $criteria = new CDbCriteria();
        $criteria->condition = 'hoa_don_ban_id=:hoa_don_ban_id';
        $criteria->params = array(':hoa_don_ban_id' => $id);
        $chiTietHangBanProvider = new CActiveDataProvider('ChiTietHoaDonBan', array('criteria' => $criteria));
        //chi tiet hang tang
        $criteria = new CDbCriteria();
        $criteria->condition = 'hoa_don_ban_id=:hoa_don_ban_id';
        $criteria->params = array(':hoa_don_ban_id' => $id);
        $chiTietHangTangProvider = new CActiveDataProvider('ChiTietHoaDonTang', array('criteria' => $criteria));
        //chi tiet hoa don tra
        $criteria = new CDbCriteria();
        $criteria->condition = 'hoa_don_ban_id=:hoa_don_ban_id';
        $criteria->params = array(':hoa_don_ban_id' => $id);
        $hdTraProvider = new CActiveDataProvider('HoaDonTraHang', array('criteria' => $criteria));
        
        
        $this->render('chitiet', array(
            'model' => $model,
            'chiTietHangBanProvider' => $chiTietHangBanProvider,
            'chiTietHangTangProvider' => $chiTietHangTangProvider,
            'hdTraProvider' => $hdTraProvider,
        ));
	}
    
    public function actionTraHang($id){
        $chi_nhanh_id = 10;
        $model = $this->loadModel($id, 'HoaDonBanHang');
        $model->hoaDonTraHangs = new HoaDonTraHang();
        $chiTietDataProvider = $model->layChiTietHoaDon();
		if(!empty($_POST)){
            //$model_hd_tra_hang = new HoaDonTraHang;
            $post = array(
                'HoaDonTraHang' => array(
                    //'id'=>$_POST['HoaDonTraHang']['id'],
                    'ly_do_tra_hang'=>$_POST['HoaDonTraHang']['ly_do_tra_hang'],
                    'hoa_don_ban_id'=>$id,
                ),
                'ChungTu' => array(
                    'id' => '',
                    'ma_chung_tu' => HoaDonTraHang::layMaHoaDonMoi(),
                    'ngay_lap' => date('d-m-Y H:i:s'),
                    'tri_gia' => $_POST['tri_gia'],
                    'ghi_chu' => '',
                    'nhan_vien_id' => Yii::app()->user->id,
                    'chi_nhanh_id' => $chi_nhanh_id,
                ),
            );
            foreach($_POST['so_luong'] as $key=>$value){
                $post['ChiTietHoaDonTra'][] = array(
                    'id' => $key,
                    'so_luong' => $value,
                    'don_gia' => $_POST['don_gia'][$key],
                );
            }
            //print_r($post);exit;
            $result = $model->hoaDonTraHangs->them($post);
            switch($result) {
                case 'ok': {
                    //cap nhat trang thai hoa don
                    $result = $model->saveAttributes(array("trang_thai"=>1));
                    
                    $this->redirect(array('danhsach'));
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
		$this->render('trahang', array(
            'model' => $model,
            'dataProvider' => $chiTietDataProvider,
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
            foreach($hd_ban_hang['cthd_hang_tang'] as $item){
                $post['ChiTietHoaDonTang'][] = array(
                    'id' => $item['id'],
                    'so_luong' => $item['so_luong'],
                );
            }
            if($hd_ban_hang['tien_nhan']<=0){
                $result = 'fail-money';
            }
            else{
                $result = $model->them($post);   
            }
            //$result = 'ok';
            switch($result) {
                case 'ok':{
                    //cap nhat thong tin khach hang
                    $result_kh = KhachHang::capNhatTriGia($hd_ban_hang['khach_hang']['id'],$hd_ban_hang['tri_gia']);
                    switch($result_kh){
                        case 'ok':{
                            
                        }break;
                        case 'ok-up':{
                            Yii::app()->session['up_level'] = true;
                            $ma_khach_hang = Yii::app()->CPOSSessionManager->getItem('hd_ban_hang',array('khach_hang','ma_khach_hang'));
                            $ten_loai_kh = KhachHang::layTenLoaiKhachHang($ma_khach_hang);
                            Yii::app()->CPOSSessionManager->setItem('hd_ban_hang',$ten_loai_kh,array('khach_hang','ten_loai'));
                        };break;
                        case 'kl':{
                            
                        }break;
                        case 'fail':{
                            
                        }break;
                    }
                    $this->actionInHoaDon(true);
                    $this->actionHoaDonMoi();
                    $this->redirect(array('them'));
                }break;
                case 'detail-error':{
                    Yii::app()->user->setFlash('info-board','Vui lòng nhập đầu đủ thông tin hóa đơn');
                }break;
                case 'fail':{
                    Yii::app()->user->setFlash('info-board','Lưu hóa đơn thất bại');
                }break;
                case 'fail-money':{
                    Yii::app()->user->setFlash('info-board','Vui lòng nhập số tiền nhận');
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
    
    public function actionCapNhatSoLuong(){
        if (Yii::app()->getRequest()->getIsAjaxRequest()==true && isset($_POST['ma_vach'])==true) {
            $ma_vach = $_POST['ma_vach'];
            $so_luong = $_POST['so_luong'];
            $chi_nhanh = Yii::app()->CPOSSessionManager->getItem('hd_ban_hang',array('chi_nhanh_id'));
            
            if(!$this->kiemTraSoLuongHopLe($so_luong)){
                $result = array(
                    'status' => 'error',
                    'msg' => 'Số lượng không hợp lệ',
                );
                echo json_encode($result);
                return;
            }
            $cthd_ban_hang = Yii::app()->CPOSSessionManager->getItem('hd_ban_hang',array('cthd_ban_hang'));
            $index = $this->kiemTraMaVachHangBan($ma_vach);
            if($index != -1){
                if($this->kiemTraSoLuongHangBan($ma_vach,$chi_nhanh,$so_luong)){
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
            $index = $this->kiemTraMaVachHangBan($ma_vach);
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
            $chi_nhanh = Yii::app()->CPOSSessionManager->getItem('hd_ban_hang',array('chi_nhanh_id'));
        
            $cthd_ban_hang = Yii::app()->CPOSSessionManager->getItem('hd_ban_hang',array('cthd_ban_hang'));
            //ma vach da co trong cthd ban, cap nhat so luong
            $index = $this->kiemTraMaVachHangBan($ma_vach);
            if($index != -1){
                $so_luong += $cthd_ban_hang[$index]['so_luong'];
                if($this->kiemTraSoLuongHangBan($ma_vach,$chi_nhanh,$so_luong)){
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
                    if($this->kiemTraSoLuongHangBan($ma_vach,$chi_nhanh,$so_luong)){
                        $don_gia = $model->layGiaHienTaiKemKhuyenMai();
                        if(is_numeric($model->layGiaHienTai())){
                            $item = array(
                                'id' => $model->getAttribute('id'), 
                                'ma_vach' => $model->getAttribute('ma_vach'),
                                'ten_san_pham' => $model->getAttribute('ten_san_pham'),
                                'don_gia'=> $don_gia,
                                'so_luong' => 1,
                                'thanh_tien' => 0,
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
                                'msg' => 'Sản phẩm chưa có mốc giá',
                            );   
                        }
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
                $thanh_tien = $cthd_ban_hang[$i]['don_gia']*$cthd_ban_hang[$i]['so_luong'];
                $cthd_ban_hang[$i]['thanh_tien'] = $thanh_tien;
                $tong += $thanh_tien;
            }
            if(isset($hd_ban_hang['chiet_khau']))
                $chiet_khau = $hd_ban_hang['chiet_khau'];
            else
                $chiet_khau = 0;
            $tri_gia = $tong - $tong*($chiet_khau/100);
            Yii::app()->CPOSSessionManager->setItem('hd_ban_hang',$cthd_ban_hang,array('cthd_ban_hang'));
            Yii::app()->CPOSSessionManager->setItem('hd_ban_hang',$tri_gia,array('tri_gia'));
            Yii::app()->CPOSSessionManager->setItem('hd_ban_hang',$tong,array('tong'));
        }
        echo json_encode(Yii::app()->CPOSSessionManager->getKey('hd_ban_hang'));
    }
    
    private function kiemTraSoLuongHangBan($ma_vach,$chi_nhanh,$so_luong){
        $model = SanPham::model()->findByAttributes(array('ma_vach'=>$ma_vach));
        if(!empty($model)){
            $model->chi_nhanh_id = $chi_nhanh;
            $so_ton = $model->laySoLuongTonHienTai();
            if($so_ton >= $so_luong)
                return true;
        }
        return false;
    }
    
    private function kiemTraMaVachHangBan($ma_vach){
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
        $nhan_vien_id = 2;
        $nhan_vien = NhanVien::model()->findByAttributes(array('id'=>$nhan_vien_id));
        $model = KhachHang::model()->findByAttributes(array('ma_khach_hang'=>$ma_khach_hang));
        if(!empty($model)){
            $khach_hang = array(
                'id' => $model->getAttribute('id'),
                'ma_khach_hang' => $model->getAttribute('ma_khach_hang'),
                'ho_ten' => $model->getAttribute('ho_ten'),
                'diem_tich_luy' => $model->getAttribute('diem_tich_luy'),
                'loai_khach_hang_id' => $model->getAttribute('loai_khach_hang_id'),
                'ten_loai' => $model->loaiKhachHang->ten_loai,
                'dien_thoai' => $model->getAttribute('dien_thoai'),
                'dia_chi' => $model->getAttribute('dia_chi'),
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
            'nhan_vien_id' => $nhan_vien_id,
            'nhan_vien_ho_ten' => $nhan_vien->getAttribute('ho_ten'),
            'chi_nhanh_id' => 10,
        );
        Yii::app()->session['hd_ban_hang'] = $hd_ban_hang;
        //Yii::app()->CPOSSessionManager->clear('hd_ban_hang');
        //Yii::app()->CPOSSessionManager->add('hd_ban_hang',$hd_ban_hang);
    }
    
    public function actionInHoaDon($flag=null){
        if(is_null($flag)){
            $result = Yii::app()->session['in_hoa_don'];
            if($result){
                Yii::app()->session['in_hoa_don'] = false;
                echo 'true';
            }
            else{
                echo 'false';
            }
        }
        else{
            if($flag){
                $data = Yii::app()->session['hd_ban_hang'];
                Yii::app()->session['hoa_don'] = $data;
            }
            Yii::app()->session['in_hoa_don'] = $flag;   
        }
    }
    
    public function actionHoaDon(){
        $this->layout = '//layouts/column1';
        $this->renderPartial('hoadon');
    }
    
    public function actionCapNhatTienNhan(){
        if (Yii::app()->getRequest()->getIsAjaxRequest()==true) {
            $tien_nhan = $_POST['tien_nhan'];
            $tien_du = $_POST['tien_du'];
            Yii::app()->CPOSSessionManager->setItem('hd_ban_hang',$tien_nhan,array('tien_nhan'));
            Yii::app()->CPOSSessionManager->setItem('hd_ban_hang',$tien_du,array('tien_du'));
        }
    }
    
    /////////////////////////////////////////////////// START HANG TANG////////////////////////////////////////////////
    
    public function actionLayHangTang(){
        if (Yii::app()->getRequest()->getIsAjaxRequest()) {
            if(isset($_POST['tri_gia'])){
                $tri_gia = $_POST['tri_gia'];
                $chi_nhanh = Yii::app()->CPOSSessionManager->getItem('hd_ban_hang',array('chi_nhanh_id'));
                $san_pham_tang = SanPhamTang::laySanPhamTang($chi_nhanh,$tri_gia);
                echo json_encode($san_pham_tang);   
            }
        }
        else
            throw new CHttpException(400, Yii::t('viLib', 'Your request is invalid.'));       
    }
    
    private function kiemTraSoLuongHangTang($ma_vach,$chi_nhanh,$so_luong){
        $model = SanPhamTang::model()->findByAttributes(array('ma_vach'=>$ma_vach));
        if(!empty($model)){
            $model->chi_nhanh_id = $chi_nhanh;
            $so_ton = $model->laySoLuongTonHienTai();
            if($so_ton >= $so_luong)
                return true;
        }
        return false;
    }
    
    public function actionCapNhatHangTang(){
        if (Yii::app()->getRequest()->getIsAjaxRequest()==true) {
            if(isset($_POST['arr_hang_tang'])==true){
                $arr_hang_tang = json_decode($_POST['arr_hang_tang']);
                
                //chuyen doi object sang array
                $arr_hang_tang = $this->objectToArray($arr_hang_tang);
                
                foreach($arr_hang_tang as $item){
                    if(!$this->kiemTraSoLuongHopLe($item['so_luong'])){
                        $result = array(
                            'status' => 'error',
                            'msg' => 'Số lượng không hợp lệ',
                        );
                        echo json_encode($result);
                        return;
                    }
                }
                
                $flag = true;
                $chi_nhanh = Yii::app()->CPOSSessionManager->getItem('hd_ban_hang',array('chi_nhanh_id'));   
                $msg_ten = '';
                foreach($arr_hang_tang as $item){
                    if(!$this->kiemTraSoLuongHangTang($item['ma_vach'],$chi_nhanh,$item['so_luong'])){
                        $msg_ten .= $item['ten_san_pham'].', ';
                        $flag = false;
                    }
                }
                if($flag){
                    Yii::app()->CPOSSessionManager->setItem('hd_ban_hang',$arr_hang_tang,array('cthd_hang_tang'));
                    $result = array(
                        'status' => 'ok',
                        'msg' => 'ok',
                    );   
                }
                else{
                    $result = array(
                        'status' => 'error',
                        'msg' => $msg_ten.' Không đủ số lượng',
                    );   
                }
            }
            else{
                $result = array(
                    'status' => 'error',
                    'msg' => 'error',
                );
            }
            echo json_encode($result);
        }
        else
            throw new CHttpException(400, Yii::t('viLib', 'Your request is invalid.'));
    }
    
    //======> dang test
    public function actionCapNhatSoLuongHangTang(){
        if (Yii::app()->getRequest()->getIsAjaxRequest()==true && isset($_POST['ma_vach'])==true) {
            $ma_vach = $_POST['ma_vach'];
            $so_luong = $_POST['so_luong'];
            $chi_nhanh = Yii::app()->CPOSSessionManager->getItem('hd_ban_hang',array('chi_nhanh_id'));
            
            if($so_luong<=0){
                $result = array(
                    'status' => 'error',
                    'msg' => 'Số lượng không hợp lệ',
                );
                echo json_encode($result);
                return;
            }
            $cthd_ban_hang = Yii::app()->CPOSSessionManager->getItem('hd_ban_hang',array('cthd_ban_hang'));
            $index = $this->kiemTraMaVachHangTang($ma_vach);
            if($index != -1){
                if($this->kiemTraSoLuongHangTang($ma_vach,$chi_nhanh,$so_luong)){
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
    
    private function kiemTraMaVachHangTang($ma_vach){
        $model = SanPhamTang::model()->findByAttributes(array('ma_vach'=>$ma_vach));
        if(!empty($model)){
            $ma_vach = $model->getAttribute('ma_vach');
        }
        else{
            return -1;
        }
        $cthd_hang_tang = Yii::app()->CPOSSessionManager->getItem('hd_ban_hang',array('cthd_hang_tang'));
        if(!isset($cthd_hang_tang))
            return -1;
        for($i=0;$i<count($cthd_hang_tang);$i++){
            if($cthd_hang_tang[$i]['ma_vach']==$ma_vach){
                return $i;
            }
        }
        return -1;
    }
    
    /////////////////////////////////////////////////// END HANG TANG////////////////////////////////////////////////
    
    /////////////////////////////////////////////////// START KHACH HANG ////////////////////////////////////////////////
    
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
                    'dien_thoai' => $model->getAttribute('dien_thoai'),
                    'dia_chi' => $model->getAttribute('dia_chi'),
                    'loai_khach_hang_id' => $model->getAttribute('loai_khach_hang_id'),
                    'ten_loai' => $model->loaiKhachHang->ten_loai,
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
    
    public function actionXoaHangTang(){
        if (Yii::app()->getRequest()->getIsAjaxRequest()==true && isset($_POST['ma_vach'])==true) {
            $ma_vach = $_POST['ma_vach'];
            $cthd_hang_tang = Yii::app()->CPOSSessionManager->getItem('hd_ban_hang',array('cthd_hang_tang'));
            $index = $this->kiemTraMaVachHangTang($ma_vach);
            if($index != -1){
                //xoa phan tu khoi array
                unset($cthd_hang_tang[$index]);
                //re index lai array
                $cthd_hang_tang = array_values($cthd_hang_tang);
                Yii::app()->CPOSSessionManager->setItem('hd_ban_hang',$cthd_hang_tang,array('cthd_hang_tang'));
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
    
    /////////////////////////////////////////////////// END KHACH HANG ////////////////////////////////////////////////
    
    /////////////////////////////////////////////////// START HELPER ////////////////////////////////////////////////
    
    private function objectToArray($object){
        $arr = array();
        foreach($object as $item){
            $arr[] = (array)$item;
        }
        return $arr;
    }
    
    private function kiemTraSoLuongHopLe($so_luong){
        if(!is_numeric($so_luong))
            return false;
        if(strpos($so_luong,'.')){
            return false;
        }
        if($so_luong<=0)
            return false;
        return true;
    }

    /////////////////////////////////////////////////// END HELPER ////////////////////////////////////////////////
    
    /////////////////////////////////////////////////// TRA HANG ////////////////////////////////////////////////
    
    public function actionXoaGridTraHang($id){
        
    }
    
}