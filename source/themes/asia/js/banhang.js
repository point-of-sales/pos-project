var maInput = "#form-hd-ban-ma-input";
var gridTable = "#items"; 

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
    var strUrl = "getsanphamban/ma_vach/" + ma;
    $.ajax({
        url: strUrl,
        type: 'POST',
        success: function(data){
            var item = $.parseJSON(data);
            var even_odd = 'even';
            if(getNumRowsTable()%2 == 0)
                even_odd = 'odd';
            var strRow = 
                '<tr class="' + even_odd + '">' +
                    '<input type="hidden" value="' + item.id + '" id="" />' +
                    '<td>' + item.ma_vach + '</td>' +
                    '<td>' + item.ten_san_pham + '</td>' +
                    '<td><input type="text" id="" class="" /></td>' +
                    '<td>' + item.ma_vach + '</td>' +
                    '<td>' + item.ma_vach + '</td>' +
                    '<td></td>' +
                '</tr>';
            $(gridTable).append(strRow);
        }
    });
}

function getNumRowsTable(){
    return $(gridTable+' tr').length - 1;
}