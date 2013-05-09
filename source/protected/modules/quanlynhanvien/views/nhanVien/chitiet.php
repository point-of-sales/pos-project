<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Employee management') => array('nhanVien/danhsach'),
    Yii::t('viLib', 'Employee') => array('nhanVien/danhsach'),
    Yii::t('viLib', 'Detail') => array(),
    GxHtml::valueEx($model),
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Employee'), 'url' => array('danhsach')),
    array('label' => Yii::t('viLib', 'Add') . ' ' . Yii::t('viLib', 'Employee'), 'url' => array('them')),
    array('label' => Yii::t('viLib', 'Update') . ' ' . Yii::t('viLib', 'Employee'), 'url' => array('capnhat', 'id' => $model->id)),
);
?>


    <h1><?php echo Yii::t('viLib', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('ext.custom-widgets.DetailView4Col', array(
    'data' => $model,
    'attributes' => array(
        'ma_nhan_vien',
        'ho_ten',
        'email',
        'dien_thoai',
        'dia_chi',
        array(
            'name' => 'gioi_tinh',
            'value' => $model->layTenGioiTinh(),
        ),
        array(
            'name' => 'ngay_sinh',
            'value' => $model->ngay_sinh,
        ),
        'trinh_do',
        'luong_co_ban',
        'chuyen_mon',
        'trang_thai',
        'mat_khau',
        array(
            'name' => 'ngay_vao_lam',
            'value' => $model->ngay_vao_lam,
        ),
        array(
            'name' => 'lan_dang_nhap_cuoi',
            'value' => $model->lan_dang_nhap_cuoi,
        ),
        array(
            'name' => 'loaiNhanVien',
            'type' => 'raw',
            'value' => $model->loaiNhanVien !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->loaiNhanVien)), array('loaiNhanVien/view', 'id' => GxActiveRecord::extractPkValue($model->loaiNhanVien, true))) : null,
        ),
        array(
            'name' => 'chiNhanh',
            'type' => 'raw',
            'value' => $model->chiNhanh !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->chiNhanh)), array('chiNhanh/view', 'id' => GxActiveRecord::extractPkValue($model->chiNhanh, true))) : null,
        ),
    ),
)); ?>