
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

function searchClient() {

    var data = $('#inpSearchClient').val();

    if (data.length > 0) {
        $.ajax({
            url: url + '/client/search/' + data + '',
            dataType: "json",
            cache: false,
            success: function (data) {
                var ul = '<ul style="list-style-type: none; margin-left: -8%">';
                for (var i = 0; i < data.length; i++) {
                    ul += "<li onclick='fillFields(\"" + data[i].name + "\", \"" + data[i].cep + "\", \"" + data[i].neighborhood + "\", \"" + data[i].address + "\", \"" + data[i].number + "\", \"" + data[i].complement + "\", \"" + data[i].cell_phone + "\", \"" + data[i].phone + "\")' class='searchName'>" + data[i].name + " - " + data[i].cell_phone + " - " + data[i].phone + "</li>";
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
    ///alert('test: '+state);
    $('#cadName').attr('value', name);
    $('#cadCEP').attr('value', cep);
    $('#cadNeighborhood').attr('value', neighborhood);
    $('#cadAddress').attr('value', address);
    $('#cadNumber').attr('value', number);
    $('#cadComplement').attr('value', complement);
    $('#cadTelCellPhone').attr('value', cell_phone);
    $('#cadTelPhone').attr('value', phone);

    $('input[id=inpSearchClient]').val('');
    $('div[id=divSearchClient]').html('');
}

function maxPiecesPizza() {
    var maxPieces = $('#maxPiecesPizza').val();
    $('#spanMaxPiecesPizza').html(maxPieces);
}

function returnMaxPiecesPizza() {
    var maxPieces = parseInt($('#maxPiecesPizza').val());
    return maxPieces;
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

                var result = '<span onclick="selectFlavor(' + data[0].id + ',' + pizza + ')" class="cursorPointer">' + data[0].name + '</span>';
                $('div[id=showFlavorCod_' + pizza + ']').html(result);
            },
        });
    }

    if (cod.length <= 0) {
        $('div[id=showFlavorCod_' + pizza + ']').html('');
    }

}

function selectFlavor(cod, pizza) {
    $("input[type=checkbox][id='flavorCheckPizza_" + pizza + "'][value=" + cod + "]").prop('checked', true);
    generateGraficPizza(pizza);
    valTotalPizza(pizza);
    selectedFlavorsPizza(pizza);
    $('input[id=inp_flavor_cod_' + pizza + ']').val('');
    $('div[id=showFlavorCod_' + pizza + ']').html('');
}

function valTotalOption(id, option, totalAll) {
    var qtdOption = $("pizza_option").length + 1;
    var total_option = 0;

    for (var i = 1; i <= qtdOption; i++) {
        total_option += parseFloat($('select[id=option_id_' + i + '] option:selected').attr('price'));
    }

    /// deletando
    if (option == 01) {
        var subtrair = parseFloat($('select[id=option_id_' + id + '] option:selected').attr('price'));
        total_option = totalAll - subtrair;
    }

    if (Number.isNaN(total_option))
        total_option = 0;

    return total_option;

}

function valTotalPizza(id, option) {
    //// Total option
    var total_option = valTotalOption();

    ////// Total de cada pizza
    var valFlavorsPrice = 0;
    var valEdgePizza = parseFloat($('select[id=cad_edge_' + id + '] option:selected').attr('price'));
    var valPricePizza = parseFloat($('select[id=cad_size_pizza_' + id + '] option:selected').attr('price'));

    //// additional the delivery form
    var additional = parseFloat($('#delivery_means option:selected').attr('price'));

    $("input[type=checkbox][id='flavorCheckPizza_" + id + "']:checked").each(function () {
        valFlavorsPrice += parseFloat(($(this).attr('price')));
    });
    var total = valEdgePizza + valPricePizza + valFlavorsPrice;

    $('#total_pizza_' + id + '').html('<b>TOTAL:</b> R$ <span id="span_total_pizza_' + id + '">' + total + '</span>');

    ///////////// Total geral Pizza
    var qtdPizzas = $("pizza").length;
    var subtrair = 0;
    var total = 0;
    var totalAll = parseFloat($('#span_total_all').text());

    ///delete pizza
    if (option == 0) {

        subtrair = parseFloat($('#span_total_pizza_' + id + '').text());
        total = totalAll - subtrair;

    } else if (option == 01) { /// deletando option

        total_option = valTotalOption(id, 01, totalAll);

    } else {
        for (var i = 1; i <= (qtdPizzas + 1); i++) {
            total += parseFloat($('#span_total_pizza_' + i + '').text());
            if (Number.isNaN(total))
                total = 0;
        }

    }

    total = total + total_option + additional;
    $('#total_all').html('<b>TOTAL:</b> R$ <span id="span_total_all">' + total + '</span>');
    $('#order_total').attr('value', total);

}

function selectedFlavorsPizza(id) {

    var camposMarcados = new Array();
    var camposMarcadosId = new Array();
    $('#cad_flavors_' + id + '').html('');

    $("input[type=checkbox][id='flavorCheckPizza_" + id + "']:checked").each(function () {
        camposMarcados.push($(this).attr('flavor'));
        camposMarcadosId.push($(this).attr('value'));
    });

    for (var i = 0; i < camposMarcados.length; i++) {
        $('#cad_flavors_' + id + '').append(
                '<div id="show_flavor_checked_' + id + camposMarcadosId[i] + '" class="col-md-12" style="border-bottom: 1px solid #bcd4ef">' + camposMarcados[i] + '<span onclick="uncheckedFlavor(' + id + ',' + camposMarcadosId[i] + ')" class="f_right cursorPointer glyphicon glyphicon-remove-sign" style="margin-top:2%"></span></div><br>'
                );
    }
}

function uncheckedFlavor(pizza, flavor) {
    ///alert(pizza+' - '+flavor)
    $("input[type=checkbox][id='flavorCheckPizza_" + pizza + "'][value=" + flavor + "]").prop('checked', false);
    $("#show_flavor_checked_" + pizza + flavor + "").remove();

    generateGraficPizza(pizza);
    valTotalPizza(pizza, 0);
}

function selectedMaxParts(id) {
    var maxSize = parseInt($('select[id=cad_size_pizza_1] option:selected').attr('parts'));
    $('#maxPiecesPizza').attr('value', maxSize);
}

$(document).ready(function () {
    var campos_max = 20;
    var optionEdge;
    var optionSize;
    var x = 2;
    var y = 2;
    var selectEdgeText = new Array();
    var selectEdgeVal = new Array();
    var selectEdgePrice = new Array();
    var selectSizeText = new Array();
    var selectSizeVal = new Array();
    var selectSizePrice = new Array();
    var flavorsImg = new Array();
    var imgPiece;
    var tbody;

    var flavorsName = new Array();
    var flavorsPrice = new Array();
    var flavorsDescription = new Array();
    var flavorsId = new Array();

    /// flavors
    $("input[type=checkbox][id='flavorCheckPizza_1']").each(function () {
        flavorsName.push($(this).attr('flavor'));
        flavorsPrice.push($(this).attr('price'));
        flavorsDescription.push($(this).attr('description'));
        flavorsId.push($(this).attr('value'));
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
                optionSize += "<option value='" + selectSizeVal[i] + "' price='" + selectSizePrice[i] + "'>" + selectSizeText[i] + "</option>";
            }
            /// flavors
            tbody = '';
            for (var i = 0; i < flavorsId.length; i++) {
                tbody += "\
                            <tr style='cursor: pointer'>\
                                <td>" + flavorsId[i] + "</td>\
                                <td>\
                                    <input name='pizza[" + x + "][flavor][" + i + "]' type='checkbox' name='flavors_id[" + i + "]' id='flavorCheckPizza_" + x + "' flavor='" + flavorsName[i] + "' price='" + flavorsPrice[i] + "' value='" + flavorsId[i] + "' class='checkbox' style='cursor: pointer'>\
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
    <div class="panel panel-default">\
        <div class="panel-heading">\
            <h3 class="panel-title" contenteditable="true">Pizza ' + x + '</h3>\
        </div>\
        <div class="panel-body" contenteditable="true">\
            <div class="col-md-12 column ui-sortable font-25">\
                <div class="col-md-4">\
                    <div class="form-group">\
                        <label>Borda</label>\
                        <select name="pizza[' + x + '][edge]" onchange="valTotalPizza(' + x + ')" class="form-control input-lg" id="cad_edge_' + x + '" style="font-size: 22px">\
                            ' + optionEdge + '\
                        </select>\
                    </div>\
                    <div class="form-group">\
                        <label>Tamanho</label>\
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
                    <input type="hidden" id="maxPiecesPizza">\
                    <div class="col-md-12">\
                        <div class="input-group col-xs-6">\
                            <input onkeyup="showFlavorCod(' + x + ')" id="inp_flavor_cod_' + x + '" type="text" class="form-control" style="width: 100px" placeholder="código">\
                            <span class="input-group-btn">\
                                <button style="margin-left: -3%; margin-top: -1%" class="btn btn-primary" type="button"><i class="glyphicon glyphicon-plus"></i></button>\
                            </span>\
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
                <div class="modal-header">\
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>\
                    <h4 class="modal-title" id="myModalLabel" contenteditable="true">Escolher no maxímo <span id="spanMaxPiecesPizza" style="margin-left: 5px" class="badge">2</span> Sabores</h4>\
                </div>\
                <div class="modal-body" contenteditable="true">\
                    <div class="form-group" style="margin-top: 1%">\
                        <div class="title" style="float: left; margin-top: -3%; margin-right: 5%; margin-left: 36%">\
                            <h3 style="margin-left: 0%;">Selecione os Sabores Desejados.</h3>\
                        </div>\
                        <div>\
                            <button onclick="selectedFlavorsPizza(' + x + '), generateGraficPizza(' + x + '), valTotalPizza(' + x + ')" type="button" data-dismiss="modal" class="btn btn-success" style="margin-top: -1.5%; float: right; margin-right: 5%">Confirma Sabores</button>\
                        </div>\
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
                    <button type="button" class="btn btn-default" data-dismiss="modal" contenteditable="true">Voltar</button>\
                    <button onclick="selectedFlavorsPizza(' + x + '), generateGraficPizza(' + x + '), valTotalPizza(' + x + ')" type="button" data-dismiss="modal" class="btn btn-primary" contenteditable="true">Salvar Escolhas</button>\
                </div>\
            </div>\
        </div>\
    </div>\
</div>\
\
</div>\
    <button onclick="valTotalPizza(' + x + ',0)" type="button" class="btn btn-danger remover_pizza"><i class="marg_right_5 glyphicon glyphicon-minus"></i>Remover Pizza</button>\
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

    /*           ###########            */

    var optionOption = '';
    var selectOptionText = new Array();
    var selectOptionVal = new Array();
    var selectOptionPrice = new Array();

    $('select[id=option_id_1] option').each(function () {
        selectOptionText.push($(this).text());
        selectOptionVal.push($(this).val());
        selectOptionPrice.push($(this).attr('price'));
    });

    $('#btt_add_new_option').click(function (e) {

        e.preventDefault();     //prevenir novos clicks
        if (y < campos_max) {

            optionOption = '';
            for (var i = 0; i <= selectEdgeVal.length; i++) {
                optionOption += "<option value='" + selectOptionVal[i] + "' price='" + selectOptionPrice[i] + "'>" + selectOptionText[i] + "</option>";
            }

            $('#generate_options').append('<pizza_option style="float:left; margin-top:1%; margin-left:5px">\
    <div class="panel panel-default" style="width: 300px">\
        <div class="panel-heading">\
            <h3 class="panel-title">Opção ' + y + '</h3>\
        </div>\
        <div class="panel-body">\
                <div class="">\
                    <div class="form-group">\
                        <select onchange="valTotalPizza(' + y + ')" name="option[' + y + ']" id="option_id_' + y + '" class="form-control">\
                            ' + optionOption + '\
                        </select>\
                    </div>\
                </div>\
        </div>\
    </div>\
    <button onclick="valTotalPizza(' + x + ',01)" type="button" class="btn btn-danger remover_option"><i class="marg_right_5 glyphicon glyphicon-minus"></i>Remover Option</button>\
    </pizza_option>')

            y++;

        }

    })

    // Remover o div anterior
    $('#generate_options').on("click", ".remover_option", function (e) {
        e.preventDefault();
        $(this).parent('pizza_option').remove();
        x--;
    });


});
