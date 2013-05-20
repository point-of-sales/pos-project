//phim tat
var sKey = {
    enter : 13,
    z : 122,
    x : 120,
    c : 99,
    v : 118,
    b : 98,
    tab : 9,
    f1 : 112,
    f2 : 113,
    f3 : 114,
    f4 : 115,
    f5 : 116,
    f6 : 117,
    f7 : 118,
};

var sAction = {
    maVach : "Mã vạch",
    soLuong : "Số lượng",
    khachHang : "Khách hàng",
    timKhachHang : "Tìm khách hàng",
    hangTang : "Hàng tặng",
    tienNhan : "Tiền nhận",
};

var idForm = "#form";
var idMaInput = "#form-hd-ban-ma-input";
var idMaLabel = "#form-hd-ban-ma-label";
var idFormError = "#form-hd-ban-error";
var idGridTable = "#items";
var idDialogTimKH = "#dialog-tim-khach-hang";
var idDialogHangTang = "#dialog-hang-tang";
var idDialogThemKH = "#dialog-them-khach-hang";
var idHoTenKH = "#form-hd-ban-ho-ten-kh";
var idChietKhau = "#form-hd-ban-chiet-khau";
var idTong = "#form-hd-ban-tong";
var idTriGia = "#form-hd-ban-tri-gia";
var idMaHoaDon = "#form-hd-ban-ma-hoa-don";
var idInHoaDon = "#form-hd-ban-in";
var idChiNhanh = "#form-hd-ban-chi-nhanh";
var idHoTenNV = "#form-hd-ban-ho-ten-nv";
var idTienNhan = "#form-hd-ban-so-tien-nhan";
var idTienDu = "#form-hd-ban-tien-du";
var idGridHangTang = '#gridHangTang';
var idHangTangError = '#dialog-hang-tang-error';
var idHangTangList = '#dialog-hang-tang-list';
var baseUrl = "";
var curAction = "";
var cur_ma_vach = "";
var cur_so_luong = 1;
var in_hoa_don = false;

//chong reload page khi enter input text
function stopRKey(evt) {
  var evt = (evt) ? evt : ((event) ? event : null);
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
}
document.onkeypress = stopRKey;
///////////////////////////////////////////

/////////////////////////////////////////////////// START FORM////////////////////////////////////////////////

$(document).ready(function(){
    inHoaDon();
    dialogTimKhachHang();
    dialogHangTang();
    dialogThemKhachHang();
    xoaMaInput();
    baseUrl = $('#base-url').val();
    curAction = sAction.maVach;
    dongBoDuLieu();
});

$(document).keypress(function(e){
    /*var key = e.charCode||e.keyCode;
    if(key == sKey.f5){
        e.preventDefault();
        hoaDonMoi();
    }*/
});

function keypressInputMa(e){
    var key = e.charCode||e.keyCode;
    switch(key){
        case sKey.enter:{
            e.preventDefault();
            xuLyThaoTac();
        }break;
        case sKey.z:{   //ma vach
            e.preventDefault();
            chuyenDoiThaoTac(sAction.maVach);
        }break;
        case sKey.x:{   //khach hang
            e.preventDefault();
            chuyenDoiThaoTac(sAction.khachHang);
            xoaMaInput();
        }break;
        case sKey.tab:{ //so luong
            e.preventDefault();
            if(cur_ma_vach!=""){
                chuyenDoiThaoTac(sAction.soLuong);
                xoaMaInput("1");              
            }
        }break;
        case sKey.c:{   //tien nhan
            e.preventDefault();
            chuyenDoiThaoTac(sAction.tienNhan);
        }break;
        case sKey.f1:{   //tim khach hang
            e.preventDefault();
            $(idDialogTimKH).dialog('open');
        }break;
        case sKey.f2:{   //them khach hang
            e.preventDefault();
            $(idDialogThemKH).dialog('open');
        }break;
        case sKey.f3:{   //hang tang
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
        }break;
        case sAction.timKhachHang:{
            
        }break;
        case sAction.tienNhan:{
            capNhatTienNhan(true);
        }break;
    }
}

