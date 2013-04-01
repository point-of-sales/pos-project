<?php

$this->breadcrumbs = array(
	ChiNhanh::label(2),
	Yii::t('app', 'Danh sách các chi nhánh'),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Thêm chi nhánh'), 'url' => array('them')),
	array('label'=>Yii::t('app', 'Manage'), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(ChiNhanh::label(2)); ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        'id',
        'ma_chi_nhanh',
        'ten_chi_nhanh',
        'dia_chi',
        'mo_ta',
        'truc_thuoc_id',
        array(
            'class' => 'CButtonColumn',
        ),
    )
));
?>