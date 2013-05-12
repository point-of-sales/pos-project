//phim tat
var sKey = {
    enter : 13,
    z : 122,
    x : 120,
    c : 99,
    v : 118,
    tab : 9,
    f1 : 112,
    f2 : 113,
    f3 : 114,
    f4 : 115,
    f5 : 116,
};

var sAction = {
    maVach : "Mã vạch",
    soLuong : "Số lượng",
    khachHang : "Khách hàng",
    timKhachHang : "Tìm khách hàng",
    hangTang : "Hàng tặng"
};

var idMaInput = "#form-hd-ban-ma-input";
var idMaLabel = "#form-hd-ban-ma-label";
var idFormError = "#form-hd-ban-error";
var idGridTable = "#items";
var idDialogTimKH = "#dialog-tim-khach-hang";
var idDialogHangTang = "#dialog-hang-tang";
var idHoTenKH = "#form-hd-ban-ho-ten-kh";
var idChietKhau = "#form-hd-ban-chiet-khau";
var idTong = "#form-hd-ban-tong";
var idTriGia = "#form-hd-ban-tri-gia";
var idMaHoaDon = "#form-hd-ban-ma-hoa-don";
var idInHoaDon = "#form-hd-ban-in";
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
    dialogTimKhachHang();
    dialogHangTang();
    xoaMaInput();
    baseUrl = $('#base-url').val();
    curAction = sAction.maVach;
    dongBoDuLieu();
});

function hoaDonMoi(){
    var conf = confirm("Tạo hóa đơn mới?");
    if(conf==true){
        $.ajax({
            url:"hoadonmoi",
            type:"POST",
            success:function(data){
                location.reload();
            },
        });   
    }
}

function dialogTimKhachHang(){
    $(idDialogTimKH).dialog({
    	autoOpen: false,
    	width: 300,
    	height: 230,
    	modal: true,
        buttons:{
            "Chấp nhận": function(){
                $(this).dialog("close");
            },
            "Hủy bỏ": function(){
                $(this).dialog("close");
            }
        },
        beforeClose: function(event,ui){
            xoaMaInput();
        }
    });
}

function dialogHangTang(){
    $(idDialogHangTang).dialog({
    	autoOpen: false,
    	width: 800,
    	height: 500,
    	modal: true,
    	buttons:{
            "Chấp nhận": function(){
                $(this).dialog("close");
            },
            "Hủy bỏ": function(){
                $(this).dialog("close");
            }
        },
        beforeClose: function(event,ui){
            xoaMaInput();
        }
    });
}

function keypressInputMa(e){
    var key = e.charCode||e.keyCode;
    switch(key){
        case sKey.enter:{
            e.preventDefault();
            xuLyThaoTac();
        }break;
        case sKey.f2:{   //khach hang
            e.preventDefault();
            chuyenDoiThaoTac(sAction.khachHang);
            xoaMaInput();
        }break;
        case sKey.f1:{   //ma vach
            e.preventDefault();
            chuyenDoiThaoTac(sAction.maVach);
        }break;
        case sKey.tab:{ //so luong
            e.preventDefault();
            if(cur_ma_vach!=""){
                chuyenDoiThaoTac(sAction.soLuong);
                xoaMaInput("1");              
            }
        }break;
        case sKey.f3:{   //tim khach hang
            e.preventDefault();
            $(idDialogTimKH).dialog('open');
        }break;
        case sKey.f4:{   //tim khach hang
            e.preventDefault();
            $(idDialogHangTang).dialog('open');
        }break;
    }
}

function xuLyThaoTac(){
    switch(curAction){
        case sAction.maVach:{
            cur_ma_vach = $(idMaInput).val();
            cur_so_luong = 1;
            laySanPhamBan();
            xoaMaInput();
        }break;
        case sAction.soLuong:{
            cur_so_luong = $(idMaInput).val();
            capNhatSoLuong(cur_ma_vach,cur_so_luong);
        }break;
        case sAction.khachHang:{
            layKhachHang();
            chuyenDoiThaoTac(sAction.maVach);
        }break;
        case sAction.timKhachHang:{
            
        }break;
    }
}

function chuyenDoiThaoTac(action){
    $(idMaLabel).html(action);
    curAction = action;
    xoaMaInput();
}

