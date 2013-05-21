<span><a href="#"><?php echo Yii::app()->user->getState('title') ?></a></span>|<?php
if (!Yii::app()->user->isGuest) :
    ?>
    <a href="<?php echo Yii::app()->createUrl('/site/logout') ?>" title="Logout">Logout</a>
<?php
endif;
?>