<?php

Yii::import('application.models._base.BaseSanPhamTang');

class SanPhamTang extends BaseSanPhamTang
{
    public $chi_nhanh_id;

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    public static function label($n = 1) {
        if($n <= 1 ) {
            return Yii::t('viLib', 'Gift product');
        } else {
            return Yii::t('viLib', 'Gift products');
        }
    }
    
    
    
    public function relations() {
		return array(
			'tblChiNhanhs' => array(self::MANY_MANY, 'ChiNhanh', 'tbl_SanPhamTangChiNhanh(san_pham_tang_id, chi_nhanh_id)'),
            'sanPhamTangChiNhanh'=> array(self::HAS_MANY, 'SanPhamTangChiNhanh', 'san_pham_tang_id'),
            'nhaCungCap'=> array(self::BELONGS_TO,'NhaCungCap','nha_cung_cap_id')
		);
    }
/*
    public function relations() {
        return array(
            'tblChiNhanhs' => array(self::MANY_MANY, 'ChiNhanh', 'tbl_SanPhamTangChiNhanh(san_pham_tang_id, chi_nhanh_id)'),
            'sanPhamTangChiNhanh'=>array(self::HAS_MANY,'SanPhamTangChiNhanh','san_pham_tang_id'),
        );
    }*/

    public function rules() {
        return array(
            array('ma_vach, ten_san_pham, gia_tang, thoi_gian_bat_dau, thoi_gian_ket_thuc, trang_thai', 'required'),
            array('trang_thai', 'numerical', 'integerOnly'=>true),
            array('gia_tang', 'numerical'),
            array('ma_vach', 'length', 'max'=>15),
            array('ten_san_pham', 'length', 'max'=>100),
            array('mo_ta', 'safe'),
            array('mo_ta', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, ma_vach, ten_san_pham, gia_tang, thoi_gian_bat_dau, thoi_gian_ket_thuc, mo_ta, trang_thai', 'safe', 'on'=>'search'),
            array('thoi_gian_bat_dau', 'ext.custom-validator.CPOSDateTimeValidator','on'=>'them'),
            array('thoi_gian_ket_thuc', 'ext.custom-validator.CPOSDateTimeValidator','on'=>'them'),
            array('thoi_gian_ket_thuc','compare','compareAttribute'=>'thoi_gian_bat_dau','operator'=>'>','allowEmpty'=>false,'message'=>Yii::t('viLib','End time have to greater start time')),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => Yii::t('viLib', 'ID'),
            'ma_vach' => Yii::t('viLib', 'Barcode'),
            'ten_san_pham' => Yii::t('viLib', 'Product name'),
            'gia_tang' => Yii::t('viLib', 'Bill value for offering'),
            'thoi_gian_bat_dau' => Yii::t('viLib', 'Start date'),
            'thoi_gian_ket_thuc' => Yii::t('viLib', 'End date'),
            'mo_ta' => Yii::t('viLib', 'Description'),
            'trang_thai'=>Yii::t('viLib', 'Status'),
            'tblChiNhanhs' => null,
        );
    }

    public function them($params)
    {
        // kiem tra du lieu con bi trung hay chua
        $this->scenario = 'them';
        if (!$this->kiemTraTonTai($params)) {
            //neu khoa chua ton tai
            $this->setAttributes($params);
            $relatedData = array(
                //'tblChiNhanhs' => $_POST['SanPhamTang']['tblChiNhanhs'] === '' ? null : $_POST['SanPhamTang']['tblChiNhanhs'],
            );
            if ($this->saveWithRelated($relatedData))
                return 'ok';
            else
                return 'fail';
        } else
            return 'dup-error';
    }

    public function capNhat($params)
    {
        $this->scenario = 'capnhat';
        // kiem tra du lieu con bi trung hay chua
        $relatedData = array(
            //'tblChiNhanhs' => $_POST['SanPhamTang']['tblChiNhanhs'] === '' ? null : $_POST['SanPhamTang']['tblChiNhanhs'],
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

    public function search() {
        $criteria = new CDbCriteria;
        $cauHinh = CauHinh::model()->findByPk(1);
        $criteria->compare('ma_vach', $this->ma_vach, true);
        $criteria->compare('ten_san_pham', $this->ten_san_pham, true);
        $criteria->compare('gia_tang', $this->gia_tang);

        $numberRecords = $cauHinh->so_muc_tin_tren_trang;

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>$numberRecords,
            ),
        ));
    }

    public function xuatFileExcel()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('ma_vach', $this->ma_vach, true);
        $criteria->compare('ten_san_pham', $this->ten_san_pham, true);
        $criteria->compare('gia_tang', $this->gia_tang);
        $criteria->compare('thoi_gian_bat_dau', $this->thoi_gian_bat_dau, true);
        $criteria->compare('thoi_gian_ket_thuc', $this->thoi_gian_ket_thuc, true);
        $criteria->compare('mo_ta', $this->mo_ta, true);

        /*$event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['SanPhamTang'];
        $this->onAfterExport($event);*/

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    // ton tai chi nhanh id

    public function laySoLuongTonHienTai() {
        return Yii::app()->db->createCommand()
            ->select("so_ton")
            ->from('tbl_SanPhamTangChiNhanh')
            ->where('san_pham_tang_id=:san_pham_tang_id AND chi_nhanh_id=:chi_nhanh_id',array(':san_pham_tang_id'=>$this->id, ':chi_nhanh_id'=>$this->chi_nhanh_id))
            ->queryScalar();
    }

    public static function laySanPhamTang($chi_nhanh_id,$tri_gia){
        /*$crt = new CDbCriteria;
        $crt->with = 'sanPhamTangChiNhanh';
        $crt->together = true;
        $crt->compare('sanPhamTangChiNhanh.chi_nhanh_id',$chi_nhanh_id);
        $crt->addCondition('gia_tang <='.$tri_gia);
        $crt->addCondition('so_ton >= 0');
        
        return SanPhamTang::model()->findAll($crt);*/
            
        return Yii::app()->db->createCommand()
                ->select('*')
                ->from('tbl_SanPhamTang sp, tbl_SanPhamTangChiNhanh cn')
                ->where(
                    'sp.id = cn.san_pham_tang_id AND chi_nhanh_id = :chi_nhanh_id AND so_ton >0 AND gia_tang <= :gia_tang',
                    array(':chi_nhanh_id'=>$chi_nhanh_id,':gia_tang'=>$tri_gia)
                    )
                ->queryAll();
    }
    
    // tong luong ton tren tat ca chi nhanh
    public function layTongSoLuongTon()
    {
        return Yii::app()->db->createCommand()
            ->select('sum(so_ton)')
            ->from('tbl_SanPhamTangChiNhanh')
            ->where('san_pham_tang_id=:san_pham_tang_id', array(':san_pham_tang_id' => $this->id))
            ->queryScalar();
    }

    public function layDanhSachChiNhanh()
    {
        $chiNhanh = new ChiNhanh();
        $chiNhanh->san_pham_id = $this->id;
        $dataProvider = $chiNhanh->searchSanPhamTang();
        $danhSachChiNhanh = $dataProvider->getData();
        foreach ($danhSachChiNhanh as $chiNhanhCon)
            $chiNhanhCon->san_pham_id = $this->id;

        return $dataProvider;
    }
}