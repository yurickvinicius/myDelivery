$(document).ready(function () {
    $('#order_size').hide();
    $('#order_amounts_parts').hide();
    $('#order_flavors').hide();
    $('#order_options').hide();
    $('#order_checked').hide();
    $('#order_finishing').hide();
    $('#div_exchange_money').hide();
})

function confirmedEdge() {
    $('#order_edge').hide();
    $('#order_size').show();

    $('#chose_edge').removeClass('active');
    $('#chose_size').addClass('active');

}

function confirmedSize() {
    $('#order_size').hide();
    $('#order_amounts_parts').show();

    $('#chose_size').removeClass('active');
    $('#chouse_amount_parts').addClass('active')

}

function confirmedAmountParts() {
    $('#order_amounts_parts').hide();
    $('#order_flavors').show();

    $('#chouse_amount_parts').removeClass('active');
    $('#chouse_flavors').addClass('active');
}

function confirmedFlavors() {
    $('#order_flavors').hide();
    $('#order_options').show();

    $('#chouse_flavors').removeClass('active');
    $('#chouse_options').addClass('active');
}

function confirmedChecked() {
    $('#order_options').hide();
    $('#order_checked').show();

    $('#chouse_options').removeClass('active');
    $('#chouse_checked').addClass('active');
}

function confirmeDatas() {
    $('#order_checked').hide();
    $('#order_finishing').show();

    $('#chouse_checked').removeClass('active');
    $('#chouse_payment').addClass('active');
}

function generateAmoutParts() {    
    var maxSize = parseInt($('select[name=size_pizza_id] option:selected').attr('parts'));
    generateSelectParts(maxSize);
}

/// gerar selects para dividir a pizza em partes
function generateSelectParts(maxSize) {
    for (var i = 1; i <= maxSize; i++) {
        $('select[name=parts]').append("<option>" + i + "</option>");
    }
}

/// gerar div para checar pedido e confirmar
function confirmCheck() {

    var edgePizzaInf = $('select[id=edge_pizza_id] option:selected').text();
    var sizePizzaInf = $('select[id=size_pizza_id] option:selected').text();
    var divided = $('select[id=select_parts]').val();
    var flavorsName = flavorsCheckedName();
    var drinkInf = $('select[id=drink_id] option:selected').text();
    var deliveryMean = $('select[id=delivery_mean_id] option:selected').text();

    $('div[id=confirmedCheck]').html(
            edgePizzaInf + '<br>' +
            sizePizzaInf + '<br>' +
            'Em até: ' + divided + ' partes<br>' +
            'Sabores: ' + flavorsName + '<br>' +
            drinkInf + '<br>' +
            deliveryMean + '<br>' +
            'Total: ' + totalOrder() +
            '<input type="hidden" name="total" value="' + totalOrder() + '">'
            );

}
///selecion todos sabores checados
function flavorsCheckedVal() {
    var flavors = new Array();
    $("input[type=checkbox][id='flavor_id']:checked").each(function () {
        flavors.push($(this).val());
        ///flavors.push($(this).attr('flavor'));
    });

    return flavors;
}

function flavorsCheckedName() {
    var flavors = new Array();
    $("input[type=checkbox][id='flavor_id']:checked").each(function () {
        flavors.push($(this).attr('flavor'));
    });

    return flavors;
}

function totalOrder() {
    var priceSizePizza = parseFloat($('select[id=size_pizza_id] option:selected').attr('price'));
    var priceDrink = parseFloat($('select[id=drink_id] option:selected').attr('price'));
    var priceDeliveryMean = parseFloat($('select[id=delivery_mean_id] option:selected').attr('price'));
    var priceFlavors, auxPriceFlavors = 0;

    $("input[type=checkbox][id='flavor_id']:checked").each(function () {
        priceFlavors = parseFloat($(this).attr('price')) + auxPriceFlavors;
        auxPriceFlavors = priceFlavors;
    });

    var total = priceSizePizza + priceFlavors + priceDrink + priceDeliveryMean;

    return total;

}

function paymentForm() {
    var paymentForm = $('select[id=payment_form]').val();

    if (paymentForm == 'Dinheiro') {
        $('#div_exchange_money').show();
        $('#complement_payment').html('');
    } else if (paymentForm == 'PagSeguro') {
        $('#div_exchange_money').hide();
        $('#complement_payment_2').html('');
        $('div[id=complement_payment]').html('Confirma para ser redirecionado para o PagSeguro.');
                
    }else{
        $('#div_exchange_money').hide();
        $('#complement_payment_2').html('');
        $('div[id=complement_payment]').html('Selecione uma forma de pagamento.');
    }
}

function exchangeMoneyYes() {
    $('div[id=complement_payment_2]').html(
        '<label>Troco para quanto:</label>' +
        '<input name="exchange_money" type="text" class="form-control" placeholder="Troco para R$">'
    );
}

function exchangeMoneyNo() {
    $('div[id=complement_payment_2]').html('');
}