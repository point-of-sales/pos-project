<?php

$menuItems = Yii::app()->CPOSSessionManager->getKey('menuItems');
if (isset($menuItems)) {
    $this->widget('zii.widgets.CMenu', array(
        'id' => 'navigation',
        'items' => $menuItems[0],
        'htmlOptions' => array('class' => 'sf-navbar')
    ));
}
?>
