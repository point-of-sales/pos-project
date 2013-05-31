<?php $this->breadcrumbs = array(
    Yii::t('viLib', 'Decentralization management') => array('authItem/roles'),
    Yii::t('viLib', 'Authentication item')=>array(),
    Yii::t('viLib',Rights::getAuthItemTypeName($_GET['type']))=>array(),
    Yii::t('viLib', 'Create')
); ?>

<?php
$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Role'),  'url' => array('authItem/roles')),
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Task'),  'url' => array('authItem/tasks')),
    array('label' => Yii::t('viLib', 'List') . ' ' . Yii::t('viLib', 'Operation'),  'url' => array('authItem/operations')),
);

?>


<h1><?php echo Yii::t('viLib', 'Create') . ' ' . Yii::t('viLib',Rights::getAuthItemTypeName($_GET['type'])); ?></h1>

<div class="createAuthItem">
    <?php $this->renderPartial('_form', array('model' => $formModel)); ?>

</div>