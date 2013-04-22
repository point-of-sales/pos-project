
<?php /* @var $this Controller */
?>
<?php $this->beginContent('//layouts/main'); ?>
    <div id="main-wrapper">
        <div id="main-content">
            <?php echo $content; ?>
        </div>
        <div class="clearfix"></div>
    </div
<?php $this->endContent(); ?>


<!-- Change form width for the colum1 layout -->
<?php
    Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/column1-form.css');
?>