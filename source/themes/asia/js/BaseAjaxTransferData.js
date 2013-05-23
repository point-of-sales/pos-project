/**
 * Created with JetBrains PhpStorm.
 * User: david
 * Date: 5/2/13
 * Time: 11:49 AM
 * To change this template use File | Settings | File Templates.
 */
//chong reload page khi enter input text
function stopRKey(evt) {
    var evt = (evt) ? evt : ((event) ? event : null);
    var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
    if ((evt.keyCode == 13) && (node.type == "text")) {
        return false;
    }
}

document.onkeypress = stopRKey;


var BaseAjaxTransferData = function () {
    this.gridTable = "#items";
    this.dataStored = null;
    this.customInfoBoard = null;
    this.errors = null;
    this.addedItems = {'items': [], 'type':''};              // Json object

    BaseAjaxTransferData.prototype.getProduct = function (url,ma) {
        var strUrl  = url + "getsanphamban/ma_vach/" + ma;
        var ret;
        $.ajax({
            url: strUrl,
            type: 'POST',
            async: false,
            success: function (response) {
                ret = response;
            }
        });
        this.dataStored = ret;
        return this.dataStored != null;
    }

    BaseAjaxTransferData.prototype.getGiftProduct = function (url,ma) {
        var strUrl  = url + "getsanphamtang/ma_vach/" + ma;
        var ret;
        $.ajax({
            url: strUrl,
            type: 'POST',
            async: false,
            success: function (response) {
                ret = response;
            }
        });
        this.dataStored = ret;
        return this.dataStored != null;
    }

    BaseAjaxTransferData.prototype.getNumRowsTable = function () {
        return $(this.gridTable + ' tr').length - 1;
    }

    BaseAjaxTransferData.prototype.renderErrors = function () {
        if (this.customInfoBoard != null) {
            this.customInfoBoard.insertAfter('.header-voucher-info');
            $('.error').fadeOut(5000);
        }
        // clear customInfoBoard
        this.customInfoBoard = null;

    }

    BaseAjaxTransferData.prototype.isInArray = function (id) {
        var found = false;
        if (typeof (this.addedItems.items) != 'undefined') {
            for (var i = 0; i < this.addedItems.items.length; i++) {
                $.each(this.addedItems.items[i], function (key, value) {
                    if (id == value) {
                        found = true;
                        return !found;
                    }
                });
                if (found)
                    return i;
            }
        }
        return -1;
    }

    BaseAjaxTransferData.prototype.syncSession = function (url) {

        var strUrl = url + "syncdata";
        $.ajax({
            url: strUrl,
            type: "POST",
            data: this.addedItems,
            success: function (response) {
                console.log(response);
            }
        });
    }

    BaseAjaxTransferData.prototype.isEmptyGrid = function () {
        return ($(this.gridTable + ' tr').length == 1) ? true : false;
    }


    //Static method
    BaseAjaxTransferData.getStaticProduct = function (url) {
        var ma = $('#barcode').val();
        var strUrl = url + "getsanphamban/ma_vach/" + ma;
        var ret;
        $.ajax({
            url: strUrl,
            type: 'POST',
            async: false,
            success: function (response) {
                ret = response;
            }
        });
        return $.parseJSON(ret);
    }

    BaseAjaxTransferData.getStaticGiftProduct = function (url) {
        var ma = $('#barcode').val();
        var strUrl = url + "getsanphamtang/ma_vach/" + ma;
        var ret;
        $.ajax({
            url: strUrl,
            type: 'POST',
            async: false,
            success: function (response) {
                ret = response;
            }
        });
        return $.parseJSON(ret);
    }


    /*
     Kiem tra 1 id cua 1 san pham co nam trong danh sach san pham da them vao grid chua.
     Dung Json kiem tra
     */

    BaseAjaxTransferData.prototype.updateItemAtPosition = function (position, newData) {
        var self = this;
        var obj = this.addedItems.items[position];
        $.each(newData, function (key, value) {
            if (key in obj)
                self.addedItems.items[position][key] = value;
        });
    }

    // clear item and syc with session

    BaseAjaxTransferData.prototype.clearItem = function (id) {
        var self = this;
        for (i = 0; i < this.addedItems.items.length; i++) {
            if (this.addedItems.items[i].id == id)
                this.addedItems.items.splice(i, 1);
        }
    }

}


function extendClass(childClass, parentClass) {
    childClass.prototype = new parentClass();
    childClass.prototype.constructor = childClass;
}

function trimNumber(s) {
    while (s.substr(0, 1) == '0' && s.length > 1) {
        s = s.substr(1, 9999);
    }
    return s;
}