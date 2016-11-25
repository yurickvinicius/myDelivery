
var url = 'http://localhost:8000';

function searchCEP() {

  var cep = $('#cadCEP').val();

  $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep=" + cep, function () {

    if (resultadoCEP["resultado"] != 0) {
      $("#cadCity").val(unescape(resultadoCEP["cidade"]));
      $('#cadState option:selected').text(unescape(resultadoCEP["uf"]));
      $('#cadState option:selected').val(unescape(resultadoCEP["uf"]));
      $("#cadAddress").val(unescape(resultadoCEP["logradouro"]));
      $("#cadNeighborhood").val(unescape(resultadoCEP["bairro"]));
    }
  })

}

function checkPizza(idFlavor, idPizza){
  if(idPizza > 1)
  idFlavor++;

  if(checkSizePizza(idPizza, idFlavor) == true){

    var qtd = $('input[type=number][id=flavorNumberPizza_'+idPizza+'][flavorId='+idFlavor+']').val();
    if(qtd > 0){
      $('input[type=number][id=flavorNumberPizza_'+idPizza+'][flavorId='+idFlavor+']').addClass('flavorSelected');
    }else if(qtd <= 0){
      $('input[type=number][id=flavorNumberPizza_'+idPizza+'][flavorId='+idFlavor+']').removeClass('flavorSelected');
      $('input[type=number][id=flavorNumberPizza_'+idPizza+'][flavorId='+idFlavor+']').val('');
    }

    var maxSize = parseInt($('select[id=cad_size_pizza_'+idPizza+'] option:selected').attr('parts'));
    if(qtd > maxSize){
      alert('Escolher no máximo: '+ maxSize + ' pedaços!')
      qtd--;
      $('input[type=number][id=flavorNumberPizza_'+idPizza+'][flavorId='+idFlavor+']').val(qtd);
    }

    var qtdTotal = 0, aux=0, total=0;
    $('input[type=number][id=flavorNumberPizza_'+idPizza+']').each(function(){
      qtdTotal += $(this).val();
    })

    for(var i=0; i < qtdTotal.length; i++){
      total = parseInt(qtdTotal[i]) + aux;
      aux = total;
    }

    totalPieces(total, maxSize, qtd, idPizza, idFlavor);
  }

}

function checkSizePizza(idPizza, idFlavor){
  var sizePizza = $('#cad_size_pizza_'+idPizza+'').val();
  if(sizePizza == 0){
    alert('Necessário selecionar o tamanho da pizza!');
    $('input[type=number][id=flavorNumberPizza_'+idPizza+'][flavorId='+idFlavor+']').val('');
    return false;
  }else if(sizePizza > 0){
    return true;
  }
}

function totalPieces(total, maxSize, qtd, idPizza, idFlavor){
  if(total > maxSize){
    qtd--;
    if(qtd < 1)
    qtd = '';

    $('input[type=number][id=flavorNumberPizza_'+idPizza+'][flavorId='+idFlavor+']').val(qtd);
    alert('Escolher no máximo: '+ maxSize + ' pedaços!');
    if(qtd < 1)
    $('input[type=number][id=flavorNumberPizza_'+idPizza+'][flavorId='+idFlavor+']').removeClass('flavorSelected');
    else
    $('input[type=number][id=flavorNumberPizza_'+idPizza+'][flavorId='+idFlavor+']').addClass('flavorSelected');
  }
}

function searchClient() {

  var data = $('#inpSearchClient').val();

  if (data.length > 0) {
    $.ajax({
      url: url + '/client/search/' + data + '',
      dataType: "json",
      cache: false,
      success: function (data) {
        var ul = '<ul style="list-style-type: none; margin-left: -8%;">';
        for (var i = 0; i < data.length; i++) {
          ul += "<li onclick='fillFields(\""
          + data[i].name + "\", \""
          + data[i].cep + "\", \""
          + data[i].neighborhood + "\", \""
          + data[i].address + "\", \""
          + data[i].number + "\", \""
          + data[i].complement + "\", \""
          + data[i].cell_phone + "\", \""
          + data[i].phone + "\")' class='searchName'>" + data[i].name + " - " + data[i].cell_phone + " - " + data[i].phone + "</li>";
        }
        ul += '<ul>';

        $('div[id=divSearchClient]').html(ul);
      },
    });
  }

  if (data.length <= 0) {
    $('div[id=divSearchClient]').html('');
  }

}

