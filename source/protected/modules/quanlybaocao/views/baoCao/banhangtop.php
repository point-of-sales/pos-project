<?php
/**
 * User: ${Cristazn}
 * Date: 5/14/13
 * Time: 10:19 AM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980
 */

$this->breadcrumbs = array(
    Yii::t('viLib', 'Report management') => array('baoCao/danhsach'),
    Yii::t('viLib', 'Report') => array('baoCao/baocao'),
    Yii::t('viLib', 'Top Sales Report'),
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'Import and Export Report'), 'url' => array('baoCao/nhapxuatton'),'visible'=>Yii::app()->user->checkAccess('Quanlybaocao.BaoCao.NhapXuatTon')),
    array('label' => Yii::t('viLib', 'Branch Sales Report'), 'url' => array('baoCao/banhangchinhanh'),'visible'=>Yii::app()->user->checkAccess('Quanlybaocao.BaoCao.BanHangChiNhanh')),
    array('label' => Yii::t('viLib', 'Product Sales Report'), 'url' => array('baoCao/banhangsanpham'),'visible'=>Yii::app()->user->checkAccess('Quanlybaocao.BaoCao.BanHangSanPham')),
    array('label' => Yii::t('viLib', 'Top Sales Report'), 'url' => array('baoCao/banhangtop'),'visible'=>Yii::app()->user->checkAccess('Quanlybaocao.BaoCao.BanHangTop')),
);

?>


<h1><?php echo Yii::t('viLib', 'Top Sales Report') ?></h1>
<div class="report-content">

    <?php if (Yii::app()->user->hasFlash('info-board')) { ?>
        <div
            class="response-msg error ui-corner-all info-board">
            <?php echo Yii::app()->user->getFlash('info-board'); ?>
        </div>
    <?php } ?>

    <?php

    if (!isset($thoi_gian_bat_dau) && !isset($thoi_gian_ket_thuc)) {
        ?>
        <div class="report-intro">
            <p><?php echo Yii::t('viLib', 'Choose time period to view Sales Status') ?></p>
            <img src="<?php echo Yii::app()->theme->baseUrl . '/images/topseller.png' ?>">
        </div>

    <?php
    }

    if (isset($sanPham)) {
        // doanh so san pham tren 1 chi nhanh
        echo '<div class="sub-title">';
        echo '<p>' . Yii::t('viLib', 'Time period') . ' : ' . $thoi_gian_bat_dau . ' --> ' . $thoi_gian_ket_thuc . '</p>';
        echo '</div>';

        if (isset($chiNhanh)) {
            //1 branch
            $series_data = SanPham::layDanhSachDoanhSoTongCacSanPham($sanPham->getData());
            $categories = SanPham::layDanhSachTenSanPham($sanPham->getData());
            $this->widget('ext.highcharts.HighchartsWidget', array(
                'options' => array(
                    'chart' => array(
                        'type' => 'column',
                    ),
                    'title' => array('text' => Yii::t('viLib', 'Top Sale Products Report on Branch')),
                    'xAxis' => array(
                        'categories' => $categories,
                    ),
                    'yAxis' => array(
                        'title' => array('text' => Yii::t('viLib', 'Sales')),
                    ),
                    'series' => array(array('name' => Yii::t('viLib', 'Sales status'),
                        'data' => $series_data,
                        'dataLabels' => array('enabled' => true),
                    )
                    ),
                    'credits' => array('enabled' => false),
                )
            ));
            //render branch
            $this->widget('zii.widgets.grid.CGridView', array(
                'dataProvider' => $chiNhanh,
                'columns' => array(
                    'ma_chi_nhanh',
                    'ten_chi_nhanh',
                    'dia_chi',
                    array(
                        'name' => 'trang_thai',
                        'value' => '$data->layTenTrangThai()'
                    ),

                ),
            ));

        } else {
            // multi branch
            $series_data = SanPham::layDanhSachDoanhSoTongCacSanPham($sanPham->getData());
            $categories = SanPham::layDanhSachTenSanPham($sanPham->getData());
            $this->widget('ext.highcharts.HighchartsWidget', array(
                'options' => array(
                    'chart' => array(
                        'type' => 'column',
                    ),
                    'title' => array('text' => Yii::t('viLib', 'Top Sale Products Report on Branchs')),
                    'xAxis' => array(
                        'categories' => $categories,
                    ),
                    'yAxis' => array(
                        'title' => array('text' => Yii::t('viLib', 'Sales')),
                    ),
                    'series' => array(array('name' => Yii::t('viLib', 'Sales status'),
                        'data' => $series_data,
                        'dataLabels' => array('enabled' => true),
                    )
                    ),
                    'credits' => array('enabled' => false),
                )
            ));
        }

    }

    ?>
</div>
