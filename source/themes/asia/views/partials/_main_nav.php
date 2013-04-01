
    <?php $this->widget('zii.widgets.CMenu',array(
        'id'=>'navigation',
        'items'=>array(
            array('label'=>'Home', 'url'=>array('/site/index')),
            array('label'=>'Quản lý chi nhánh', 'url'=>array('/qlcn/chinhanh')),
            array('label'=>'Quản lý nhân viên', 'url'=>array('/quanlynhanvien/nhanvien')),
            array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
            array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
        ),
        'htmlOptions'=>array('class'=>'sf-navbar')
    )); ?>
