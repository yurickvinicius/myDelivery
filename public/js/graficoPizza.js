function generateGraficPizza(id) {

    var flavorsName = new Array();

    $("input[type=number][id='flavorNumberPizza_" + id + "']").each(function () {

        if($(this).val() > 0){
            for(var i=0; i < $(this).val(); i++){
                flavorsName.push($(this).attr('flavor'));
            }
        }

        ///flavorsName.push($(this).attr('flavor'));
    });

    ///var maxPieces = returnMaxPiecesPizza();
    var pizza = [["Pizza", "Sabores Selecionados"]];
    var colors = [];
    ///var divPizza = 100/maxPieces;

    for (var i = 0; i < flavorsName.length; i++) {
        pizza.push([flavorsName[i], 1]);
        colors.push('#F0D08D');
    }

    var data = google.visualization.arrayToDataTable(pizza);

    var options = {
        chartArea: '',
        legend: 'none',
        colors: colors,
        pieSliceText: 'label',
        tooltip: {trigger: 'none'},
        pieSliceTextStyle: {fontSize: 25},
        chartArea: {left: '5%', height: '100%', width: '90%'},
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart_' + id + ''));

    chart.draw(data, options);
}

$(document).ready(function () {

    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        generateGraficPizzaDefault();
    }

})

function generateGraficPizzaDefault(id) {
    if (typeof id == "undefined") {
        id = 1;
    }

    var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        ['Clique aqui ou adicione o código!', 100]
    ]);

    var options = {
        chartArea: '',
        legend: 'none',
        colors: ['#B3B8DA', '#B3B8DA'],
        pieSliceText: 'label',
        pieSliceTextStyle: {fontSize: 25},
        tooltip: {trigger: 'none'},
        chartArea: {left: '5%', height: '100%', width: '90%'},
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart_' + id + ''));

    chart.draw(data, options);
}
