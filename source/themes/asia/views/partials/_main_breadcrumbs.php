<?php
/**
 * User: ${Cristazn}
 * Date: 4/1/13
 * Time: 8:40 AM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980 
 */
if(isset($this->breadcrumbs)):?>
    <?php $this->widget('ext.ebreadcrumbs.EXBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
<?php endif?>