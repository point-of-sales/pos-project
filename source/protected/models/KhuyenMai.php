<?php

Yii::import('application.models._base.BaseKhuyenMai');

class KhuyenMai extends BaseKhuyenMai
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function rules()
    {
        return array(
            array('ma_chuong_trinh, trang_thai, ten_chuong_trinh,thoi_gian_bat_dau, thoi_gian_ket_thuc, gia_giam', 'required'),
            array('gia_giam, trang_thai', 'numerical', 'integerOnly' => true),
            array('ma_chuong_trinh', 'length', 'max' => 15),
            array('ten_chuong_trinh', 'length', 'max' => 200),
            array('mo_ta, thoi_gian_bat_dau, thoi_gian_ket_thuc', 'safe'),
            array('ten_chuong_trinh, mo_ta, gia_giam, thoi_gian_bat_dau, thoi_gian_ket_thuc', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, ma_chuong_trinh, ten_chuong_trinh, mo_ta, gia_giam, thoi_gian_bat_dau, thoi_gian_ket_thuc, trang_thai', 'safe', 'on' => 'search'),
            array('thoi_gian_bat_dau', 'ext.custom-validator.CPOSDateTimeValidator', 'on' => 'them'),
            array('thoi_gian_ket_thuc', 'ext.custom-validator.CPOSDateTimeValidator', 'on' => 'them'),
            //array('thoi_gian_ket_thuc', 'compare', 'compareAttribute' => 'thoi_gian_bat_dau', 'operator' => '>', 'allowEmpty' => false, 'message' => Yii::t('viLib', 'End time have to greater start time')),
        );
    }

    public function them($params)
    {
        // kiem tra du lieu con bi trung hay chua

        if (!$this->kiemTraTonTai($params)) {
            //neu khoa chua ton tai
            $this->setAttributes($params);
            $relatedData = array( //'tblChiNhanhs' => $_POST['KhuyenMai']['tblChiNhanhs'] === '' ? null : $_POST['KhuyenMai']['tblChiNhanhs'],
            );
            if ($this->saveWithRelated($relatedData))
                return 'ok';
            else
                return 'fail';
        } else
            return 'dup-error';
    }

    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('viLib', 'ID'),
            'ma_chuong_trinh' => Yii::t('viLib', 'Promotion program code'),
            'ten_chuong_trinh' => Yii::t('viLib', 'Promotion program name'),
            'mo_ta' => Yii::t('viLib', 'Description'),
            'gia_giam' => Yii::t('viLib', 'Promo price'),
            'thoi_gian_bat_dau' => Yii::t('viLib', 'Start date'),
            'thoi_gian_ket_thuc' => Yii::t('viLib', 'End date'),
            'trang_thai' => Yii::t('viLib', 'Status'),
            'chiNhanh' => null,
            'tblChiNhanhs' => null,
        );
    }

    public function relations() {
        return array(
            'tblChiNhanhs' => array(self::MANY_MANY, 'ChiNhanh', 'tbl_KhuyenMaiChiNhanh(khuyen_mai_id, chi_nhanh_id)'),
            //'sanPham'=> array(self::)
        );
    }


    public function capNhat($params)
    {
        // kiem tra du lieu con bi trung hay chua
        $relatedData = array(
            'tblChiNhanhs' => $_POST['KhuyenMai']['tblChiNhanhs'] === '' ? null : $_POST['KhuyenMai']['tblChiNhanhs'],
        );
        if (!$this->kiemTraTonTai($params)) {
            $this->setAttributes($params);
            if ($this->saveWithRelated($relatedData))
                return 'ok';
            else
                return 'fail';
        } else {

            // so sanh ma cu == ma moi
            if ($this->soKhopMa($params)) {
                $this->setAttributes($params);
                if ($this->saveWithRelated($relatedData))
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


    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('ma_chuong_trinh', $this->ma_chuong_trinh, true);
        $criteria->compare('ten_chuong_trinh', $this->ten_chuong_trinh, true);
        $criteria->compare('mo_ta', $this->mo_ta, true);
        $criteria->compare('gia_giam', $this->gia_giam);

        $preCheckCriteria = new CDbCriteria();
        if (isset($this->thoi_gian_bat_dau)) {
            $result_1 = array();
            if (strtotime($this->thoi_gian_bat_dau) < strtotime($this->thoi_gian_ket_thuc)) {
                $date = date('Y-m-d', strtotime($this->thoi_gian_bat_dau));
                $preCheckCriteria->addCondition("'$date'" . ' BETWEEN thoi_gian_bat_dau AND thoi_gian_ket_thuc', 'OR');
                $result_1 = KhuyenMai::model()->findAll($preCheckCriteria);
            }
        }

        if (isset($this->thoi_gian_ket_thuc)) {
            $result_2 = array();
            if (strtotime($this->thoi_gian_bat_dau) < strtotime($this->thoi_gian_ket_thuc)) {
                $date = date('Y-m-d', strtotime($this->thoi_gian_ket_thuc));
                $preCheckCriteria->addCondition("'$date'" . ' BETWEEN thoi_gian_bat_dau AND thoi_gian_ket_thuc', 'OR');
                $result_2 = KhuyenMai::model()->findAll($preCheckCriteria);
            }
        }

        if (!empty($result_1)) {
            $date = date('Y-m-d', strtotime($this->thoi_gian_bat_dau));
            $criteria->addCondition("'$date'" . ' BETWEEN thoi_gian_bat_dau AND thoi_gian_ket_thuc', 'OR');
        }
        if (!empty($result_2)) {
            $date = date('Y-m-d', strtotime($this->thoi_gian_ket_thuc));
            $criteria->addCondition("'$date'" . ' BETWEEN thoi_gian_bat_dau AND thoi_gian_ket_thuc', 'OR');
        }
        if (empty($result_1) && empty($result_2)) {
            $criteria->compare('thoi_gian_bat_dau', $this->thoi_gian_bat_dau, true);
            $criteria->compare('thoi_gian_bat_dau', $this->thoi_gian_ket_thuc, true);
        }

        $criteria->compare('trang_thai', $this->trang_thai);


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function xuatFileExcel()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('ma_chuong_trinh', $this->ma_chuong_trinh, true);
        $criteria->compare('ten_chuong_trinh', $this->ten_chuong_trinh, true);
        $criteria->compare('mo_ta', $this->mo_ta, true);
        $criteria->compare('gia_giam', $this->gia_giam);

        $preCheckCriteria = new CDbCriteria();
        if (isset($this->thoi_gian_bat_dau)) {
            $result_1 = array();
            if (strtotime($this->thoi_gian_bat_dau) < strtotime($this->thoi_gian_ket_thuc)) {
                $date = date('Y-m-d', strtotime($this->thoi_gian_bat_dau));
                $preCheckCriteria->addCondition("'$date'" . ' BETWEEN thoi_gian_bat_dau AND thoi_gian_ket_thuc', 'OR');
                $result_1 = KhuyenMai::model()->findAll($preCheckCriteria);
            }
        }

        if (isset($this->thoi_gian_ket_thuc)) {
            $result_2 = array();
            if (strtotime($this->thoi_gian_bat_dau) < strtotime($this->thoi_gian_ket_thuc)) {
                $date = date('Y-m-d', strtotime($this->thoi_gian_ket_thuc));
                $preCheckCriteria->addCondition("'$date'" . ' BETWEEN thoi_gian_bat_dau AND thoi_gian_ket_thuc', 'OR');
                $result_2 = KhuyenMai::model()->findAll($preCheckCriteria);
            }
        }

        if (!empty($result_1)) {
            $date = date('Y-m-d', strtotime($this->thoi_gian_bat_dau));
            $criteria->addCondition("'$date'" . ' BETWEEN thoi_gian_bat_dau AND thoi_gian_ket_thuc', 'OR');
        }
        if (!empty($result_2)) {
            $date = date('Y-m-d', strtotime($this->thoi_gian_ket_thuc));
            $criteria->addCondition("'$date'" . ' BETWEEN thoi_gian_bat_dau AND thoi_gian_ket_thuc', 'OR');
        }
        if (empty($result_1) && empty($result_2)) {
            $criteria->compare('thoi_gian_bat_dau', $this->thoi_gian_bat_dau, true);
            $criteria->compare('thoi_gian_bat_dau', $this->thoi_gian_ket_thuc, true);
        }

        $criteria->compare('trang_thai', $this->trang_thai);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));

    }
        public function layDanhSachChiNhanh() {
            $danhSachUl = '<ul>';
            $danhSachChiNhanh = $this->tblChiNhanhs;
            foreach($danhSachChiNhanh as $chiNhanh) {
                $danhSachUl = $danhSachUl . '<li> - ' . $chiNhanh->ten_chi_nhanh . '</li>';
            }
            $danhSachUl = $danhSachUl . '</ul>';
            echo  $danhSachUl;
        }
}