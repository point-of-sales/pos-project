<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/banhang.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/hd-format.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/banhang.css');
/*
echo '<pre>';
print_r(Yii::app()->session['hd_ban_hang']);
echo '</pre>';
*/
?>
<?php  if(Yii::app()->user->hasFlash('info-board')) {?>    <div class="response-msg error ui-corner-all info-board">        <?php echo Yii::app()->user->getFlash('info-board');?>    </div><?php } ?>
<input type="hidden" id="base-url" value="<?php echo Yii::app()->request->baseUrl?>" />
<div id="form-hd-ban">
<?php $form = $this->beginWidget('GxActiveForm', array(
	'enableAjaxValidation' => false,
    'id' => 'form',
));
?>
<?php echo $form->hiddenField($model, 'id') ?>
	<div id="form-hd-ban-header">
    	<div id="form-hd-ban-header-left">
            <table id="form-hd-ban-table">
                <tr>
                    <td>Mã hóa đơn</td>
                    <td><span style="font-size: 18px;" id="form-hd-ban-ma-hoa-don"></span></td>
                </tr>
                <tr>
                    <td>Chi nhánh</td>
                    <td>
                        <span id="form-hd-ban-chi-nhanh"></span>
                    </td>
                </tr>
            </table>
        </div>
        <div id="form-hd-ban-header-center"><h1>TẠO HÓA ĐƠN BÁN HÀNG</h1></div>
        <div id="form-hd-ban-header-right">
            <table id="form-hd-ban-header-table">
            	<tr>
                	<td>Họ tên nhân viên</td>
                    <td>
                        <span id="form-hd-ban-ho-ten-nv"></span>
                    </td>
                </tr>
                
            </table>
        </div>
    </div>
    <div id="form-hd-ban-info">
    	<div id="form-hd-ban-info-left">
            <div id="form-hd-ban-ma">
            	<span id="form-hd-ban-ma-label">Mã vạch</span>
                <span><input id="form-hd-ban-ma-input" type="text" onkeypress="keypressInputMa(event)" /></span>
                <div class="" id="form-hd-ban-error"></div>
            </div>
        </div>
        <div id="form-hd-ban-info-right">
            <table id="form-hd-ban-info-table">
            	<tr>
                	<td class="form-hd-ban-label">Họ tên</td>
                    <td><span id="form-hd-ban-ho-ten-kh"></span></td>
                    <td class="form-hd-ban-label" style="font-weight: bold;">Tổng</td>
                    <td><span id="form-hd-ban-tong">0</span></td>
                </tr>
                <tr>
                	<td class="form-hd-ban-label">Chiết khấu</td>
                    <td><span id="form-hd-ban-chiet-khau">0</span><span>%</span></td>
                    <td class="form-hd-ban-label" style="font-weight: bold;" >Trị giá</td>
                    <td><span id="form-hd-ban-tri-gia" style="color: red;font-weight: bold;">0</span></td>
                </tr>
                <tr>
                	<td class="form-hd-ban-label">Số tiền nhận</td>
                    <td><span id="form-hd-ban-so-tien-nhan">0</span></td>
                    <td class="form-hd-ban-label">Tiền dư</td>
                    <td><span id="form-hd-ban-tien-du">0</span></td>
                </tr>
            </table>
        </div>
    </div>
    <div id="form-hd-ban-list">
        <div id="grid" class="grid-view">
            <table class="items" id="items">
                <tr>
                    <th>Mã vạch</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                    <th></th>
                </tr>
            </table>
        </div>
    </div>
    <div id="form-hd-ban-command">
    	<div id="form-hd-ban-button">
            <input class="button" type="button" value="Hóa đơn mới" onclick="hoaDonMoi()" />
            <input class="button" type="submit" value="In hóa đơn" />
        </div>
    </div>
    
    <?php $this->endWidget();?>
</div>

<div id="form-hd-ban-footer">
    <ul>
        <li><span class="label">Z</span>: MÃ VẠCH</li>
        <li><span class="label">X</span>: KHÁCH HÀNG</li>
        <li><span class="label">C</span>: TIỀN NHẬN</li>
        <!--<li><span class="label">F1</span>: TÌM KHÁCH HÀNG</li>-->
        <li><span class="label">F1</span>: HÀNG TẶNG</li>
    </ul>
</div>

<div id="dialog-tim-khach-hang" title="Tìm khách hàng"></div>
<div id="dialog-them-khach-hang" title="Thêm khách hàng"></div>
<div id="dialog-hang-tang" title="Sản phẩm tặng">
    <div id="dialog-hang-tang-header">
        <div id="dialog-hang-tang-ma">
            <span id="dialog-hang-tang-ma-label">Mã hàng tặng</span>
            <input id="dialog-hang-tang-ma-input" type="text" onkeypress="keypressInputMaHT(event)" />
            <span id="dialog-hang-tang-error"></span>
        </div>
        <div>
            <span id="dialog-hang-tang-list"></span>
        </div>
    </div>
    <div id="dialog-hang-tang-ds"></div>
    <div id="dialog-hang-tang-body">
        <div id="grid" class="grid-view">
            <table class="items" id="gridHangTang">
                <tr>
                    <th>Mã vạch</th>
                    <th>Tên hàng tặng</th>
                    <th>Số lượng</th>
                    <th>Giá được tặng</th>
                    <th></th>
                </tr>
            </table>
        </div>
    </div>
</div>