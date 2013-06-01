
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
    Yii::t('viLib', 'Import and Export Report'),
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'Import and Export Report'), 'url' => array('baoCao/nhapxuatton'), 'visible' => Yii::app()->user->checkAccess('Quanlybaocao.BaoCao.NhapXuatTon')),
    array('label' => Yii::t('viLib', 'Branch Sales Report'), 'url' => array('baoCao/banhangchinhanh'), 'visible' => Yii::app()->user->checkAccess('Quanlybaocao.BaoCao.BanHangChiNhanh')),
    array('label' => Yii::t('viLib', 'Top Sales Report'), 'url' => array('baoCao/banhangtop'), 'visible' => Yii::app()->user->checkAccess('Quanlybaocao.BaoCao.BanHangTop')),
    array('label' => Yii::t('viLib', 'Product Sales Report'), 'url' => array('baoCao/banhangsanpham'), 'visible' => Yii::app()->user->checkAccess('Quanlybaocao.BaoCao.BanHangSanPham')),
);

?>



<h1><?php echo Yii::t('viLib', 'Import and Export Report') ?></h1>
<div class="report-content">
    <?php

    if (!isset($chiNhanh) && !isset($model)) {
        ?>
        <div class="report-intro">
            <p><?php echo Yii::t('viLib', 'Choose a branch to view Import & Export Status') ?></p>
            <img src="<?php echo Yii::app()->theme->baseUrl . '/images/stock.png' ?>">
        </div>

    <?php
    }

    if (isset($chiNhanh)) {
        $this->widget('ext.custom-widgets.DetailView4Col', array(
            'id' => 'report-branch-detail',
            'data' => $chiNhanh,
            'attributes' => array(
                'ma_chi_nhanh',
                'ten_chi_nhanh',
                array(
                    'name' => 'trang_thai',
                    'value' => $chiNhanh->layTenTrangThai(),
                ),
                array(
                    'name' => 'truc_thuoc_id',
                    'value' => $chiNhanh->layTenTrucThuoc(),
                ),
                array(
                    'name' => 'loai_chi_nhanh_id',
                    'value' => $chiNhanh->layTenLoaiChiNhanh(),
                ),
                array(
                    'name' => 'khu_vuc_id',
                    'value' => $chiNhanh->layTenKhuVuc(),
                ),
            ),
        ));


        ?>

        <div class="total">
            <?php if (isset($model)): ?>
                <?php
                $danhSachSanPham = $model->getData();
                $tongSoTonDauKy = 0;
                $tongSoNhapTrongKy = 0;
                $tongSoXuatTrongKy = 0;
                $tongSoHangBan = 0;
                $tongSoThucTon = 0;
                foreach ($danhSachSanPham as $sanPham) {
                    $tongSoTonDauKy = $tongSoTonDauKy + $sanPham->ton_dau_ky;
                    $tongSoNhapTrongKy = $tongSoNhapTrongKy + $sanPham->so_luong_nhap;
                    $tongSoHangBan = $tongSoHangBan + $sanPham->so_luong_ban;
                    $tongSoXuatTrongKy = $tongSoXuatTrongKy + $sanPham->so_luong_xuat;
                    $tongSoThucTon = $tongSoThucTon + $sanPham->so_luong_thuc_ton;
                }
                ?>

                <p><?php echo Yii::t('viLib', 'Total Beginning Instock') . ' : ' . $tongSoTonDauKy ?></p>
                <p><?php echo Yii::t('viLib', 'Total Import') . ' : ' . $tongSoNhapTrongKy ?></p>
                <p><?php echo Yii::t('viLib', 'Total Export') . ' : ' . $tongSoXuatTrongKy ?></p>
                <p><?php echo Yii::t('viLib', 'Total Sale') . ' : ' . $tongSoHangBan ?></p>
                <p><?php echo Yii::t('viLib', 'Total Real Instock') . ' : ' . $tongSoThucTon ?></p>

            <?php endif; ?>

        </div>

        <?php if (Yii::app()->user->hasFlash('info-board')) { ?>
            <div
                class="response-msg error ui-corner-all info-board">
                <?php echo Yii::app()->user->getFlash('info-board'); ?>
            </div>
        <?php } ?>

        <?php
        if (isset($model)) {
            if (!empty($thoi_gian_bat_dau) && !empty($thoi_gian_ket_thuc)) {
                echo '<div class="sub-title">';
                echo '<p>' . Yii::t('viLib', 'Time period') . ' : ' . $thoi_gian_bat_dau . ' --> ' . $thoi_gian_ket_thuc . '</p>';
                echo '</div>';
            }
            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'grid',
                'dataProvider' => $model,
                'columns' => array(
                    'ma_vach',
                    'ten_san_pham',
                    array(
                        'name' => Yii::t('viLib', 'Current price'),
                        'value' => 'number_format(floatval($data->layGiaHienTai()),0,".",",")',
                    ),
                    array(
                        'name' => Yii::t('viLib', 'Beginning instock'),
                        'value' => 'number_format(floatval($data->ton_dau_ky),0,".",",")',
                    ),
                    array(
                        'name' => Yii::t('viLib', 'Import quantity'),
                        'value' => 'number_format(floatval($data->so_luong_nhap),0,".",",")',
                    ),
                    array(
                        'name' => Yii::t('viLib', 'Export quantity'),
                        'value' => 'number_format(floatval($data->so_luong_xuat),0,".",",")',
                    ),
                    array(
                        'name' => Yii::t('viLib', 'Sale quantity'),
                        'value' => 'number_format(floatval($data->so_luong_ban),0,".",",")',
                    ),
                    array(
                        'name' => Yii::t('viLib', 'Real instock'),
                        'value' => 'number_format(floatval($data->so_luong_thuc_ton),0,".",",")',
                    ),

                )
            ));
        }
    }
    ?>
</div>

<script>
    $(document).ready(function () {
        var showLink = <?php echo isset($model)?1:0;?>;
        if (!showLink) {
            $(".cus-link").hide();
        } else
            $(".cus-link").show();
    });
</script>
