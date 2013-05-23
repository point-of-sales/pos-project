<?php

$this->breadcrumbs = array(
    Yii::t('viLib', 'Employee management') => array('nhanVien/danhsach'),
    Yii::t('viLib', 'Employee') => array('nhanVien/danhsach'),
    Yii::t('viLib', 'Update password')=>array(),
    GxHtml::valueEx($model->nhanVien,"ho_ten"),

);

?>

    <h1><?php echo Yii::t('viLib', 'Update password') . ' ' . Yii::t('viLib', 'Employee') . ' ' . GxHtml::encode(GxHtml::valueEx($model->nhanVien,"ho_ten")); ?></h1>

<?php
$this->renderPartial('_formdoimatkhau', array(
    'model' => $model));
?>