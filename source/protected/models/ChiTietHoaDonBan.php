<?php

Yii::import('application.models._base.BaseChiTietHoaDonBan');

class ChiTietHoaDonBan extends BaseChiTietHoaDonBan
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}


    public function them($params) {
        // kiem tra du lieu con bi trung hay chua

        if(!$this->kiemTraTonTai($params)) {
            //neu khoa chua ton tai
            $this->setAttributes($params);
                            if ($this->save())
                        return 'ok';
            else
                return 'fail';
        } else
                return 'dup-error';
    }

    public function capNhat($params) {
        // kiem tra du lieu con bi trung hay chua
                if(!$this->kiemTraTonTai($params)) {
            $this->setAttributes($params);
                            if ($this->save())
                                return 'ok';
                else
                    return 'fail';
        } else {

        // so sanh ma cu == ma moi
        if($this->soKhopMa($params)) {
            $this->setAttributes($params);
                            if ($this->save())
                                return 'ok';
                else
                    return 'fail';
        } else
                return 'dup-error';

        }
    }

    public function xoa() {
        $relation = $this->kiemTraQuanHe($this->id);
        if(!$relation) {
            if($this->delete())
                return 'ok';
            else
                return 'fail';
        } else {
            return 'rel-error';
        }
    }


    public function xuatFileExcel() {
        $criteria = new CDbCriteria;

                                $criteria->compare('san_pham_id', $this->san_pham_id);
                                $criteria->compare('hoa_don_ban_id', $this->hoa_don_ban_id);
                                $criteria->compare('so_luong', $this->so_luong);
                                $criteria->compare('don_gia', $this->don_gia);
                                $criteria->compare('san_pham_tang_id', $this->san_pham_tang_id);
        
        $event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['ChiTietHoaDonBan'];
        $this->onAfterExport($event);

        return new CActiveDataProvider($this, array(
        'criteria' => $criteria,
        ));
        }


}