function layKhachHang(){
    var ma_khach_hang = $(idMaInput).val();
    var strUrl = "laykhachhang";
    $.ajax({
        async: false,
        url: strUrl,
        type: 'POST',
        data: {ma_khach_hang: ma_khach_hang},
        success: function(data){
            var item = $.parseJSON(data);
            if(item.status == 'ok'){
                $(idFormError).html("");
                dongBoDuLieu();
                chuyenDoiThaoTac(sAction.ma_vach);
            }
            else{
                $(idFormError).html(item.msg);
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
                $(idFormError).html("");
                dongBoDuLieu();
            }
            else{
                $(idFormError).html(item.msg);
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
                    $(idFormError).html("");
                    dongBoDuLieu();
                    xoaMaInput();
                }
                else{
                    $('#sl_'+id).select();
                    $(idFormError).html(item.msg);
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
                cur_ma_vach = "";
                $(idFormError).html("");
                dongBoDuLieu();
                chuyenDoiThaoTac(sAction.maVach);
            }
            else{
                $(idMaInput).select();
                $(idFormError).html(item.msg);
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
                $(idFormError).html("");
                dongBoDuLieu();
                xoaMaInput();
            }
            else{
                $(idFormError).html(item.msg);
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
            var hd = $.parseJSON(data);
            if(hd==null)
                return;
            var cthd = hd.cthd_ban_hang;
            var kh = hd.khach_hang;
            //set ma hoa don
            $(idMaHoaDon).text(hd.ma_chung_tu);
            //set tri gia hoa don
            $(idTriGia).text(vnd_format(hd.tri_gia));
            if(kh!=null){
                $(idHoTenKH).text(kh.ho_ten);
                $(idChietKhau).text(hd.chiet_khau);
            }
            if(cthd!=null){
                for(var i=0;i<cthd.length;i++){
                    var even_odd = 'even';
                    if(laySoDongGrid()%2 == 0)
                        even_odd = 'odd';
                    var strRow = 
                        '<tr class="' + even_odd + '">' +
                            '<input type="hidden" value="' + cthd[i].id + '" id="" />' +
                            '<td id="mv_'+cthd[i].id+'">' + cthd[i].ma_vach + '</td>' +
                            '<td>' + cthd[i].ten_san_pham + '</td>' +
                            '<td><input type="text" id="sl_'+cthd[i].id+'" class="" value="'+cthd[i].so_luong+'" onkeypress="capNhatSoLuongGrid(event,'+cthd[i].id+')" /></td>' +
                            '<td id="gb_'+cthd[i].id+'">' + vnd_format(cthd[i].don_gia) + '</td>' +
                            '<td id="tt_'+cthd[i].id+'">' + '</td>' +
                            '<td>'+'<a title="Xóa" href="javascript:;" onclick="xoaSanPhamBan('+cthd[i].id+')">'+
                                '<img alt="Xóa" src="'+baseUrl+'/themes/asia/images/delete.png" />'+'</a>'+
                            '</td>'+
                        '</tr>';
                    $(idGridTable).append(strRow);
                    //update thanh tien
                    capNhatThanhTien(cthd[i].id);
                }
                //tinh tong tien
                var tong = 0;
                for(var i=0;i<cthd.length;i++){
                    tong += del_format($("#tt_"+cthd[i].id).text());
                }
                $(idTong).text(vnd_format(tong));
            }
        }
    });
}

function capNhatThanhTien(id){
    var sl = $('#sl_'+id).val();
    var gb = del_format($('#gb_'+id).text());
    $('#tt_'+id).text(vnd_format(sl*gb));
}

function laySoDongGrid(){
    return $(idGridTable+' tr').length - 1;
}

function xoaMaInput(text){
    $(idMaInput).val(text);
    $(idMaInput).select();
    $(idMaInput).focus();
}

function xoaGrid(){
    $(idGridTable).empty();
    $(idGridTable).html(
    '<tr>'+
        '<th>Mã vạch</th>'+
        '<th>Tên sản phẩm</th>'+
        '<th>Số lượng</th>'+
        '<th>Giá</th>'+
        '<th>Thành tiền</th>'+
        '<th></th>'+
    '</tr>');
}

function vnd_format(number){
    return number_format(number,0,'.',',')
}

function del_format(number){
    number = number.toString();
    number = number.replace(',','');
    number = number.replace('.','');
    return parseInt(number); 
}

function number_format( number, decimals, dec_point, thousands_sep ) {   
    var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
    var d = dec_point == undefined ? "," : dec_point;
    var t = thousands_sep == undefined ? "." : thousands_sep, s = n < 0 ? "-" : "";
    var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
                              
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}