<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Point Of Sales System Management</title>


    <?php
    //<!--Register core style script-->
        //CSS BluePrint framework
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/screen.css');
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/print.css');
        //Core
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/main.css');
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/form.css');
    //<!--Register external style script -->
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/reset.css');
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/general.css');
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/styles/default/ui.css');
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/forms.css');
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/tables.css');
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/messages.css');
    // <!--Custome css -->
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/custom.css');
    //<!--Register core script -->
        Yii::app()->clientScript->registerCoreScript('jquery');
        Yii::app()->clientScript->registerCoreScript('jquery.ui');
    //<!--Register external script -->
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/superfish.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/tooltip.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/tablesorter.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/tablesorter-pager.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/cookie.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom.js');
    ?>

	<!--[if IE 6]>
	<link href="css/ie6.css" rel="stylesheet" media="all" />
	
	<script src="js/pngfix.js"></script>
	<script>
	  /* EXAMPLE */
	  DD_belatedPNG.fix('.logo, .other ul#dashboard-buttons li a');

	</script>
	<![endif]-->
	<!--[if IE 7]>
	<link href="css/ie7.css" rel="stylesheet" media="all" />
	<![endif]-->
</head>

<body>
	<div id="header">
    <!--INFO ACCOUNT-->
		<div id="top-menu">
			<?php  $this->renderPartial('webroot.themes.asia.views.partials._main_account_info');?>
		</div>
    <!--END INFO ACCOUNT-->
		<div id="sitename">
			<a href="index.html" class="logo float-left" title="POS">Point Of Sales SM</a>
		</div>
    <!--NAV-->
		<?php
		    $this->renderPartial('webroot.themes.asia.views.partials._main_nav');?>
    <!--END NAV-->
	</div>	
    
    <div id="page-wrapper">
        <!--BREADCRUMBS-->
        <?php $this->renderPartial('webroot.themes.asia.views.partials._main_breadcrumbs');?>
        <?php echo $content?>
    </div>    
	<div class="clearfix"></div>
	<!--<div id="footer">
		<?php /*$this->renderPartial('webroot.themes.asia.views.partials._main_footer');*/?>
	</div>-->
</body>

</html>