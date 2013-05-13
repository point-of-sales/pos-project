<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/hoadon.css');
?>
<script type="text/javascript">
$(document).ready(){
    dongBoDuLieu();
};
function dongBoDuLieu(){
    $.ajax({
        url: 'dongbodulieu',
        type: 'POST',
        async: false,
        function(data){
            var hd = $.parseJSON(data);
        }
    });
}
</script>