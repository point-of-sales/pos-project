//phim tat
var sKey = {
    enter : 13,
    z : 122,
    x : 120,
    c : 99,
    v : 118,
    f5 : 116,
    tab : 9
};

var sAction = {
    maVach : "Mã vạch",
    soLuong : "Số lượng",
    khachHang : "Khách hàng",
    timKhachHang : "Tìm khách hàng"
};

var maInput = "#form-hd-ban-ma-input";
var maLabel = "#form-hd-ban-ma-label";
var formError = "#form-hd-ban-error";
var gridTable = "#items";
var timKHDialog = "#dialog-tim-khach-hang";
var baseUrl = "";
var curAction = "";
var cur_ma_vach = "";
var cur_so_luong = 1;

//chong reload page khi enter input text
function stopRKey(evt) {
  var evt = (evt) ? evt : ((event) ? event : null);
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
}
document.onkeypress = stopRKey;
///////////////////////////////////////////

$(document).ready(function(){
    // Login Dialog Link
    $(timKHDialog).click(function(){
    	$('#dialog-tim-khach-hang').dialog('open');
    	return false;
    });
    
    // Login Dialog			
    $(timKHDialog).dialog({
    	autoOpen: false,
    	width: 300,
    	height: 230,
    	bgiframe: true,
    	modal: true,
    	buttons: {
    		"Login": function() { 
    			$(this).dialog("close"); 
    		}, 
    		"Close": function() { 
    			$(this).dialog("close"); 
    		} 
    	}
    });
    
    xoaMaInput();
    baseUrl = $('#base-url').val();
    curAction = sAction.maVach;
    dongBoDuLieu();
});

function keypressInputMa(e){
    var key = e.charCode||e.keyCode;
    switch(key){
        case sKey.enter:{
            xuLyThaoTac();
        }break;
        case sKey.x:{
            e.preventDefault();
            chuyenDoiThaoTac(sAction.khachHang);
        }break;
        case sKey.z:{
            e.preventDefault();
            chuyenDoiThaoTac(sAction.maVach);
        }break;
        case sKey.tab:{
            e.preventDefault();//ngan khong cho tab di cho khac
            if(cur_ma_vach!=""){
                chuyenDoiThaoTac(sAction.soLuong);
                xoaMaInput("1");              
            }
        }break;
        case sKey.c:{
            $(timKHDialog).dialog('open');
        }break;
    }
}

function xuLyThaoTac(){
    switch(curAction){
        case sAction.maVach:{
            cur_ma_vach = $(maInput).val();
            cur_so_luong = 1;
            laySanPhamBan();
            xoaMaInput();
        }break;
        case sAction.soLuong:{
            cur_so_luong = $(maInput).val();
            capNhatSoLuong(cur_ma_vach,cur_so_luong);
            xoaMaInput();
            chuyenDoiThaoTac(sAction.maVach);
        }break;
        case sAction.khachHang:{
            layKhachHang();
            xoaMaInput();
        }break;
        case sAction.timKhachHang:{
            
        }break;
    }
}

function chuyenDoiThaoTac(action){
    $(maLabel).html(action);
    curAction = action;
    xoaMaInput();
}

function layKhachHang(){
    var ma_khach_hang = $(maInput).val();
    var strUrl = "laykhachhang";
    $.ajax({
        async: false,
        url: strUrl,
        type: 'POST',
        data: {ma_khach_hang: ma_khach_hang},
        success: function(data){
            var item = $.parseJSON(data);
            if(item.status == 'ok'){
                $(formError).html("");
                dongBoDuLieu();
            }
            else{
                $(formError).html(item.msg);
            }   
        }
    });
}

function laySanPhamBan(){
    var ma_vach = cur_ma_vach;
    var so_luong = cur_so_luong;
    var strUrl = "laysanphamban";
    $.ajax({
        async: false,
        url: strUrl,
        type: 'POST',
        data: {ma_vach:ma_vach,so_luong:so_luong},
        success: function(data){
            var item = $.parseJSON(data);
            if(item.status == 'ok'){
                $(formError).html("");
                dongBoDuLieu();
            }
            else{
                $(formError).html(item.msg);
            }   
        }
    });
}

