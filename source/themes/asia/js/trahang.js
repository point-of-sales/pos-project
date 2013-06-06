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
var idForm = '#form-tra-hang';
var idInHoaDon = '#in-hoa-don';
var idHoaDonTra = '#id-hd-tra';
//chong reload page khi enter input text
function stopRKey(evt) {
  var evt = (evt) ? evt : ((event) ? event : null);
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
}

document.onkeypress = stopRKey;
$(document).ready(function(){
    inHoaDon();
});

function inHoaDon(){   
    $(idForm).submit(function(e){
        e.preventDefault();
        //edit url den controller
        var url = location.href;
        var index = url.indexOf('hoaDonBanHang');
        url = url.substring(0,index) + 'hoaDonTraHang/';
        this.submit();  //k dung jquery o day de tranh lap vo tan
        $.ajax({
            url:url+'inhoadon',
            type:"POST",
            async:false,
            success:function(data){
                if(data!='false'){
                    window.open(url+'hoadontra/id/'+data);   
                }
            },
        });
    });
}

var arr_id_hang_ban = new Array();
var idMsgBox = "#msg-box";

function messageBox(content){
    $(idMsgBox).text(content);
    if(content!=''){
        $(idMsgBox).attr('class','response-msg error ui-corner-all');   
    }
    else{
        $(idMsgBox).attr('class','');
    }
}
function xoa_grid(id){
    $("#row_"+id).remove();
}
function capNhatTriGia(){
    var tri_gia=0;
    if(kiemTraSoLuong()){
        for(var i=0;i<arr_id_hang_ban.length;i++){
            tri_gia += parseInt($("#sl_"+arr_id_hang_ban[i]).val()) * parseInt($("#dg_"+arr_id_hang_ban[i]).val());
        }
        $("#tri_gia").val(tri_gia);
        //$(idMsgBox).text('');
        messageBox('');   
    }
    else{
        //$(idMsgBox).text('Số lượng không hợp lệ');
        messageBox('Số lượng không hợp lệ');
    }
}
function capNhatInput(e){
    if(e.keyCode==sKey.enter){
        capNhatTriGia();
    }
}
function kiemTraSoLuong(){
    for(var i=0;i<arr_id_hang_ban.length;i++){
        var sl = $("#sl_"+arr_id_hang_ban[i]).val();
        var sl_parse = parseInt($("#sl_"+arr_id_hang_ban[i]).val());
        if(isInteger(sl)==false||sl_parse<=0||sl_parse>$("#chk_"+arr_id_hang_ban[i]).val())
            return false;
    }
    return true;
}
function autoInput(id){
    if($("#chk_"+id).is(':checked')){
        $("#sl_"+id).removeAttr('disabled');
        $("#dg_"+id).removeAttr('disabled');
        
        for(var i=0;i<arr_id_hang_ban.length;i++){
            if(arr_id_hang_ban[i]==id) return;
        }   
        arr_id_hang_ban.push(id);
    }
    else{
        $("#sl_"+id).attr('disabled','disabled');
        $("#dg_"+id).attr('disabled','disabled');
        
        for(var i=0;i<arr_id_hang_ban.length;i++){
            if(arr_id_hang_ban[i]==id){
                arr_id_hang_ban.splice(i,1);
            }
        }
    }
    capNhatTriGia();
}