function fillFields(name, cep, neighborhood, address, number, complement, cell_phone, phone) {
  $('#cadName').attr('value', name);
  $('#cadCEP').val(cep);
  $('#cadNeighborhood').attr('value', neighborhood);
  $('#cadAddress').attr('value', address);
  $('#cadNumber').attr('value', number);
  $('#cadComplement').attr('value', complement);

  $('#cadTelCellPhone').val(cell_phone);
  $('#cadTelCellPhone').mask("(99)9999-9999");

  $('#cadTelPhone').val(phone);
  $('#cadTelPhone').mask("(99)9999-9999");

  $('input[id=inpSearchClient]').val('');
  $('div[id=divSearchClient]').html('');
}

function showFlavorCod(pizza) {

  var cod = $('input[id=inp_flavor_cod_' + pizza + ']').val();

  if (cod.length > 0) {

    $.ajax({
      url: url + '/flavor/' + cod + '/show',
      dataType: "json",
      cache: false,
      success: function (data) {
        if (data == 'error' || cod == '')
        $('div[id=showFlavorCod_' + pizza + ']').html('');

        var result = '<span onclick="selectFlavor(' + data[0].id + ',' + pizza + ')" class="clickHere">' + data[0].name + '</span>';
        $('div[id=showFlavorCod_' + pizza + ']').html(result);
      },
    });
  }

  if (cod.length <= 0) {
    $('div[id=showFlavorCod_' + pizza + ']').html('');
  }

}

function selectFlavor(cod, pizza) {

  if(checkSizePizza(pizza, cod) == true){

    var sizePizza = $('#cad_size_pizza_'+pizza+'').val();
    if(sizePizza == 0){
      alert('Necessário selecionar o tamanho da pizza!');
      $('input[type=number][id=flavorNumberPizza_'+pizza+'][flavorId='+cod+']').val('');
    }

    var flavorQtd = $("input[type=number][id='flavorNumberPizza_" + pizza + "'][flavorId=" + cod + "]").val();
    flavorQtd++;
    $("input[type=number][id='flavorNumberPizza_" + pizza + "'][flavorId=" + cod + "]").prop('value', flavorQtd);

    /////////////
    if(flavorQtd > 0){
      $('input[type=number][id=flavorNumberPizza_'+pizza+'][flavorId='+cod+']').addClass('flavorSelected');
    }

    var qtdTotal = 0, aux=0, total=0;
    $('input[type=number][id=flavorNumberPizza_'+pizza+']').each(function(){
      qtdTotal += $(this).val();
    })

    for(var i=0; i < qtdTotal.length; i++){
      total = parseInt(qtdTotal[i]) + aux;
      aux = total;
    }

    var maxSize = parseInt($('select[id=cad_size_pizza_'+pizza+'] option:selected').attr('parts'));
    totalPieces(total, maxSize, flavorQtd, pizza, cod);
    /////////////

    generateGraficPizza(pizza);
    valTotalPizza(pizza);
    selectedFlavorsPizza(pizza);
    $('input[id=inp_flavor_cod_' + pizza + ']').val('');
    $('div[id=showFlavorCod_' + pizza + ']').html('');
  }
}

function valTotalOption() {

  var totalOption = 0;
  var optionName = new Array();
  var optionQtd = new Array();
  var optionPrice = new Array();
  var divOptions = '';

  $('input[type=number][id=optionNumberPizza]').each(function(){
    if($(this).val() > 0){
      totalOption += $(this).val() * parseFloat($(this).attr('price'));

      optionName.push($(this).attr('optionName'));
      optionQtd.push($(this).val());
      optionPrice.push($(this).attr('price'));
    }
  })

  if(optionName.length > 0){
    divOptions += '<div class="panel panel-primary">'
    divOptions += '<div class="panel-heading">Opcionais</div>'
    divOptions += '<div class="panel-body">'

    divOptions += '<table class="table table-condensed">'
    divOptions += '<thead>'
    divOptions += '<tr>'
    divOptions += '<th>#</th>'
    divOptions += '<th>Nome</th>'
    divOptions += '<th>Preço</th>'
    divOptions += '<th>Quantidade</th>'
    divOptions += '<th>Total</th>'
    divOptions += '</tr>'
    divOptions += '</thead>'
    divOptions += '<tbody>'

    for(var i=0; i < optionName.length; i++){
      divOptions += '<tr>';
      divOptions += '<td>'+(i+1)+'</td>';
      divOptions += '<td>'+optionName[i]+'</td>';
      divOptions += '<td>R$ '+optionPrice[i]+'</td>';
      divOptions += '<td>'+optionQtd[i]+'</td>';
      divOptions += '<td>R$ '+(optionQtd[i] * optionPrice[i])+'</td>';
      divOptions += '</tr>';
    }
    divOptions += '<tr>';
    divOptions += '<td></td>';
    divOptions += '<td></td>';
    divOptions += '<td></td>';
    divOptions += '<td></td>';
    divOptions += '<td>R$ '+totalOption+'</td>';
    divOptions += '</tr>';

    divOptions += '</tbody>'
    divOptions += '</table>'
    divOptions += '</div>'
    divOptions += '</div>'
    divOptions += '</div>'
  }

  $('#generate_options').html(divOptions);

  return totalOption;
}

