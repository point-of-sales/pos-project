<?php
/**
 * User: ${Cristazn}
 * Date: 5/13/13
 * Time: 10:31 PM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980
 */

$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'create-product-dialog',
    'options' => array(
        'title' => Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib', 'Product'),
        'autoOpen' => true,
        'modal' => true,
        'width' => 'auto',
        'height' => 'auto',
    )
));

echo $this->renderPartial('_formthemajax', array(
    'model' => $model,

));

$this->endWidget('zii.widgets.jui.CJuiDialog');
