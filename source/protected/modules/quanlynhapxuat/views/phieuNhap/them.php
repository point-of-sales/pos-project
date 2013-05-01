<script>
    var ajaxTransferDataObject = new AjaxTransferData();

    $(window).load(function () {
        // When grid is empty and data is exist on session. Fill grid again with data from the session
        if(ajaxTransferDataObject.isEmptyGrid()) {
            var isEmptySession = <?php echo json_encode(Yii::app()->CPOSSessionManager->isEmpty('ChiTiet'))?>;
            if(!isEmptySession) {
                ajaxTransferDataObject.addedItems = <?php echo json_encode(Yii::app()->CPOSSessionManager->getItem('ChiTiet'))?>;
                 // Refill grid
                $.each(ajaxTransferDataObject.addedItems.items,function(key,value){
                    var item = ajaxTransferDataObject.addedItems.items[key];
                    ajaxTransferDataObject.renderRow(item);
                });
            }
        }
    });


    $(document).ready(function(){
         $('#barcode').blur(function(){
            item = AjaxTransferData.getStaticProduct();
            if(item!=null)
                $('#productname').val(item.ten_san_pham);
         });
    });
    // ======================== GLOBAL AREA =================================================
    //chong reload page khi enter input text
    function stopRKey(evt) {
        var evt = (evt) ? evt : ((event) ? event : null);
        var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
        if ((evt.keyCode == 13) && (node.type == "text")) {
            return false;
        }
    }

    document.onkeypress = stopRKey;
    ///////////////////////////////////////////

    function keypressInputMa(e) {
        switch (e.keyCode) {
            case 13:
            {

                if (ajaxTransferDataObject.hasInputErrors()) {
                    ajaxTransferDataObject.renderErrors();
                    ajaxTransferDataObject.focusErrors();
                    return false; //  ko cho thuc thi tiep
                } else {
                    // khong co loi xay ra. Dua du lieu vao Grid
                    // truoc khi dua du lieu thi kiem tra no co ton tai tren grid chua
                    ajaxTransferDataObject.fillItemsToGrid();
                    ajaxTransferDataObject.syncSession();
                    ajaxTransferDataObject.resetInputs();
                }
            }
        }
    }

    function trimNumber(s) {
        while (s.substr(0,1) == '0' && s.length>1)
        {
            s = s.substr(1,9999);
        }
        return s;
    }

    // =====================================================================================

    // ==================================== CLASS AREA ====================================
    function AjaxTransferData() {
        this.barcode = "#barcode";
        this.productName = "#productname";
        this.quantity = "#quantity";
        this.price = "#price";

        this.gridTable = "#items";
        this.dataStored = null;
        this.customInfoBoard = null;
        this.errors = null;
        this.addedItems = {'items':[]};              // Json object

    };
    AjaxTransferData.prototype.getProduct = function () {
        var ma = $(this.barcode).val();
        var strUrl = "getsanphamban/ma_vach/" + ma;
        var ret;
        $.ajax({
            url: strUrl,
            type: 'POST',
            async: false,
            success: function(response) {
                ret = response;
            }
        });
        this.dataStored = ret;
        return this.dataStored !=null;
    }

    AjaxTransferData.prototype.fillItemsToGrid = function () {
        var item = $.parseJSON(this.dataStored);
        var position = this.isInArray(item.id);   // position of item in added list.
        if(position<0) {
            // not found in added Array. Need to add new it.
            item.so_luong  = parseInt(trimNumber($(this.quantity).val()));
            item.gia_nhap  = parseInt(trimNumber($(this.price).val()));
            this.renderRow(item);
            this.addedItems.items.push(item);
        } else {
            // modify existed record on grid. Plus the quantity and change the price
            var quantitySelector = '#sl_' + item.id;
            var priceSelector = '#dg_' + item.id;
            var newQuantity = parseInt(trimNumber($(quantitySelector).val())) + parseInt(trimNumber($(this.quantity).val()));
            var newPrice = parseInt(trimNumber($(this.price).val()));

            $(quantitySelector).val(newQuantity);
            $(priceSelector).val(newPrice);
            // modify data in addedItems
            var newData = {
                'so_luong':newQuantity,
                'gia_nhap':newPrice
            };
            this.updateItemAtPosition(position,newData);
        }
        // clear dataStored after fill to grids
        this.dataStored = null;

    }

    AjaxTransferData.prototype.getNumRowsTable = function () {
        return $(this.gridTable + ' tr').length - 1;
    }

    AjaxTransferData.prototype.hasInputErrors = function() {
        this.checkInputErrors();
        if(this.errors.length>0)
            return true;
        else
            return false;

    }

    // kiem tra loi nhap lieu khi nguoi dung nhap vao va dua vao info-board
    AjaxTransferData.prototype.checkInputErrors = function () {
        this.errors = new Array();
        this.customInfoBoard = $('<div>').addClass('error');
        //1. Kiem tra ma_vach xem neu ma vach do thuoc san pham nao
        if ($(this.barcode).val() === 'undefined') {
            $('<p>', {
                class: 'custom-error-messages'
            }).text('<?php print(Yii::t('viLib','Product is undefined. Please type a barcode'))?>').appendTo(this.customInfoBoard);
            this.errors.push(1);

        }
        else {
            if (!this.getProduct()) {
                // neu san pham chua co trong danh sach san pham. Lam thong bao loi dua vao trong info-message
                $('<p>', {
                    class: 'custom-error-messages'
                }).text('<?php print(Yii::t('viLib','Product not found. Please try another barcode'))?>').appendTo(this.customInfoBoard);
                this.errors.push(1);
            }
        }

        //2. Kiem tra gia nhap
        if ($(this.price).val() === 'undefined') {
            $('<p>', {
                class: 'custom-error-messages'
            }).text('<?php print(Yii::t('viLib','Import price is undefined. Please fill it'))?>').appendTo(this.customInfoBoard);
            this.errors.push(2);
        } else if ($(this.price).val() <= 0) {
            // set  error
            $('<p>', {
                class: 'custom-error-messages'
            }).text('<?php print(Yii::t('viLib','Import price must have greater than zero'))?>').appendTo(this.customInfoBoard);
            this.errors.push(2);
        } else if(isNaN($(this.price).val())) {
            $('<p>', {
                class: 'custom-error-messages'
            }).text('<?php print(Yii::t('viLib','Data mistmatch'))?>').appendTo(this.customInfoBoard);
            this.errors.push(2);
        }

        //3. Kiem tra so luong
        if ($(this.quantity).val() === 'undefined') {
            $('<p>', {
                class: 'custom-error-messages'
            }).text('<?php print(Yii::t('viLib','Quantity is undefined. Please fill it'))?>').appendTo(this.customInfoBoard);
            this.errors.push(3);
        } else if ($(this.quantity).val() <= 0) {
            // set  error
            $('<p>', {
                class: 'custom-error-messages'
            }).text('<?php print(Yii::t('viLib','Quantity must have greater than zero'))?>').appendTo(this.customInfoBoard);
            this.errors.push(3);
        } else if(isNaN($(this.quantity).val())) {
            $('<p>', {
                class: 'custom-error-messages'
            }).text('<?php print(Yii::t('viLib','Data mistmatch'))?>').appendTo(this.customInfoBoard);
            this.errors.push(3);
        }

        // neu co loi xay ra hien thi info-board de nguoi dung sua lai
        return this.errors;

    }

    AjaxTransferData.prototype.renderErrors = function() {
        if(this.customInfoBoard!=null) {
            this.customInfoBoard.insertAfter('.header-voucher-info');
            $('.error').fadeOut(5000);
        }
        // clear customInfoBoard
        this.customInfoBoard = null;

    }

    AjaxTransferData.prototype.focusErrors = function() {
        if(this.errors.length>0) {
            // focus vao error dau tien
            var  error = this.errors[0];
            switch (error) {
                case 1: {
                    $(this.barcode).val('');
                    $(this.barcode).focus();
                    break;
                }
                case 2: {
                    $(this.price).val('');
                    $(this.price).focus();
                    break;
                }
                case 3: {
                    $(this.quantity).val('');
                    $(this.quantity).focus();
                    break;
                }

            }
        }
        this.errors = null;
    }

    AjaxTransferData.prototype.resetInputs = function() {
        $(this.barcode).val('');
        $(this.productName).val('');
        $(this.quantity).val(0);
        $(this.price).val(0);
    }
    /*
        Kiem tra 1 id cua 1 san pham co nam trong danh sach san pham da them vao grid chua.
        Dung Json kiem tra
     */

    AjaxTransferData.prototype.isInArray = function(id) {
       // var self = this;  // define self is AjaxTransferData
        var found = false;
        for(var i=0;i<this.addedItems.items.length;i++) {
            $.each(this.addedItems.items[i],function(key,value){
               if(id==value) {
                    found = true;
                    return !found;
               }
            });
            if(found)
                return i;
        }
        return -1;
    }

    AjaxTransferData.prototype.updateItemAtPosition = function(position,newData) {
        var self = this;
        for(i=0;i<this.addedItems.items.length;i++) {
            if(i==position) {
                // update it
                var obj = this.addedItems.items[position];
                $.each(newData,function(key,value){
                    if(key in obj && key=='so_luong')
                        self.addedItems.items[position][key] = self.addedItems.items[position][key] + value;
                    if(key in obj)
                        self.addedItems.items[position][key] = value;
                });
            }
        }
    }

    AjaxTransferData.prototype.syncSession = function() {
        $.ajax({
            url:"syncdata",
            type:"POST",
            data:this.addedItems,
            success:function(response) {
                console.log(response);
            }
        });
    }

    AjaxTransferData.prototype.renderRow = function(item) {
        var even_odd = 'even';
        if (this.getNumRowsTable() % 2 == 0)
            even_odd = 'odd';
        var strRow =
            '<tr class="' + even_odd + '">' +
                '<input type="hidden" value="' + item.id + '" id="" />' +
                '<td>' + '<input type="text" name="ma_vach[]" value="' + item.ma_vach + '" class="ma_vach_items" readonly="readonly" />' + '</td>' +
                '<td>' + '<input type="text" name="ten_san_pham[]" value="' + item.ten_san_pham + '" class="ten_san_pham_items" readonly="readonly" />' + '</td>' +
                '<td>' + '<input type="text" name="so_luong[]" value="' + item.so_luong + '" id="sl_'+item.id+'" />' + '</td>' +
                '<td>' + '<input type="text" name="gia_nhap[]" value="' + item.gia_nhap + '" id="dg_'+item.id+'" />' + '</td>' +
                '<td></td>' +
                '</tr>';
        $(this.gridTable).append(strRow);
    }

    AjaxTransferData.prototype.isEmptyGrid = function() {
        return ($('#items tr').length==1)?true:false;
    }



    //Static method
    AjaxTransferData.getStaticProduct = function() {
        var ma = $('#barcode').val();
        var strUrl = "getsanphamban/ma_vach/" + ma;
        var ret;
        $.ajax({
            url: strUrl,
            type: 'POST',
            async: false,
            success: function(response) {
                ret = response;
            }
        });
        return $.parseJSON(ret);
    }
    /*
        Kiem tra grid co du lieu hay chua
     */



</script>

<?php
$this->breadcrumbs = array(
    $model->label(2) => array('danhsach'),
    Yii::t('viLib', 'Create'),
);

$this->menu = array(
    array('label' => Yii::t('viLib', 'List') . ' ' . $model->label(2), 'url' => array('danhsach')),
    array('label' => Yii::t('viLib', 'Manage') . ' ' . $model->label(2), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('viLib', 'Create') . ' ' . GxHtml::encode($model->label()); ?></h1>

<?php
$this->renderPartial('_form', array(
    'model' => $model,
    'buttons' => 'create'));
?>