function valTotalPizza(id, option) {
  //// Total options
  var totalOption = valTotalOption();

  ////// Total de cada pizza
  var valFlavorsPrice = 0;
  var valEdgePizza = parseFloat($('select[id=cad_edge_' + id + '] option:selected').attr('price'));
  var valPricePizza = parseFloat($('select[id=cad_size_pizza_' + id + '] option:selected').attr('price'));

  //// additional the delivery form
  var additional = parseFloat($('#delivery_means option:selected').attr('price'));

  $("input[type=number][id='flavorNumberPizza_" + id + "']").each(function () {
    if($(this).val() > 0){
      valFlavorsPrice += ($(this).val() * parseFloat($(this).attr('price')));
    }
  });

  /////
  if (Number.isNaN(valEdgePizza))
  valEdgePizza = 0;
  if (Number.isNaN(valPricePizza))
  valPricePizza = 0;
  if (Number.isNaN(valFlavorsPrice))
  valFlavorsPrice = 0;
  /////

  var total = valEdgePizza + valPricePizza + valFlavorsPrice;
  $('#total_pizza_' + id + '').html('<b>TOTAL:</b> R$ <span id="span_total_pizza_' + id + '">' + total + '</span>');

  ///////////// Total geral Pizza
  var qtdPizzas = $("pizza").length;
  var total = 0;
  var totalGeneral = 0;
  var totalAll = parseFloat($('#span_total_all').text());

  /////////////////// refatorar no futuro
  if (option == 11) { ///delete pizza

    for(var i=1; i <= (qtdPizzas +1); i++){
      totalGeneral += parseFloat($('#span_total_pizza_' + i + '').text());
    }

    totalGeneral = totalGeneral - (parseFloat($('#span_total_pizza_' + id + '').text()));

  }else if (option == 0) { ///delete sabor pizza

    total = parseFloat($('#span_total_pizza_' + id + '').text());

    for(var i=1; i <= (qtdPizzas +1); i++){
      totalGeneral += parseFloat($('#span_total_pizza_' + i + '').text());
    }

  } else {
    for (var i = 1; i <= (qtdPizzas + 1); i++) {
      totalGeneral += parseFloat($('#span_total_pizza_' + i + '').text());
      if (Number.isNaN(total))
      totalGeneral = 0;
    }
  }
  //////////////////
  ///alert(totalGeneral+' - '+totalOption+' - '+additional)
  total = totalGeneral + additional + totalOption;
  $('#total_all').html('<b>TOTAL:</b> R$ <span id="span_total_all">' + total + '</span>');
  $('#order_total').attr('value', total);

}

function selectedFlavorsPizza(id) {

  var camposMarcados = new Array();
  var camposMarcadosId = new Array();
  $('#cad_flavors_' + id + '').html('');

  $("input[type=number][id='flavorNumberPizza_" + id + "']").each(function () {

    if($(this).val() > 0){

      for(var i=0; i< $(this).val(); i++){
        camposMarcados.push($(this).attr('flavor'));
        camposMarcadosId.push($(this).attr('flavorId'));
      }

    }

  });

  for (var i = 0; i < camposMarcados.length; i++) {
    $('#cad_flavors_' + id + '').append(
      '<div id="show_flavor_checked_' + id + camposMarcadosId[i] + '" class="col-md-12" style="border-bottom: 1px solid #bcd4ef">' + camposMarcados[i] + '<span onclick="uncheckedFlavor(' + id + ',' + camposMarcadosId[i] + ')" class="f_right cursorPointer glyphicon glyphicon-remove-sign" style="margin-top:2%"></span></div><br>'
    );
  }
}

function uncheckedFlavor(pizza, flavor) {
  //// new qtd
  var flavorQtd = $("input[type=number][id='flavorNumberPizza_" + pizza + "'][flavorId=" + flavor + "]").val();
  flavorQtd--
  $("input[type=number][id='flavorNumberPizza_" + pizza + "'][flavorId=" + flavor + "]").prop('value', flavorQtd);
  ////

  $("#show_flavor_checked_" + pizza + flavor + "").remove();

  generateGraficPizza(pizza);
  valTotalPizza(pizza, 0);
}

