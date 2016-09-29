@extends('app')
@section('content')

{!! Form::open(['route'=>'order.store']) !!}

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-12">
                <div class="form-group col-xs-3">
                    <label for="cadName">Nome</label>
                    <input type="text" class="form-control" id="cadName" placeholder="Nome">
                </div>

                <div class="form-group col-xs-4">
                    <div class="input-group"> 
                        <label>Buscar</label>
                        <input onkeyup="searchClient()" id="inpSearchClient" class="form-control" placeholder="Nome ou Telefone">

                        <div id="divSearchClient" style='position:absolute; z-index: 9999; top:105%; background-color: #dce7f7'></div>


                        <div class="input-group-btn"> 
                            <div style="margin-top: 53%; padding-top: 15%" type="button" class="btn btn-primary"><i class="glyphicon glyphicon-search marg_right_5"></i></div>
                        </div> 
                    </div>
                </div>
            </div>

            <div class="col-md-12">

                <div class="form-group col-xs-3">
                    <div class="input-group"> 
                        <label for="cadCEP">CEP</label>
                        <input id="cadCEP" class="form-control" placeholder="CEP"> 
                        <div class="input-group-btn"> 
                            <button onclick="searchCEP()" style="margin-top: 24%; padding-top: 7%" type="button" class="btn btn-primary"><i class="glyphicon glyphicon-search marg_right_5"></i>Procurar</button>
                        </div> 
                    </div>
                </div>

                <div class="form-group col-xs-2">
                    <label for="cadState">UF</label>
                    <select id="cadState" class="form-control">
                        <option>Selecione</option>
                        <option selected="true">PR</option>
                        <option>SC</option>
                    </select>
                </div>
                <div class="form-group col-xs-2">
                    <label for="cadCity">Cidade</label>
                    <input id="cadCity" value="Guarapuava" type="text" class="form-control" placeholder="Cidade">
                </div>
                <div class="form-group col-xs-2">
                    <label for="cadNeighborhood">Bairro</label>
                    <input type="text" class="form-control" id="cadNeighborhood" placeholder="Bairro">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group col-xs-5">
                    <label for="cadAddress">Endereço</label>
                    <input type="text" class="form-control" id="cadAddress" placeholder="Endereço">
                </div>
                <div class="form-group col-xs-1">
                    <label for="cadNumber">Numero</label>
                    <input type="text" class="form-control" id="cadNumber" placeholder="Numero">
                </div>
                <div class="form-group col-xs-5">
                    <label for="cadComplement">Complemento</label>
                    <input type="text" class="form-control" id="cadComplement" placeholder="Complemento">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group col-xs-2">
                    <label for="cadTelCellPhone">Tel. Celular</label>
                    <input type="text" class="form-control" id="cadTelCellPhone" placeholder="Celular">
                </div>
                <div class="form-group col-xs-2">
                    <label for="cadTelPhone">Tel. Residencial</label>
                    <input type="text" class="form-control" id="cadTelPhone" placeholder="Telefone">
                </div>
            </div>

        </div>
    </div>
</div>

<!--------------------------------->

<input name="total" type="hidden" value="total" id="order_total">
<div class="col-md-12" style="margin-bottom: 10%">
    <div id="total_all" class="font-25 canto"><b>TOTAL:</b> </div>    

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
                    <!---
                    <div class="input-group" style="height: 80px">
                        <input onkeyup="showFlavorCod()" id="inp_flavor_cod" type="text" class="form-control" style="width: 100px" placeholder="código">
                        <div id="showFlavorCod"></div>                        
                    </div>
                    --->
                    <div class="col-md-12"> 
                        <div class="input-group col-xs-6"> 
                            <input onkeyup="showFlavorCod()" id="inp_flavor_cod" type="text" class="form-control" style="width: 100px" placeholder="código"> 
                            <span class="input-group-btn"> 
                                <button style="margin-left: -3%; margin-top: -1%" class="btn btn-primary" type="button"><i class="glyphicon glyphicon-plus"></i></button> 
                            </span> 
                        </div> 
                    </div>

                    <div style="height: 40px" class="col-md-12">
                        <div id="showFlavorCod"></div> 
                    </div>

                    <div class="col-md-12" style="margin-bottom: 15%">
                        <label>Sabores:</label>
                        <div id="cad_flavors_1"></div>                        
                    </div>
                    
                    <div class="col-md-12">
                        <div id="total_pizza_1" style="background-color: #dce7f7; border-radius: 3px"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <button style="margin-top: -1%; margin-bottom: 0.5%" type="button" class="btn btn-primary add_new_pizza"><i class="glyphicon glyphicon-plus marg_right_5"></i>Adicionar Nova Pizza</button>
    <div id="generate_pizzas"></div>

    <!--------------    -------------->

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

    <button type="button" id="btt_add_new_option" class="btn btn-default">Adicionar Nova Opção</button>
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