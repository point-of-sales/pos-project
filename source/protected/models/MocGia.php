<?php

Yii::import('application.models._base.BaseMocGia');

class MocGia extends BaseMocGia
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('viLib', 'ID'),
            'thoi_gian_bat_dau' => Yii::t('viLib', 'Start date'),
            'gia_ban' => Yii::t('viLib', 'Price'),
            'san_pham_id' => null,
            'sanPham' => null,
        );
    }

    public function beforeSave() {
        if (parent::beforeSave()) {
            $this->thoi_gian_bat_dau = date('Y-m-d',strtotime($this->thoi_gian_bat_dau));
            return true;
        }

    }

    public function rules() {
        return array(
            array('thoi_gian_bat_dau, gia_ban, san_pham_id', 'required'),
            array('san_pham_id', 'numerical', 'integerOnly'=>true),
            array('gia_ban', 'numerical'),
            array('id, thoi_gian_bat_dau, gia_ban, san_pham_id', 'safe', 'on'=>'search'),
            array('thoi_gian_bat_dau', 'ext.custom-validator.CPOSDateTimeValidator'),
        );
    }

    public function them($params)
    {
        //kiem tra moc gia cua san pham nay co ton tai hay chua
        $productLabel = 'san_pham_id';
        $exist = $this->exists($productLabel . '=:' . $productLabel, array(':' . $productLabel => $params[$productLabel]));
        if ($exist) {
            $startDate = date('Y-m-d',strtotime($params['thoi_gian_bat_dau'])); //tim thu moc_gia_trung cua san pham
            $command = Yii::app()->db->createCommand("SELECT COUNT(*)
                                                       FROM tbl_MocGia
                                                       WHERE san_pham_id = '{$params[$productLabel]}' AND thoi_gian_bat_dau = '{$startDate}'");

            $count = $command->queryScalar();
            if ($count)
                return 'dup-error';

        }
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
        if (!$this->kiemTraTonTai($params)) {
            $this->setAttributes($params);
            if ($this->save())
                return 'ok';
            else
                return 'fail';
        } else {

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

    public function layThoiGianKeTiep() {
        $command = Yii::app()->db->createCommand();
        $command->select = 'MIN(thoi_gian_bat_dau)';
        $command->from = 'tbl_MocGia';
        $command->where = "san_pham_id='{$this->san_pham_id}' AND thoi_gian_bat_dau > '{$this->thoi_gian_bat_dau}'";
        return  $command->queryScalar();
    }

    public function layKhoangThoiGian() {
        $thoiGianKetThuc = $this->layThoiGianKeTiep();
        if($thoiGianKetThuc!='')
            return date('d-m-Y',strtotime($this->thoi_gian_bat_dau)) .' --> '. date('d-m-Y',strtotime($thoiGianKetThuc)-24*60*60);
        else
            return date('d-m-Y',strtotime($this->thoi_gian_bat_dau));
    }


}