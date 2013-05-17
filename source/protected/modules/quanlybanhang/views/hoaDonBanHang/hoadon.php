<?php
$hd_ban_hang = Yii::app()->CPOSSessionManager->getKey('hoa_don');
$cthd_ban_hang = $hd_ban_hang['cthd_ban_hang'];
$khach_hang = $hd_ban_hang['khach_hang'];
$giam_gia = $hd_ban_hang['tong']*($hd_ban_hang['chiet_khau']/100);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hóa đơn bán lẻ <?php echo $hd_ban_hang['ma_chung_tu']?></title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl.'/css/hoadon.css'?>" />
<script src="<?php echo Yii::app()->theme->baseUrl.'/js/hd-format.js'?>"></script>
</head>

<body>
<div id="hoa-don">
    <div id="hoa-don-header">
        <div id="hoa-don-header-company">
        	CTY TNHH một đống thành viên ABC<br />
            123 heaven<br />
            01667123456<br />
        </div>
        <div id="hoa-don-header-title">HÓA ĐƠN BÁN LẺ</div>
    </div>
    <div id="hoa-don-body">
        <div id="hoa-don-body-info-left">
            <table>
                <tr>
                    <td>Mã khách hàng</td>
                    <td><?php echo $khach_hang['ma_khach_hang']?></td>
                </tr>
                <tr>
                    <td>Tên khách hàng</td>
                    <td><?php echo $khach_hang['ho_ten']?></td>
                </tr>
                <tr>
                    <td>Số điện thoại</td>
                    <td><?php echo $khach_hang['dien_thoai']?></td>
                </tr>
            </table>
        </div>
        <div id="hoa-don-body-info-right">
            <table>
                <tr>
                    <td>Mã hóa đơn</td>
                    <td><?php echo $hd_ban_hang['ma_chung_tu']?></td>
                </tr>
                <tr>
                    <td>Ngày lập</td>
                    <td><?php echo $hd_ban_hang['ngay_lap']?></td>
                </tr>
                <tr>
                    <td>Nhân viên bán hàng</td>
                    <td><?php echo $hd_ban_hang['nhan_vien_id']?></td>
                </tr>
            </table>
        </div>
        <div class="clear"></div>
        <div id="hoa-don-body-detail">
            <table border="1" cellspacing="0" >
                <tr>
                    <td>STT</td>
                    <td>Tên</td>
                    <td>Số lượng</td>
                    <td>Đơn giá</td>
                    <td>Thành tiền</td>
                </tr>
                <?php
                $i=1;
                foreach($cthd_ban_hang as $cthd):
                ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td>
                        <?php echo $cthd['ma_vach'];?>
                        <br />
                        <?php echo $cthd['ten_san_pham'];?>
                    </td>
                    <td><?php echo $cthd['so_luong'];?></td>
                    <td><?php echo number_format($cthd['don_gia'],0,'.',',');?></td>
                    <td><?php echo number_format($cthd['thanh_tien'],0,'.',',');?></td>
                </tr>
                <?php
                $i++;
                endforeach;
                ?>
                <tr>
                    <td colspan="4">Tổng cộng</td>
                    <td><?php echo number_format($hd_ban_hang['tong'],0,'.',',')?></td>
                </tr>
                <tr>
                    <td colspan="4">Giảm giá <span><?php echo $hd_ban_hang['chiet_khau']?>%</span></td>
                    <td><?php echo number_format($giam_gia,0,'.',',')?></td>
                </tr>
                <tr>
                    <td colspan="4">Kết quả</td>
                    <td><span id="tri-gia"><?php echo number_format($hd_ban_hang['tri_gia'],0,'.',',');?></span></td>
                </tr>
                <tr>
                    <td colspan="5">Bằng chữ: <span id="bang-chu"></span></td>
                </tr>
            </table>
        </div>
    </div>
    <div id="hoa-don-footer">Xin chân thành cảm ơn!</div>
</div>
</body>
</html>
<script type="text/javascript">
    var tri_gia = del_format(document.getElementById("tri-gia").textContent);
    var bang_chu = document.getElementById("bang-chu");
    bang_chu.textContent = docso(tri_gia)+' đồng';
    
    window.print();
    window.close();
</script>