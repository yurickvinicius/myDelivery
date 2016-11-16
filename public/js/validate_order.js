function validateOrder(){

    var errorValidate = false;

    if ($('#cadName').val() == ''){
        $('div[id=divCadName]').addClass('has-error');
        errorValidate = true;
    }else{
        $('div[id=divCadName]').removeClass('has-error');
    }
    ///
    if ($('#cadNeighborhood').val() == ''){
        $('div[id=divCadNeighborhood]').addClass('has-error');
        errorValidate = true;
    }else{
        $('div[id=divCadNeighborhood]').removeClass('has-error');
    }
    ///
    if ($('#cadAddress').val() == ''){
        $('div[id=divCadAddress]').addClass('has-error');
        errorValidate = true;
    }else{
        $('div[id=divCadAddress]').removeClass('has-error');
    }
    ///
    if ($('#cadNumber').val() == ''){
        $('div[id=divCadNumber]').addClass('has-error');
        errorValidate = true;
    }else{
        $('div[id=divCadNumber]').removeClass('has-error');
    }
    ///
    if ($('#cadTelCellPhone').val() == ''){
        $('div[id=divCadCellPhone]').addClass('has-error');
        errorValidate = true;
    }else{
        $('div[id=divCadCellPhone]').removeClass('has-error');
    }
    ///
    if ($('#delivery_means').val() == 0){
        $('div[id=divDeliverymeans]').addClass('has-error');
        errorValidate = true;
    }else{
        $('div[id=divDeliverymeans]').removeClass('has-error');
    }
    ///
    var qtdPizzas = $("pizza").length + 1;
    for(var i=1; i<= qtdPizzas; i++){
        if($('#cad_edge_'+i+'').val() == 0){
            $('#divCadEdge_'+i+'').addClass('has-error');
            errorValidate = true;
        }else{
            $('#divCadEdge_'+i+'').removeClass('has-error');
        }
        ///
        if($('#cad_size_pizza_'+i+'').val() == 0){
            $('#divCadSize_'+i+'').addClass('has-error');
            errorValidate = true;
        }else{
            $('#divCadSize_'+i+'').removeClass('has-error');
        }
        ///
        if($('#cad_flavors_'+i+'').is(':empty')){
            $('#divCadFlavor_'+i+'').addClass('has-error');
            errorValidate = true;
        }else{
            $('#divCadFlavor_'+i+'').removeClass('has-error');
        }
    }

    ///////
    if(errorValidate == true){
      alert('Existem campos inválidos');
      return false;
    }

    frm.submit();
}
