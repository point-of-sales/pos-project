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

        if(isset($_GET['ChiNhanh'])) {
            // set vao session
            Yii::app()->session['ChiNhanh'] = $_GET['ChiNhanh'];
            $model->setAttributes($_GET['ChiNhanh']);
        }
        $this->render('danhsach',array('model'=>$model));
    }

    public function  actionXuat() {
        $model = new ChiNhanh('search');
        $model->unsetAttributes();

        if(isset(Yii::app()->session['ChiNhanh'])) {
            $model->setAttributes(Yii::app()->session['ChiNhanh']);
            // Gan handler voi event
            $handler = new CPOSEventHandler();
            $model->onAfterExport = array($handler,'clearExportSession');
            $dataProvider = $model->xuatFileExcel();
            $this->render('xuat',array('dataProvider'=>$dataProvider));
        }
    $this->render('xuat',array('dataProvider'=>new CActiveDataProvider('ChiNhanh')));
    }


}