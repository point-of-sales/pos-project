<script type="text/javascript">

    function submitPromotionValue(id, selectHTMLObject) {
        var kmid = selectHTMLObject.options[selectHTMLObject.selectedIndex].value;
        if (kmid == '')
            kmid = 0;

        var strUrl = 'capnhatkhuyenmai/spid/' + id + '/kmid/' + kmid;
        $.ajax({
            url: strUrl,
            type: "POST",
            success: function (response) {
                $.fn.yiiGridView.update('grid', {
                    data: $(this).serialize()
                });
            }
        });
    }

</script>


<?php
/**
 * User: ${Cristazn}
 * Date: 5/9/13
 * Time: 12:58 AM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980
 */


$this->breadcrumbs = array(
    Yii::t('viLib', 'Promotion management') => array('khuyenMai/danhsach'),
    Yii::t('viLib', 'Promotion') => array('khuyenMai/danhsach'),
    Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Promotion product'),
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Promotion'), 'url' => array('them'),'visible'=>Yii::app()->user->checkAccess('Quanlykhuyenmai.KhuyenMai.Them')),
    array('label' => Yii::t('viLib', 'Export') . ' ' . Yii::t('viLib', 'Promotion'), 'url' => array('xuatkhuyenmaisanpham'),'visible'=>Yii::app()->user->checkAccess('Quanlykhuyenmai.KhuyenMai.XuatKhuyenMaiSanPham')),

);

Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1><?php echo Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Promotion product'); ?></h1>
<div class="search-form">
    <?php $this->renderPartial('_searchsanpham', array(
        'model' => $model,
    )); ?>
</div><!-- search-form -->

<?php



$this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'grid',
        'dataProvider' => $sanPhamDataProvider,
        'columns' => array(
            'ma_vach',
            'ten_san_pham',

            array('name' => Yii::t('viLib', 'Status'),
                'value' => '$data->layTenTrangThai()',
            ),
            array('name' => Yii::t('viLib', 'Supplier'),
                'value' => '$data->nhaCungCap->ten_nha_cung_cap',
            ),
            'gia_goc'=>array(
                'name'=>'gia_goc',
                'value'=>'number_format($data->gia_goc,"0",".",",")'
            ),
            array(
                'name'=>'gia_hien_tai',
                'header'=>Yii::t('viLib','Current price'),
                'value'=>'is_numeric($data->layGiaHienTai())?number_format(floatval($data->layGiaHienTai()),0,".",","):$data->layGiaHienTai()'
            ),
            array(
                'name'=>'gia_kem_khuyen_mai',
                'header'=>Yii::t('viLib','Price with promotion'),
                'value'=>'is_numeric($data->layGiaHienTaiKemKhuyenMai())?number_format(floatval($data->layGiaHienTaiKemKhuyenMai()),0,".",","):$data->layGiaHienTaiKemKhuyenMai()'
            ),


            array('name' => 'khuyen_mai_id',
                'type' => 'raw',
                'value' => 'GxHtml::activeDropDownList($data,"khuyen_mai_id",GxHtml::encodeEx(GxHtml::listDataEx(KhuyenMai::layDanhSachKhuyenMaiKichHoat(),null,"ten_chuong_trinh")), array("onchange"=>"submitPromotionValue($data->id,this)",  "prompt"=>Yii::t("viLib","Promotion not available")))',
            ),


        ),

    )
);