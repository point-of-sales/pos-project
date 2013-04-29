<?php

class ChiNhanhController extends CPOSController {


	public function actionChiTiet($id) {
		$this->render('chitiet', array(
			'model' => $this->loadModel($id, 'ChiNhanh'),
		));
	}

    public function actionDanhSach() {

        $model = new ChiNhanh('search');
        $model->unsetAttributes();
        Yii::app()->CPOSSessionManager->clearKey('ExportData');
        if(isset($_GET['ChiNhanh'])) {
            // set vao session
            Yii::app()->CPOSSessionManager->setItem('ExportData',$_GET['ChiNhanh']);
            $model->setAttributes($_GET['ChiNhanh']);
        }
        $this->render('danhsach',array('model'=>$model));
    }

    public function  actionXuat() {
        $model = new ChiNhanh('search');
        $model->unsetAttributes();
        if(!Yii::app()->CPOSSessionManager->isEmpty('ExportData')) {
            $model->setAttributes(Yii::app()->CPOSSessionManager->getItem('ExportData'));
            $dataProvider = $model->xuatFileExcel();
            $this->render('xuat',array('dataProvider'=>$dataProvider));
        }
        $this->render('xuat',array('dataProvider'=>new CActiveDataProvider('ChiNhanh')));
    }


}