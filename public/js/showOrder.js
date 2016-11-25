function statusOrder(){
    if($('#rdSendPizza').is(':checked')){
        $('#divDeliverymens').show();
    }else{
        $('#divDeliverymens').hide();
    }
}

$(document).ready(function(){
    $('#divDeliverymens').hide();

    if($('#rdSendPizza').is(':checked')){
        $('#divDeliverymens').show();
    }
})
