<div class="wide search-box-form">

<<<<<<< HEAD
    <?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'id'); ?>
            <?php echo $form->textField($model, 'id'); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'ma_nhan_vien'); ?>
            <?php echo $form->textField($model, 'ma_nhan_vien', array('maxlength' => 10)); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'ho_ten'); ?>
            <?php echo $form->textField($model, 'ho_ten', array('maxlength' => 200)); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'email'); ?>
            <?php echo $form->textField($model, 'email', array('maxlength' => 100)); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'dien_thoai'); ?>
            <?php echo $form->textField($model, 'dien_thoai', array('maxlength' => 12)); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'dia_chi'); ?>
            <?php echo $form->textField($model, 'dia_chi', array('maxlength' => 200)); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'gioi_tinh'); ?>
            <?php echo $form->textField($model, 'gioi_tinh'); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'ngay_sinh'); ?>
            <?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'ngay_sinh',
			'value' => $model->ngay_sinh,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
; ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'trinh_do'); ?>
            <?php echo $form->textField($model, 'trinh_do', array('maxlength' => 100)); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'luong_co_ban'); ?>
            <?php echo $form->textField($model, 'luong_co_ban'); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'chuyen_mon'); ?>
            <?php echo $form->textField($model, 'chuyen_mon', array('maxlength' => 200)); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'trang_thai'); ?>
            <?php echo $form->textField($model, 'trang_thai'); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'mat_khau'); ?>
            <?php echo $form->textField($model, 'mat_khau', array('maxlength' => 100)); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'ngay_vao_lam'); ?>
            <?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'ngay_vao_lam',
			'value' => $model->ngay_vao_lam,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
; ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'lan_dang_nhap_cuoi'); ?>
            <?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'lan_dang_nhap_cuoi',
			'value' => $model->lan_dang_nhap_cuoi,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
; ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'loai_nhan_vien_id'); ?>
            <?php echo $form->dropDownList($model, 'loai_nhan_vien_id', GxHtml::listDataEx(LoaiNhanVien::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
        </div>

                    <div class="row cus-row">
            <?php echo $form->label($model, 'chi_nhanh_id'); ?>
            <?php echo $form->dropDownList($model, 'chi_nhanh_id', GxHtml::listDataEx(ChiNhanh::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
        </div>

        <div class="row buttons btn-search">
        <?php echo GxHtml::submitButton(Yii::t('viLib', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

=======
<?php $form = $this->beginWidget('GxActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    )); ?>
<ul  class="search-box">
	<li class="row">
		<?php echo $form->label($model, 'ma_nhan_vien'); ?>
		<?php echo $form->textField($model, 'ma_nhan_vien', array('maxlength' => 10)); ?>
	</li>

	<li class="row">
		<?php echo $form->label($model, 'ho_ten'); ?>
		<?php echo $form->textField($model, 'ho_ten', array('maxlength' => 200)); ?>
	</li>

	<li class="row">
		<?php echo $form->label($model, 'trang_thai'); ?>
		<?php echo $form->textField($model, 'trang_thai'); ?>
	</li>

	<li class="row">
		<?php echo $form->label($model, 'loai_nhan_vien_id'); ?>
		<?php echo $form->dropDownList($model, 'loai_nhan_vien_id', GxHtml::
listDataEx(LoaiNhanVien::model()->findAllAttributes(null, true)), array('prompt' =>
        Yii::t('app', 'All'))); ?>
	</li>

	<li class="row">
		<?php echo $form->label($model, 'chi_nhanh_id'); ?>
		<?php echo $form->dropDownList($model, 'chi_nhanh_id', GxHtml::listDataEx(ChiNhanh::
model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</li>
</ul>
	<div class="row buttons btn-search">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Tìm kiếm')); ?>
	</div>

<?php $this->endWidget(); ?>
>>>>>>> cc04ae6b14d1e9954bc50c540b31af7101184802
</div><!-- search-form -->
