<?php

Yii::import('application.models._base.BaseRightsWeight');

class RightsWeight extends BaseRightsWeight
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    public function them($params)
    {
        // kiem tra du lieu con bi trung hay chua

        if (!$this->kiemTraTonTai($params)) {
            //neu khoa chua ton tai
            $this->setAttributes($params);
            if ($this->save())
                return 'ok';
            else
                return 'fail';
        } else
            return 'dup-error';
    }

    public function capNhat($params)
    {
        // kiem tra du lieu con bi trung hay chua
        if (!$this->kiemTraTonTai($params)) {
            $this->setAttributes($params);
            if ($this->save())
                return 'ok';
            else
                return 'fail';
        } else {

            // so sanh ma cu == ma moi
            if ($this->soKhopMa($params)) {
                $this->setAttributes($params);
                if ($this->save())
                    return 'ok';
                else
                    return 'fail';
            } else
                return 'dup-error';

        }
    }

    public function xoa()
    {
        $relation = $this->kiemTraQuanHe($this->id);
        if (!$relation) {
            if ($this->delete())
                return 'ok';
            else
                return 'fail';
        } else {
            return 'rel-error';
        }
    }


    public function xuatFileExcel()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('itemname', $this->itemname);
        $criteria->compare('type', $this->type);
        $criteria->compare('weight', $this->weight);

        /*$event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session[''];
        $this->onAfterExport($event);*/

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function getRole($id)
    {
        return Yii::app()->db->createCommand()
            ->select('itemname')
            ->from('AuthAssignment')
            ->where('userid=:nhan_vien_id')
            ->queryScalar(array(':nhan_vien_id' => $id));

    }

    public static function getRoleWeight($id)
    {
        $roleName = RightsWeight::getRole($id);
        return Yii::app()->db->createCommand()
            ->select('weight')
            ->from('Rights')
            ->where('itemname=:itemname')
            ->queryScalar(array(':itemname' => $roleName));

    }

    public static function getRoleWeightFromItemname($itemname)
    {
        return Yii::app()->db->createCommand()
            ->select('weight')
            ->from('Rights')
            ->where('itemname=:itemname')
            ->queryScalar(array(':itemname' => $itemname));
    }

    public static function layDanhSachQuyen()
    {

        $danhSachQuyenModel = RightsWeight::model()->findAll();
        $danhSachQuyen = array();
        $currentUserWeight = RightsWeight::getRoleWeight(Yii::app()->user->id);
        foreach ($danhSachQuyenModel as $qModel) {
            $item = Rights::getAuthorizer()->authManager->getAuthItem($qModel->itemname);
            $authorizer = Rights::module()->getAuthorizer();
            $item = $authorizer->attachAuthItemBehavior($item);
            $qWeight = RightsWeight::getRoleWeightFromItemname($qModel->itemname);

            if ($currentUserWeight == 999) // quan ly he thong
            $danhSachQuyen[$qModel->itemname] = $item->getPositionDescription();
            elseif ($currentUserWeight == 3 && $qWeight < 3)   // quan ly chi nhanh
                $danhSachQuyen[$qModel->itemname] = $item->getPositionDescription();
        }
        return $danhSachQuyen;
    }

}