function capNhatSoLuongGrid(e,id){
    if(e.keyCode==sKey.enter){
        var so_luong = $('#sl_'+id).val();
        var ma_vach = $('#mv_'+id).text();
        var strUrl = "capnhatsoluong";
        $.ajax({
            async: false,
            url: strUrl,
            type: 'POST',
            data: {ma_vach:ma_vach,so_luong:so_luong},
            success: function(data){
                var item = $.parseJSON(data);
                if(item.status == 'ok'){
                    $(formError).html("");
                    dongBoDuLieu();
                    xoaMaInput();
                }
                else{
                    $(formError).html(item.msg);
                }   
            }
        });   
    }
}

function capNhatSoLuong(ma_vach,so_luong){
    var strUrl = "capnhatsoluong";
    $.ajax({
        async: false,
        url: strUrl,
        type: 'POST',
        data: {ma_vach:ma_vach,so_luong:so_luong},
        success: function(data){
            var item = $.parseJSON(data);
            if(item.status == 'ok'){
                $(formError).html("");
                dongBoDuLieu();
            }
            else{
                $(formError).html(item.msg);
            }   
        }
    });
}

function xoaSanPhamBan(id){
    var ma_vach = $('#mv_'+id).text();
    var strUrl = "xoasanphamban";
    $.ajax({
        async: false,
        url: strUrl,
        type: 'POST',
        data: {ma_vach:ma_vach},
        success: function(data){
            var item = $.parseJSON(data);
            if(item.status == 'ok'){
                cur_ma_vach = "";
                $(formError).html("");
                dongBoDuLieu();
                xoaMaInput();
            }
            else{
                $(formError).html(item.msg);
            }   
        }
    }); 
}

function dongBoDuLieu(){
    xoaGrid();
    $.ajax({
        url: 'dongbodulieu',
        type: 'POST',
        async: false,
        success: function(data){
            var arr = $.parseJSON(data);
            if(arr==null)
                return;
            for(var i=0;i<arr.length;i++){
                var even_odd = 'even';
                if(laySoDongGrid()%2 == 0)
                    even_odd = 'odd';
                var strRow = 
                    '<tr class="' + even_odd + '">' +
                        '<input type="hidden" value="' + arr[i].id + '" id="" />' +
                        '<td id="mv_'+arr[i].id+'">' + arr[i].ma_vach + '</td>' +
                        '<td>' + arr[i].ten_san_pham + '</td>' +
                        '<td><input type="text" id="sl_'+arr[i].id+'" class="" value="'+arr[i].so_luong+'" onkeypress="capNhatSoLuongGrid(event,'+arr[i].id+')" /></td>' +
                        '<td id="gb_'+arr[i].id+'">' + arr[i].gia_ban + '</td>' +
                        '<td id="tt_'+arr[i].id+'">' + '</td>' +
                        '<td>'+'<a title="Xóa" href="javascript:;" onclick="xoaSanPhamBan('+arr[i].id+')">'+
                            '<img alt="Xóa" src="'+baseUrl+'/themes/asia/images/delete.png" />'+'</a>'+
                        '</td>'+
                    '</tr>';
                $(gridTable).append(strRow);
                //update thanh tien
                capNhatThanhTien(arr[i].id);
            }
        }
    });
}

function capNhatThanhTien(id){
    var sl = $('#sl_'+id).val();
    var gb = $('#gb_'+id).text();
    $('#tt_'+id).text(sl*gb);
}

function laySoDongGrid(){
    return $(gridTable+' tr').length - 1;
}

function xoaMaInput(text=""){
    $(maInput).val(text);
    $(maInput).select();
    $(maInput).focus();
}

function xoaGrid(){
    $(gridTable).empty();
    $(gridTable).html(
    '<tr>'+
        '<th>Mã vạch</th>'+
        '<th>Tên sản phẩm</th>'+
        '<th>Số lượng</th>'+
        '<th>Giá</th>'+
        '<th>Thành tiền</th>'+
        '<th></th>'+
    '</tr>');
}