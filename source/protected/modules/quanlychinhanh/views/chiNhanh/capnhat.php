<?php  if(Yii::app()->user->hasFlash('info-board')) {?>
    <div class="response-msg error ui-corner-all info-board">
        <?php echo Yii::app()->user->getFlash('info-board');?>
    </div>
<?php } ?>


<?php

$this->breadcrumbs = array(
    Yii::t('viLib','Branch management')=>array('chiNhanh/danhsach'),
    Yii::t('viLib','Branch')=>array('chiNhanh/danhsach'),
    Yii::t('viLib', 'Update')=>array(),
    GxHtml::valueEx($model,"ten_chi_nhanh"),

);

$this->menu = array(
	array('label' => Yii::t('viLib', 'List') . ' ' . $model->label(2), 'url'=>array('danhsach')),
	array('label' => Yii::t('viLib', 'Create') . ' ' . $model->label(), 'url'=>array('them')),
	array('label' => Yii::t('viLib', 'View') . ' ' . $model->label(), 'url'=>array('chitiet', 'id' => GxActiveRecord::extractPkValue($model, true))),
    array('label'=>Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib','Area'), 'url' => array('khuVuc/them')),
);
?>

<h1><?php echo Yii::t('viLib', 'Update') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model,"ten_chi_nhanh")); ?></h1>

<?php
$this->renderPartial('_form', array(
		'model' => $model));
?>