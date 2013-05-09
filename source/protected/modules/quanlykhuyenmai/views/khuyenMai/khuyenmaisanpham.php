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
    array('label' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Promotion'), 'url' => array('them')),
    array('label' => Yii::t('viLib', 'Export') . ' ' . Yii::t('viLib', 'Promotion'), 'url' => array('xuatkhuyenmaisanpham')),

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
            array('name'=>'loai_san_pham_id',
                  'value'=>'$data->loaiSanPham->ten_loai',
            ),
            array('name' => Yii::t('viLib', 'Status'),
                'value' => '$data->layTenTrangThai()',
            ),
            array('name' => Yii::t('viLib', 'Supplier'),
                'value' => '$data->nhaCungCap->ten_nha_cung_cap',
            ),
            array('name' => 'khuyen_mai_id',
                'type' => 'raw',
                'value' => 'GxHtml::activeDropDownList($data,"khuyen_mai_id",GxHtml::encodeEx(GxHtml::listDataEx(KhuyenMai::layDanhSachKhuyenMaiKichHoat(),null,"ten_chuong_trinh")), array("onchange"=>"submitPromotionValue($data->id,this)",  "prompt"=>Yii::t("viLib","Promotion not available")))',
            ),

        ),

    )
);