function selectedMaxParts(id) {
  var maxSize = parseInt($('select[id=cad_size_pizza_'+id+'] option:selected').attr('parts'));
  var result = "Escolha no máximo <span class='font-14 badgePersonAlert'>"+maxSize+"</span> Sabores!"
  $('#spanMaxPiecesPizza_'+id+'').html(result);
}

function orderIn(){
  $('#divOrderIn').show();
  $('#divOrderOut').hide();
  $('#divFineshed').hide();
  $('#typeOrder').attr('value','orderIn');
}

function orderOut(){
  $('#divOrderOut').show();
  $('#divOrderIn').hide();
  $('#divFineshed').show();
  $('#typeOrder').attr('value','orderOut');
}

$(document).ready(function () {

  ///$('#divOrderIn').hide();
  $('#divOrderOut').hide();
  $('#divFineshed').hide();

  var campos_max = 20;
  var optionEdge;
  var optionSize;
  var x = 2;
  var selectEdgeText = new Array();
  var selectEdgeVal = new Array();
  var selectEdgePrice = new Array();
  var selectSizeText = new Array();
  var selectSizeVal = new Array();
  var selectSizePrice = new Array();
  var selectSizeParts = new Array();
  var flavorsImg = new Array();
  var imgPiece;
  var tbody;

  var flavorsName = new Array();
  var flavorsPrice = new Array();
  var flavorsDescription = new Array();
  var flavorsId = new Array();

  /// flavors
  $("input[type=number][id='flavorNumberPizza_1']").each(function () {
    flavorsName.push($(this).attr('flavor'));
    flavorsPrice.push($(this).attr('price'));
    flavorsDescription.push($(this).attr('description'));
    flavorsId.push($(this).attr('flavorId'));
  });
  $("img[id='imgFlavor']").each(function () {
    flavorsImg.push($(this).attr('src'));
  });

  /// edge
  $('select[id=cad_edge_1] option').each(function () {
    selectEdgeText.push($(this).text());
    selectEdgeVal.push($(this).val());
    selectEdgePrice.push($(this).attr('price'));
  });
  /// size
  $('select[id=cad_size_pizza_1] option').each(function () {
    selectSizeText.push($(this).text());
    selectSizeVal.push($(this).val());
    selectSizeParts.push($(this).attr('parts'));
    selectSizePrice.push($(this).attr('price'));
  });

  $('.add_new_pizza').click(function (e) {
    e.preventDefault();     //prevenir novos clicks
    if (x < campos_max) {
      /// edge
      optionEdge = '';
      for (var i = 0; i < selectEdgeVal.length; i++) {
        optionEdge += "<option value='" + selectEdgeVal[i] + "' price='" + selectEdgePrice[i] + "'>" + selectEdgeText[i] + "</option>";
      }
      /// size
      optionSize = '';
      for (var i = 0; i < selectSizeVal.length; i++) {
        optionSize += "<option value='" + selectSizeVal[i] + "' price='" + selectSizePrice[i] + "' parts='"+ selectSizeParts[i] +"'>" + selectSizeText[i] + "</option>";
      }
      /// flavors
      tbody = '';
      for (var i = 0; i < flavorsId.length; i++) {
        tbody += "\
        <tr style='cursor: pointer'>\
        <td>" + flavorsId[i] + "</td>\
        <td>\
        <input onchange='checkPizza("+i+","+x+")'  name='pizza[" + x + "][flavor]["+ flavorsId[i] +"]' type='number' min='0' max='20' id='flavorNumberPizza_" + x + "' flavorId='" + flavorsId[i] + "' flavor='" + flavorsName[i] + "' price='" + flavorsPrice[i] + "' class='form-control' style='width:60px'>\
        </td>\
        <td>\
        <img class='img-rounded img-responsive' src='" + flavorsImg[i] + "' width='80'>\
        </td>\
        <td>" + flavorsName[i] + "</td>\
        <td>" + flavorsDescription[i] + "</td>\
        <td>R$ " + flavorsPrice[i] + "</td>\
        </tr>\
        ";
      }

      $('#generate_pizzas').append('<pizza>\
      <div class="panel panel-primary">\
      <div class="panel-heading">\
      <h3 class="panel-title">Pizza ' + x + '</h3>\
      </div>\
      <div class="panel-body">\
      <div class="col-md-12 column ui-sortable font-25">\
      <div class="col-md-4">\
      <div id="divCadEdge_'+x+'" class="form-group">\
      <label class="control-label">Borda</label>\
      <select name="pizza[' + x + '][edge]" onchange="valTotalPizza(' + x + ')" class="form-control input-lg" id="cad_edge_' + x + '" style="font-size: 22px">\
      ' + optionEdge + '\
      </select>\
      </div>\
      <div id="divCadSize_'+x+'" class="form-group">\
      <label class="control-label">Tamanho</label>\
      <select name="pizza[' + x + '][size]" onchange="selectedMaxParts(' + x + '), valTotalPizza(' + x + ')" class="form-control input-lg" id="cad_size_pizza_' + x + '" style="font-size: 22px">\
      ' + optionSize + '\
      </select>\
      </div>\
      <div>\
      <label>Observação:</label>\
      <textarea name="pizza[' + x + '][observation]" class="form-control" rows="5" style="font-size: 18px"></textarea>\
      </div>\
      </div>\
      <div class="col-md-5" style="">\
      <div onclick="maxPiecesPizza()" href="#modal_cad_flavors_pizza_' + x + '" data-toggle="modal" id="piechart_' + x + '" style="height: 500px; width: 500px; cursor: pointer"></div>\
      </div>\
      <div class="col-md-3" style="">\
      <div class="col-md-12">\
      <div id="divCadFlavor_'+ x +'" class="input-group">\
      <label class="control-label" for="inp_flavor_cod_'+ x +'" style="font-size:14px; float:left; margin-right:5px; margin-top:5px">Insira o Código: </label>\
      <input title="Insira o código e após click no nome" onkeyup="showFlavorCod('+ x +')" id="inp_flavor_cod_'+ x +'" type="text" class="form-control" style="width: 90px" placeholder="código">\
      </div>\
      </div>\
      <div style="height: 40px" class="col-md-12">\
      <div id="showFlavorCod_' + x + '"></div>\
      </div>\
      <div class="col-md-12" style="margin-bottom: 15%">\
      <label>Sabores:</label>\
      <div id="cad_flavors_' + x + '"></div>\
      </div>\
      <div class="col-md-12">\
      <div id="total_pizza_' + x + '" style="background-color: #dce7f7; border-radius: 3px"></div>\
      </div>\
      </div>\
      </div>\
      </div>\
      </div>\
      \
      \
      \
      <div class="view">\
      <div class="modal fade" id="modal_cad_flavors_pizza_' + x + '">\
      <div class="" style="width: 90%; margin-left: auto; margin-right: auto; margin-top: 3%">\
      <div class="modal-content">\
      <div class="modal-body">\
      <div class="form-group" style="margin-top: 1%">\
      <div class="title f_left">\
      <h4><span id="spanMaxPiecesPizza_'+x+'"><b>Atenção:</b> Necessário escolher o tamanho da pizza!</span></h4>\
      </div>\
      <div class="f_right">\
      <button onclick="selectedFlavorsPizza('+x+'), generateGraficPizza('+x+'), valTotalPizza('+x+')" type="button" data-dismiss="modal" class="btn btn-success">Confirma Sabores</button>\
      <button data-dismiss="modal"  class="btn btn-default">Voltar</button>\
      </div>\
      <br><br><br>\
      <table class="table table-hover table-condensed">\
      <thead>\
      <tr>\
      <th>ID</th>\
      <th></th>\
      <th>Imagen</th>\
      <th>Nome</th>\
      <th>Descrição</th>\
      <th>Preço</th>\
      </tr>\
      </thead>\
      <tbody>\
      ' + tbody + '\
      </tbody>\
      </table>\
      </div>\
      </div>\
      <div class="modal-footer">\
      <button type="button" class="btn btn-default" data-dismiss="modal">Voltar</button>\
      <button onclick="selectedFlavorsPizza(' + x + '), generateGraficPizza(' + x + '), valTotalPizza(' + x + ')" type="button" data-dismiss="modal" class="btn btn-primary">Salvar Escolhas</button>\
      </div>\
      </div>\
      </div>\
      </div>\
      </div>\
      \
      </div>\
      <button onclick="valTotalPizza(' + x + ',11)" type="button" class="btn btn-danger remover_pizza"><i class="marg_right_5 glyphicon glyphicon-minus"></i>Remover Pizza</button>\
      </pizza>\
      ');
      generateGraficPizzaDefault(x);

      x++;
    }
  });

  // Remover o div anterior
  $('#generate_pizzas').on("click", ".remover_pizza", function (e) {
    e.preventDefault();
    $(this).parent('pizza').remove();
    x--;
  });

});
