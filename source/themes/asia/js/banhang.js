var maInput = "#form-hd-ban-ma-input";

//chong reload page khi enter input text
function stopRKey(evt) {
  var evt = (evt) ? evt : ((event) ? event : null);
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
}
document.onkeypress = stopRKey;
///////////////////////////////////////////

function keypressInputMa(e){
    switch(e.keyCode){
        case 13:{
            getSanPhamBan();
        }break;
    }
}

function getSanPhamBan(){
    var ma = $(maInput).val();
    var url = "getsanphamban/ma_vach/" + ma;
    $.post(url,{
        ma_vach:ma,
    },
    function (data,status){
        alert(status);
        $.fn.yiiGridView.update('form-hd-ban-grid');
    });
}