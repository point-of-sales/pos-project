<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/banhang.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/banhang.css');
?>
<div id="form-hd-ban">
<?php $form = $this->beginWidget('GxActiveForm', array(
	'enableAjaxValidation' => false,
));
?>
	<div id="form-hd-ban-header">
    	<div id="form-hd-ban-header-left">
        	<h2 id="form-hd-ban-chi-nhanh">Tên chi nhánh</h2>
        </div>
        <div id="form-hd-ban-header-center"><h1>TẠO HÓA ĐƠN BÁN HÀNG</h1></div>
        <div id="form-hd-ban-header-right">
            <table id="form-hd-ban-header-table">
            	<tr>
                	<td><?php echo $form->labelEx($model,'ho_ten'); ?></td>
                    <td id="form-hd-ban-ho-ten-nv">ten nhan vien</td>
                </tr>
                <tr>
                	<td><?php echo $form->labelEx($model,'ngay_lap'); ?></td>
                    <td id="form-hd-ban-ngay-lap">
                    <?php /*$form->widget('zii.widgets.jui.CJuiDatePicker', array(
                    			'model' => $model,
                    			'attribute' => 'ngay_lap',
                    			'value' => $model->ngay_lap,
                    			'options' => array(
                    				'showButtonPanel' => true,
                    				'changeYear' => true,
                    				'dateFormat' => 'yy-mm-dd',
                    				),
                    			));*/ 
                    ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div id="form-hd-ban-info">
    	<div id="form-hd-ban-info-left">
        	<div id="form-hd-ban-ma">
            	<span id="form-hd-ban-ma-label">Mã sản phẩm</span>
                <span><input id="form-hd-ban-ma-input" type="text" onkeypress="keypressInputMa(event)" /></span>
            </div>
        </div>
        <div id="form-hd-ban-info-right">
        	<table id="form-hd-ban-info-table">
            	<tr>
                	<td class="form-hd-ban-label"><?php echo $form->labelEx($model,'ho_ten'); ?></td>
                    <td id="form-hd-ban-ho-ten-kh">ten khach hang</td>
                    <td class="form-hd-ban-label">Tổng</td>
                    <td id="form-hd-ban-tong">1000000</td>
                </tr>
                <tr>
                	<td class="form-hd-ban-label"><?php echo $form->labelEx($model,'chiet_khau'); ?></td>
                    <td id="form-hd-ban-chiet-khau">chiet khau</td>
                    <td class="form-hd-ban-label"><?php echo $form->labelEx($model,'tri_gia'); ?></td>
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
    </div>
    <div id="form-hd-ban-list">
        <?php 
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'form-hd-ban-grid',
            'dataProvider' => $model->search(),
            'columns' => array(
                    		'ma_vach',
                            array(
                                'header'=>'So Luong',
                                'value'=>'CHTML::textField("so_luong","",array("maxlength"=>3,"width"=>20))',
                                'htmlOptions'=>array('width'=>'20px')
                            ),
                    		'don_gia',
                    		'thanh_tien',
                            ),
                        )
                    );
        ?>
    </div>
    <div id="form-hd-ban-command">
    	<div id="form-hd-ban-button">
        	<input type="button" value="CLick" />
            <input type="button" value="CLick" />
            <input type="button" value="CLick" />
        </div>
    </div>
    <div id="form-hd-ban-footer">form-hd-ban-footer</div>
    <?php $this->endWidget();?>
</div>