function chuyenDoiThaoTac(action){
    $(idMaLabel).html(action);
    curAction = action;
    xoaMaInput();
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

/////////////////////////////////////////////////// END FORM////////////////////////////////////////////////

/////////////////////////////////////////////////// START HOA DON////////////////////////////////////////////////
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

function inHoaDon(){
    $.ajax({
        url:"inhoadon",
        type:"POST",
        async:false,
        success:function(data){
            if(data=='true'){
                window.open('hoadon');   
            }
        },
    });
    $(idForm).submit(function(e){
        e.preventDefault();
        this.submit();  //k dung jquery o day de tranh lap vo tan
    });
}

function capNhatTienNhan(hand){
    var tien_nhan = 0,tien_du = 0;
    if(hand == true){
        tien_nhan = $(idMaInput).val();
        tien_du = parseInt(tien_nhan) - del_format($(idTriGia).text());
        if(tien_du<0){
            $(idFormError).text("Số tiền nhận không hợp lệ! Vui lòng nhập lại");
            $(idMaInput).select();
        }
        else{
            $(idTienNhan).text(vnd_format(tien_nhan));
            $(idTienDu).text(vnd_format(tien_du));
            $(idFormError).text("");
            chuyenDoiThaoTac(sAction.maVach);   
        }   
    }
    else{
        tien_nhan = del_format($(idTienNhan).text());
        if(tien_nhan>0){
            tien_du = parseInt(tien_nhan) - del_format($(idTriGia).text());
            if(tien_du<0){
                tien_du = 0;   
                $(idTienNhan).text("0");
                $(idFormError).text("Vui lòng nhập lại tiền nhận");
            }
            $(idTienDu).text(vnd_format(tien_du));   
        }
    }
    $.post(
        'capnhattiennhan',
        {tien_nhan:tien_nhan,tien_du:tien_du},
        function(data,status){}
    );
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
            var cthd_hang_tang = hd.cthd_hang_tang;
            //set ma hoa don
            $(idMaHoaDon).text(hd.ma_chung_tu);
            $(idChiNhanh).text(hd.chi_nhanh_id);
            $(idHoTenNV).text(hd.nhan_vien_id);
            $(idTriGia).text(vnd_format(hd.tri_gia));
            $(idTong).text(vnd_format(hd.tong));
            $(idTienNhan).text(vnd_format(hd.tien_nhan));
            $(idTienDu).text(vnd_format(hd.tien_du));
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
                capNhatTienNhan(false);
            }
            if(cthd_hang_tang!=null){
                var str = '';
                even_odd = 'even';
                if(laySoDongGrid()%2 == 0)
                    even_odd = 'odd';
                for(var i=0;i<cthd_hang_tang.length;i++){
                    str += 
                        '<tr class="'+even_odd+'">'+
                            '<td id="mvht_'+cthd_hang_tang[i].id+'">' + cthd_hang_tang[i].ma_vach + '</td>' +
                            '<td id="tht_'+cthd_hang_tang[i].ten_san_pham+'">' + cthd_hang_tang[i].ten_san_pham + '</td>' +
                            //'<td><input type="text" id="slht_'+cthd_hang_tang[i].id+'" value="'+cthd_hang_tang[i].so_luong+'" onkeypress="capNhatSoLuongHangTang(event,'+cthd_hang_tang[i].id+')" /></td>' +
                            '<td id="slht_'+cthd_hang_tang[i].id+'">'+cthd_hang_tang[i].so_luong+'</td>'+
                            '<td colspan="2">Hàng tặng</td>'+
                            '<td>'+'<a title="Xóa" href="javascript:;" onclick="xoaHangTang('+cthd_hang_tang[i].id+')">'+
                                '<img alt="Xóa" src="'+baseUrl+'/themes/asia/images/delete.png" />'+'</a>'+
                            '</td>'+
                        '</tr>';
                    even_odd = (even_odd=='even')?'odd':'even';
                }
                $(idGridTable).append(str);
            }
        }
    });
}

function capNhatThanhTien(id){
    var sl = $('#sl_'+id).val();
    var gb = del_format($('#gb_'+id).text());
    $('#tt_'+id).text(vnd_format(sl*gb));
}

/////////////////////////////////////////////////// END HOA DON////////////////////////////////////////////////

/////////////////////////////////////////////////// START KHACH HANG////////////////////////////////////////////////

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

function dialogThemKhachHang(){
    $(idDialogThemKH).dialog({
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
                chuyenDoiThaoTac(sAction.maVach);
                $(idFormError).html("");
                dongBoDuLieu();
            }
            else{
                xoaMaInput();
                $(idFormError).html(item.msg);
            }   
        }
    });
}

/////////////////////////////////////////////////// END KHACH HANG////////////////////////////////////////////////

/////////////////////////////////////////////////// START HANG TANG////////////////////////////////////////////////

var arr_id_hang_tang = new Array();

