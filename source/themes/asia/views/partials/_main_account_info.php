<script>
    $(document).ready(function () {
        function updateClock() {
            var currentTime = new Date();
            var currentHours = currentTime.getHours();
            var currentMinutes = currentTime.getMinutes();
            var currentSeconds = currentTime.getSeconds();

            currentMinutes = ((currentMinutes < 10) ? '0' : '') + currentMinutes;
            currentSeconds = ((currentSeconds < 10) ? '0' : '') + currentSeconds;
            var timeOfDay = (currentHours < 12) ? 'AM' : 'PM';
            currentHours = (currentHours > 12) ? currentHours - 12 : currentHours;
            currentHours = (currentHours == 0) ? 12 : currentHours;
            currentTimeString = currentHours + ':' + currentMinutes + ':' + currentSeconds + ' ' + timeOfDay;

            $('#clock').text(currentTimeString);
        }

        setInterval(function () {
            updateClock()
        }, 1000);
    });
</script>
<style type="text/css">
    #clock {
        margin-left: -17px;
    }

    #current-user {
        margin-left: -17px;
    }

    #user-title {
        margin-left: -17px;
    }

    #user-position {
        margin-left: -17px;
    }

    #current-branch {
        margin-left: -17px;
    }
    #branch-title {
        margin-left: -17px;
    }


</style>
<?php $nhanVienHienHanh = NhanVien::model()->findByPk(Yii::app()->user->id); ?>
<?php if (!Yii::app()->user->isGuest) : ?>
    <span id="current-time"><?php echo Yii::t('viLib', 'Current time') . ' : ' ?></span><span id="clock"></span> |
    <span id="current-user"><?php echo Yii::t('viLib', 'Current user') . ' : ' ?></span>
    <span id="user-title"><a href="#"><?php echo $nhanVienHienHanh->ho_ten; ?></a></span> |
    <span id="user-position"><?php echo Yii::t('viLib', 'Position') . ' : ' ?>
        <?php
        $item = Rights::getAuthorizer()->authManager->getAuthItem(RightsWeight::getRole(Yii::app()->user->id));
        $authorizer = Rights::module()->getAuthorizer();
        $item = $authorizer->attachAuthItemBehavior($item);
        echo $item->getPositionDescription();
        ?>
</span> |
    <span id="current-branch"><?php echo Yii::t('viLib', 'Branch') . ' : ' ?></span>
    <span id="branch-title"><a href="#"><?php echo $nhanVienHienHanh->chiNhanh->ten_chi_nhanh; ?></a></span> |
    <a href="<?php echo Yii::app()->createUrl('/site/logout') ?>"
       title="Logout"><?php echo Yii::t('viLib', 'Logout') ?></a>
<?php
endif;
?>

