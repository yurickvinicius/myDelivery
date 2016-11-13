function validateOrder(){

    var errorValidate = false;

    alert('this is test: '+$('#cadName').val());

    if ($('#cadName').val() == ''){
        $('div[id=divCadName]').addClass('has-error');
        errorValidate = true;
    }else{
        $('div[id=divCadName]').removeClass('has-error');
        errorValidate = false;
    }

    ///////
    if(errorValidate == true)
      return false;

    frm.submit();    
}