function dialogHangTang(){
    $(idDialogHangTang).dialog({
    	autoOpen: false,
    	width: 800,
    	height: 500,
    	modal: true,
    	buttons:{
            "Chấp nhận": function(){
                $.ajax({
                    type: 'POST',
                    url: 'capnhathangtang',
                    async: false,
                    data: {arr_hang_tang:JSON.stringify(getArrayHangtang())},    
                    success: function(data){
                        var result = $.parseJSON(data);
                        if(result.status == 'ok'){
                            $(idHangTangError).html('');
                            dongBoDuLieu();
                        }     
                        else{
                            $(idHangTangError).html(result.msg);
                        }
                    }
                });
                if($(idHangTangError).html()==''){
                    $(this).dialog("close");   
                }
            },
            "Hủy bỏ": function(){
                $(this).dialog("close");
            }
        },
        beforeClose: function(event,ui){
            xoaMaInput();
        },
        open: function(event,ui){
            layHangTang();
            arr_id_hang_tang = new Array();
            $(idHangTangError).html('');
            $(idHangTangList).html('');
        }
    });
}

function layHangTang(){
    var tri_gia = del_format($(idTriGia).text());
    $.ajax({
        url: 'layhangtang',
        type: 'POST',
        data: {tri_gia:tri_gia},
        success: function(data,status){
            var hang_tang = $.parseJSON(data);
            if(hang_tang!=null){
                var str = 
                    '<tr>'+
                        '<th>Mã vạch</th>'+
                        '<th>Tên hàng tặng</th>'+
                        '<th>Số lượng</th>'+
                        '<th>Giá được tặng</th>'+
                        '<th></th>'+
                    '</tr>';
                for(var i=0;i<hang_tang.length;i++){
                    var even_odd = 'odd';
                    if(i%2 == 0)
                        even_odd = 'even';
                    var strRow = 
                        '<tr class="' + even_odd + '">' +
                            '<input type="hidden" value="' + hang_tang[i].id + '" id="idht_d_'+hang_tang[i].id+'" />' +
                            '<td id="mvht_d_'+hang_tang[i].id+'">' + hang_tang[i].ma_vach + '</td>' +
                            '<td id="tht_d_'+hang_tang[i].id+'">' + hang_tang[i].ten_san_pham + '</td>' +
                            '<td><input type="text" id="slht_d_'+hang_tang[i].id+'" class="" value="1" /></td>' +
                            '<td id="ght_d_'+hang_tang[i].id+'">' + vnd_format(hang_tang[i].gia_tang) + '</td>' +
                            '<td><input type="checkbox" id="chk_d_'+hang_tang[i].id+'" onclick=checkHangTang('+hang_tang[i].id+') /></td>' +
                        '</tr>';
                    str += strRow;
                    
                }
                $(idGridHangTang).html(str);
            }
        }
    });
}

function checkHangTang(id){
    if($('#chk_d_'+id).is(':checked')){
        for(var i=0;i<arr_id_hang_tang.length;i++){
            if(arr_id_hang_tang[i]==id) return;
        }   
        arr_id_hang_tang.push(id);
        updateListHangTang();
    }
    else{
        for(var i=0;i<arr_id_hang_tang.length;i++){
            if(arr_id_hang_tang[i]==id){
                arr_id_hang_tang.splice(i,1);
            }
        }
        updateListHangTang();
    }
}

function updateListHangTang(){
    var str = '';
    for(var i=0;i<arr_id_hang_tang.length;i++){
        str += $('#tht_d_'+arr_id_hang_tang[i]).text() + ', ';
    }
    $(idHangTangList).text(str);
}

function getArrayHangtang(){
    var arr_hang_tang = Array();
    for(var i=0;i<arr_id_hang_tang.length;i++){
        var id = arr_id_hang_tang[i];
        var row = {
            'id':id,
            'so_luong': $('#slht_d_'+id).val(),
            'ma_vach': $('#mvht_d_'+id).text(),
            'ten_san_pham': $('#tht_d_'+id).text(),
        };        
        arr_hang_tang.push(row);
    }
    return arr_hang_tang;
}

function xoaHangTang(id){
    var ma_vach = $('#mvht_'+id).text();
    var strUrl = "xoahangtang";
    $.ajax({
        async: false,
        url: strUrl,
        type: 'POST',
        data: {ma_vach:ma_vach},
        success: function(data){
            var item = $.parseJSON(data);
            if(item.status == 'ok'){
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

/////////////////////////////////////////////////// END HANG TANG ////////////////////////////////////////////////

/////////////////////////////////////////////////// START SAN PHAM ////////////////////////////////////////////////

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

/////////////////////////////////////////////////// END SAN PHAM ////////////////////////////////////////////////