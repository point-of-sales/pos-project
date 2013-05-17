<style type="text/css">
    #page-wrapper #main-wrapper #main-content {
        padding:10px 10px 10px;
        width: 79.5%;
    }
</style>

<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
		<div id="main-wrapper">
            <div id="main-content">
            <?php echo $content; ?>
            </div>
			<div class="clearfix"></div>
		</div>
        
		<div id="sidebar">
			<div class="side-col ui-sortable">
				<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
					<div class="portlet-header ui-widget-header cus-border">Thao tác</div>
					<?php
                    $this->beginWidget('zii.widgets.CPortlet', array('title' => '',
                        'htmlOptions'=>array('class'=>''),
                    ));
                    $this->widget('zii.widgets.CMenu', array(
                        'items' => $this->menu,
                        'htmlOptions' => array('class' => 'operations'),
                        ));
                    $this->endWidget();
                    ?>
				</div>
                <?php
                    switch(Yii::app()->controller->action->id) {
                        case 'nhapxuatton': {
                            $this->widget('CPOSImportExportReportPortlet');
                            break;
                        }
                        case 'banhangchinhanh': {
                            $this->widget('CPOSBranchSaleReportPorlet');
                            break;
                        }
                        case 'banhangsanpham': {
                            $this->widget('CPOSProductSaleReportPorlet');
                            break;
                        }
                        case 'banhangtop': {
                            $this->widget('CPOSSaleTopPortlet');
                            break;
                        }


                    }


                ?>

			</div>
			<div class="clearfix"></div>
		</div>
<?php $this->endContent(); ?>