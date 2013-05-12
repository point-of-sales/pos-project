<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/banhang.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/banhang.css');
/*
echo '<pre>';
print_r(Yii::app()->session->toArray());
echo '</pre>';
*/
?>
<?php  if(Yii::app()->user->hasFlash('info-board')) {?>    <div class="response-msg error ui-corner-all info-board">        <?php echo Yii::app()->user->getFlash('info-board');?>    </div><?php } ?>
<input type="hidden" id="base-url" value="<?php echo Yii::app()->request->baseUrl?>" />
<div id="form-hd-ban">
<?php $form = $this->beginWidget('GxActiveForm', array(
	'enableAjaxValidation' => false,
));
?>
	<div id="form-hd-ban-header">
    	<div id="form-hd-ban-header-left">
            <ul>
                <li>
                    <span>Mã hóa đơn</span>
                    <span id="form-hd-ban-ma-hoa-don"></span>
                </li>
                <li>
                    <span>Chi nhánh</span>
                    <span>
                        <?php echo $form->dropDownList($model->baseModel, 'chi_nhanh_id', GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true))); ?>
                    </span>
                </li>
            </ul>
        </div>
        <div id="form-hd-ban-header-center"><h1>TẠO HÓA ĐƠN BÁN HÀNG</h1></div>
        <div id="form-hd-ban-header-right">
            <table id="form-hd-ban-header-table">
            	<tr>
                	<td>Họ tên NV</td>
                    <td id="form-hd-ban-ho-ten-nv">
                    <?php echo $form->dropDownList($model->baseModel, 'nhan_vien_id', GxHtml::listDataEx(NhanVien::model()->findAllAttributes(null, true))); ?>
                    </td>
                </tr>
                <tr>
                	<td>Ngày Lập</td>
                    <td id="form-hd-ban-ngay-lap">
                    <?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
                    			'model' => $model,
                    			'attribute' => 'ngay_lap',
                    			'value' => $model->baseModel->setAttribute('ngay_lap',date("d-m-Y",time())),
                    			'options' => array(
                    				'showButtonPanel' => true,
                    				'changeYear' => true,
                    				'dateFormat' => 'dd-mm-yy',
                    				),
                    			)); 
                    ?>
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
                <div id="form-hd-ban-error"></div>
            </div>
        </div>
        <div id="form-hd-ban-info-right">
            <table id="form-hd-ban-info-table">
            	<tr>
                	<td class="form-hd-ban-label">Họ tên</td>
                    <td><span id="form-hd-ban-ho-ten-kh"></span></td>
                    <td class="form-hd-ban-label">Tổng</td>
                    <td><span id="form-hd-ban-tong">0</span></td>
                </tr>
                <tr>
                	<td class="form-hd-ban-label">Chiết khấu</td>
                    <td><span id="form-hd-ban-chiet-khau">0</span><span>%</span></td>
                    <td class="form-hd-ban-label">Trị giá</td>
                    <td><span id="form-hd-ban-tri-gia">0</span></td>
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
            <input class="" type="button" value="Hóa đơn mới" onclick="hoaDonMoi()" />
            <input class="" type="submit" value="In hóa đơn" />
        </div>
    </div>
    <div id="form-hd-ban-footer">F1: MÃ VẠCH -- F2: KHÁCH HÀNG -- F3: TÌM KHÁCH HÀNG -- F4: HÀNG TẶNG</div>
    <?php $this->endWidget();?>
</div>

<div id="dialog-tim-khach-hang" title="Tìm khách hàng"></div>
<div id="dialog-hang-tang" title="Sản phẩm tặng">
    <div id="dialog-hang-tang-header">
        <div id="dialog-hang-tang-ma">
            <span id="dialog-hang-tang-ma-label">Mã hàng tặng</span>
            <input id="dialog-hang-tang-ma-input" type="text" />
        </div>
    </div>
    <div id="dialog-hang-tang-body">
        <div id="grid" class="grid-view">
            <table class="items" id="items">
                <tr>
                    <th>Mã vạch</th>
                    <th>Tên hàng tặng</th>
                    <th>Số lượng</th>
                    <th>Giá được tặng</th>
                    <th></th>
                </tr>
                <tr class="even">
                    <td>123</td>
                    <td>123</td>
                    <td><input id="slht_1" value="1" /></td>
                    <td>123</td>
                    <td><input id="cht_1" type="checkbox" /></td>
                </tr>
            </table>
        </div>
    </div>
</div>