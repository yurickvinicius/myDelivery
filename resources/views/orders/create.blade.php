@extends('app')
@section('content')

{!! Form::open(['route'=>'order.store']) !!}
<input name="total" type="hidden" value="total" id="order_total">
<div class="col-md-12" style="margin-bottom: 10%">
    <div id="total_all" class="font-25 canto"><b>TOTAL:</b> </div>

    <button type="button" class="btn btn-default add_new_pizza"><i class="glyphicon glyphicon-plus marg_right_5"></i>Adicionar Nova Pizza</button>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Pizza 1</h3>
        </div>
        <div class="panel-body">      

            <div class="col-md-12 column ui-sortable font-25">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cad_edge_1">Borda</label>
                        <select name="pizza[1][edge]" onchange="valTotalPizza(1)" class="form-control input-lg" id="cad_edge_1" style="font-size: 22px">
                            <option value="0">Selecione</option>
                            @foreach($edges as $edge)
                            <option value="{{ $edge->id }}" price='{{ $edge->price }}'>{{ $edge->name }}</option>                
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tamanho</label>
                        <select name="pizza[1][size]" onchange="selectedMaxParts(), valTotalPizza(1)" class="form-control input-lg" id="cad_size_pizza_1" style="font-size: 22px">
                            <option value="0">Selecione</option>
                            @foreach($sizePizzas as $sizePizza)
                            <option value="{{ $sizePizza->id }}" price="{{ $sizePizza->price }}" parts="{{ $sizePizza->parts }}">{{ $sizePizza->size }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label>Observação:</label>
                        <textarea name="pizza[1][observation]" class="form-control" rows="5" style="font-size: 18px"></textarea>
                    </div>

                </div>

                <div class="col-md-5" style="">
                    <div onclick="maxPiecesPizza()" href="#modal_cad_flavors_pizza_1" data-toggle="modal" id="piechart_1" style="height: 500px; width: 500px; cursor: pointer"></div>
                </div>

                <div class="col-md-3" style="">  
                    <input type="hidden" id="maxPiecesPizza">                            

                    <div class="input-group" style="height: 80px">
                        <input onkeyup="showFlavorCod()" id="inp_flavor_cod" type="text" class="form-control" style="width: 100px" placeholder="código">
                        <button type="button" class="btn" style="margin-top: -2%"><i class="glyphicon glyphicon-search marg_right_5"></i>Seleciona</button>                        
                        <div id="showFlavorCod"></div>                        
                    </div>                                        

                    <div>
                        <label>Sabores:</label>
                        <div id="cad_flavors_1"></div>
                        <div style="margin-right: 1%; margin-top: 30%; width: 100%; background-color: #dce7f7; border-radius: 3px" class="f_right" id="total_pizza_1"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div id="generate_pizzas"></div>

    <!--------------    -------------->

    <div style="margin-bottom: 1%">
        <button type="button" id="btt_add_new_option" class="btn btn-default">Adicionar Nova Opção</button>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Opção 1</h3>
        </div>
        <div class="panel-body">      

            <div class="col-md-12 column ui-sortable">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Opção</label>
                        <select onchange="valTotalPizza(1)" name="option[1]" id="option_id_1" class="form-control">
                            <option value="0" price="0">Selecione</option>
                            @foreach($drinks as $drink)
                            <option value="{{ $drink->id }}" price='{{ $drink->price }}'>{{ $drink->name }} - R$ {{$drink->price}}</option>                
                            @endforeach
                        </select>
                    </div>                    
                </div>                

            </div>
        </div>
    </div>

    <div id="generate_options"></div>

    <!------------   ------------>

    <div>
        meio de pagamento, meio de entrega
        <button class="btn btn-primary btn-lg" type="submit">Cadastrar</button>
    </div>    

</div>

@include('orders.partials.modal_flavors_pizza')

{!! Form::close() !!}

@endsection