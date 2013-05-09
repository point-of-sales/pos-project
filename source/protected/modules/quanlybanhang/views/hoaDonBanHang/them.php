<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/banhang.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/banhang.css');
print_r(Yii::app()->session->toArray());
?>
<input type="hidden" id="base-url" value="<?php echo Yii::app()->request->baseUrl?>" />
<div id="form-hd-ban">
<?php $form = $this->beginWidget('GxActiveForm', array(
	'enableAjaxValidation' => false,
));
?>
	<div id="form-hd-ban-header">
    	<div id="form-hd-ban-header-left">
        	<h2 id="form-hd-ban-chi-nhanh">
                Chi nhánh 
                <?php echo $form->dropDownList($model->baseModel, 'chi_nhanh_id', GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true))); ?>
            </h2>
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
        	<table id="form-hd-ban-info-table">
            	<tr>
                	<td class="form-hd-ban-label">Họ tên</td>
                    <td id="form-hd-ban-ho-ten-kh">ten khach hang</td>
                    <td class="form-hd-ban-label">Tổng</td>
                    <td id="form-hd-ban-tong">1000000</td>
                </tr>
                <tr>
                	<td class="form-hd-ban-label">Chiết khấu</td>
                    <td id="form-hd-ban-chiet-khau">chiet khau</td>
                    <td class="form-hd-ban-label">Trị giá</td>
                    <td id="form-hd-ban-tri-gia">90000</td>
                </tr>
                <tr>
                	<td class="form-hd-ban-label">Số tiền nhận</td>
                    <td id="form-hd-ban-so-tien-nhan">1000000</td>
                    <td class="form-hd-ban-label">Tiền dư</td>
                    <td id="form-hd-ban-tien-du">50000</td>
                </tr>
            </table>
        </div>
        <div id="form-hd-ban-info-right">
            <div id="form-hd-ban-ma">
            	<span id="form-hd-ban-ma-label">Mã vạch</span>
                <span><input id="form-hd-ban-ma-input" type="text" onkeypress="keypressInputMa(event)" /></span>
                <div id="form-hd-ban-error"></div>
            </div>
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
        	<input type="button" value="In hóa đơn" />
            <input type="button" value="Hóa đơn mới" />
        </div>
    </div>
    <div id="form-hd-ban-footer">form-hd-ban-footer</div>
    <?php $this->endWidget();?>
</div>