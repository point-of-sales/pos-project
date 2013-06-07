<?php
$hd_ban_hang = $model->hoaDonBan;
$chi_tiet_hd_tra = $chiTietHoaDonTra->getData();
$chi_tiet_hd_hien_tai = $chiTietHoaDonHienTai->getData();
$chi_tiet_hang_tang = $chiTietHangTang->getData();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hóa đơn trả <?php echo $model->getBaseModel()->ma_chung_tu?></title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl.'/css/hoadon.css'?>" />
<script src="<?php echo Yii::app()->theme->baseUrl.'/js/hd-format.js'?>"></script>
</head>

<body>
<input id="p" type="hidden" value="<?php if(isset($_GET['p'])) echo $_GET['p']?>" />
<div id="hoa-don">
    <div id="hoa-don-header">
        <div id="hoa-don-header-company">
        	<?php echo $thong_tin->ten_cong_ty?><br />
            <?php echo $thong_tin->dia_chi?><br />
            <?php echo $thong_tin->dien_thoai?><br />
        </div>
        <div id="hoa-don-header-title">HÓA ĐƠN TRẢ HÀNG</div>
    </div>
    <div id="hoa-don-body">
        <div id="hoa-don-body-info-left">
            <table>
                <tr>
                    <td>Mã khách hàng</td>
                    <td><?php echo $hd_ban_hang->khachHang->ma_khach_hang?></td>
                </tr>
                <tr>
                    <td>Tên khách hàng</td>
                    <td><?php echo $hd_ban_hang->khachHang->ho_ten?></td>
                </tr>
                <tr>
                    <td>Số điện thoại</td>
                    <td><?php echo $hd_ban_hang->khachHang->dien_thoai?></td>
                </tr>
            </table>
        </div>
        <div id="hoa-don-body-info-right">
            <table>
                <tr>
                    <td>Mã hóa đơn</td>
                    <td><?php echo $model->getBaseModel()->ma_chung_tu?></td>
                </tr>
                <tr>
                    <td>Ngày lập</td>
                    <td><?php echo date('d/m/Y - h:i:s',strtotime($model->getBaseModel()->ngay_lap))?></td>
                </tr>
                <tr>
                    <td>Nhân viên trả hàng</td>
                    <td><?php echo $model->getBaseModel()->nhanVien->ho_ten?></td>
                </tr>
            </table>
        </div>
        <div class="clear"></div>
        <div id="hoa-don-body-detail">
        <?php
        if(!isset($_GET['p'])){
        ?>
            <table border="1" cellspacing="0" >
                <tr class="header">
                    <td>STT</td>
                    <td>Tên</td>
                    <td>Số lượng</td>
                    <td>Đơn giá</td>
                    <td>Thành tiền</td>
                </tr>
                <?php
                $i=1;
                $tong_hd_ban = 0;
                foreach($chi_tiet_hd_hien_tai as $cthd):
                ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td>
                        <?php echo $cthd->sanPham->ma_vach;?>
                        <br />
                        <?php echo $cthd->sanPham->ten_san_pham?>
                    </td>
                    <td><?php echo $cthd->so_luong?></td>
                    <td><?php echo number_format($cthd->don_gia,0,'.',',');?></td>
                    <td><?php echo number_format($cthd->don_gia*$cthd->so_luong,0,'.',',');?></td>
                </tr>
                <?php
                $i++;
                $tong_hd_ban += $cthd->don_gia*$cthd->so_luong;
                endforeach;
                
                $giam_gia = $tong_hd_ban*($hd_ban_hang->chiet_khau/100);
                
                foreach($chi_tiet_hang_tang as $cthd):
                ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td>
                        <?php echo $cthd->sanPhamTang->ma_vach;?>
                        <br />
                        <?php echo $cthd->sanPhamTang->ten_san_pham;?>
                    </td>
                    <td><?php echo $cthd->so_luong;?></td>
                    <td colspan="2">Hàng tặng</td>
                </tr>
                <?php
                $i++;
                endforeach;
                ?>
                <tr>
                    <td colspan="4">Tổng cộng</td>
                    <td><?php echo number_format($tong_hd_ban,0,'.',',')?></td>
                </tr>
                <tr>
                    <td colspan="4">Giảm giá <span><?php echo $hd_ban_hang->chiet_khau?>%</span></td>
                    <td><?php echo number_format($giam_gia,0,'.',',')?></td>
                </tr>
                <tr>
                    <td colspan="4">Kết quả</td>
                    <td><span id="tri-gia"><?php echo number_format($tong_hd_ban-$giam_gia,0,'.',',');?></span></td>
                </tr>
                <tr>
                    <td colspan="5">Bằng chữ: <span class="float-right" id="bang-chu"></span></td>
                </tr>
            </table>
        <?php
        }
        ?>
            
            <div style="text-align: center;">Sản phẩm trả: <?php echo count($chi_tiet_hd_tra)?></div>
            <div>Lý do trả hàng: <?php echo $model->ly_do_tra_hang?></div>
            <table border="1" cellspacing="0" >
                <tr class="header">
                    <td>STT</td>
                    <td>Tên</td>
                    <td>Số lượng</td>
                    <td>Đơn giá</td>
                    <td>Thành tiền</td>
                </tr>
                <?php
                $i=1;
                $tong = 0;
                foreach($chi_tiet_hd_tra as $cthd):
                ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td>
                        <?php echo $cthd->sanPham->ma_vach;?>
                        <br />
                        <?php echo $cthd->sanPham->ten_san_pham?>
                    </td>
                    <td><?php echo $cthd->so_luong?></td>
                    <td><?php echo number_format($cthd->don_gia,0,'.',',');?></td>
                    <td><?php echo number_format($cthd->don_gia*$cthd->so_luong,0,'.',',');?></td>
                </tr>
                <?php
                $i++;
                $tong += $cthd->don_gia*$cthd->so_luong;
                endforeach;
                ?>
                <tr>
                    <td colspan="4">Số tiền trả lại</td>
                    <td><span id="tri-gia-tien-tra"><?php echo number_format($tong*(1-$hd_ban_hang->chiet_khau/100),0,'.',',');?></span></td>
                </tr>
                <tr>
                    <td colspan="5">Bằng chữ: <span class="float-right" id="tien-tra-bang-chu"></span></td>
                </tr>
            </table>
        </div>
    </div>
    <div id="hoa-don-footer">Xin chân thành cảm ơn!</div>
</div>
</body>
</html>
<script type="text/javascript">
    var p = document.getElementById("p").value;
    if(p==""){
        var tri_gia = del_format(document.getElementById("tri-gia").textContent);
        var bang_chu = document.getElementById("bang-chu");
        bang_chu.textContent = docso(tri_gia)+' đồng';
    }
    var tri_gia_tien_tra = del_format(document.getElementById("tri-gia-tien-tra").textContent);
    var bang_chu = document.getElementById("tien-tra-bang-chu");
    bang_chu.textContent = docso(tri_gia_tien_tra)+' đồng';
    
    window.print();
    window.close();
</script>