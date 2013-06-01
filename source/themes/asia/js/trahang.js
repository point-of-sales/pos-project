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
//chong reload page khi enter input text
function stopRKey(evt) {
  var evt = (evt) ? evt : ((event) ? event : null);
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
}

document.onkeypress = stopRKey;
var arr_id_hang_ban = new Array();
var idMsgBox = "#msg-box";
function xoa_grid(id){
    $("#row_"+id).remove();
}
function capNhatTriGia(){
    var tri_gia=0;
    //if(kiemTraSoLuong()){
        for(var i=0;i<arr_id_hang_ban.length;i++){
            tri_gia += parseInt($("#sl_"+arr_id_hang_ban[i]).val()) * parseInt($("#dg_"+arr_id_hang_ban[i]).val());
        }
        $("#tri_gia").val(tri_gia);
        $(idMsgBox).text('');   
    //}
    //else{
      //  $(idMsgBox).text('Số lượng không hợp lệ');
    //}
}
function capNhatInput(e){
    if(e.keyCode==sKey.enter){
        capNhatTriGia();
    }
}
function kiemTraSoLuong(){
    for(var i=0;i<arr_id_hang_ban.length;i++){
        var sl = $("#chk_"+arr_id_hang_ban[i]).val();
        var sl_parse = parseInt($("#chk_"+arr_id_hang_ban[i]).val());
        //if(isInteger(sl)==false||sl_parse<=0||sl_parse>$("#sl_"+arr_id_hang_ban[i]).val())
        if(isInteger(sl)==false)
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