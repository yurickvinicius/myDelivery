@extends('pizzeria.pizzeria')
@section('content')

<div class="row">

    {!! Form::open(['route'=>'pizza.store']) !!}    
    
    <div class="col-md-12 column ui-sortable" style="margin: 1%">

        <ul class="nav nav-pills" contenteditable="true">
            <li id="chose_edge" class="active">
                <a href="#">                    
                    Borda <i class="glyphicon glyphicon-menu-right"></i>
                </a>
            </li>
            <li id="chose_size">
                <a href="#">
                    Tamanho <i class="glyphicon glyphicon-menu-right"></i>
                </a>
            </li>
            <li id="chouse_amount_parts">
                <a href="#">
                    Quantidade de partes <i class="glyphicon glyphicon-menu-right"></i>
                </a>
            </li>
            <li id="chouse_flavors">
                <a href="#">
                    Sabores <i class="glyphicon glyphicon-menu-right"></i>
                </a>
            </li>
            <li id='chouse_options'>
                <a href="#">
                    Opcionais <i class="glyphicon glyphicon-menu-right"></i>
                </a>
            </li>
            <li id="chouse_checked">
                <a href="#">
                    Confirmando <i class="glyphicon glyphicon-menu-right"></i>
                </a>
            </li>
            <li id="chouse_payment">
                <a href="#">
                    Finalizando <i class="glyphicon glyphicon-menu-right"></i>
                </a>
            </li>
        </ul>

        <div class="form-group" style="margin-top: 3%; margin-bottom: 3%">

            <div id="order_edge" style="width: 50%; margin-left: auto; margin-right: auto">

                <div class="form-group">
                    {!! Form::label('edge_pizza_id','Selecione a Borda:') !!}
                    {!! Form::select('edge_pizza_id', $edgePizzas, null, ['class'=>'form-control']) !!}
                </div>

                <button type="button" onclick="confirmedEdge()" class="btn btn-success">Confirma Borda</button>
            </div>

            <!--------------->

            <div id="order_size" style="width: 50%; margin-left: auto; margin-right: auto">                

                <div class="form-group">

                    {!! Form::label('size_pizza','Selecione o Tamanho:') !!}                    
                    <select name="size_pizza_id" id="size_pizza_id" class="form-control">
                        <option value="0" price="0" parts="0">Selecione</option>
                        @foreach($sizePizzas as $sizePizza)                            
                        <option value="{{ $sizePizza->id }}" price="{{ $sizePizza->price }}" parts="{{ $sizePizza->parts }}">Pizza {{ $sizePizza->size }} dividido em até {{ $sizePizza->parts }} partes e contém {{ $sizePizza->pieces }} pedaços:  R$ {{ $sizePizza->price }}</option>
                        @endforeach
                    </select>

                </div>

                <button type="button" onclick="confirmedSize(), generateAmoutParts()" class="btn btn-success">Confirma Tamanho</button>
            </div>
            <!--------------->                        

            <div id="order_amounts_parts" style="width: 50%; margin-left: auto; margin-right: auto">

                <div class="form-group">
                    {!! Form::label('size_pizza','Quantos Sabores:') !!}
                    <select id="select_parts" name="parts" class="form-control"></select>
                </div>

                <button type="button" onclick="confirmedAmountParts()" class="btn btn-success">Confirma Quantidade de Partes</button>
            </div>
            <!--------------->
            <div id="order_flavors">

                <div class="form-group">

                    <div class="title" style="float: left; margin-top: -3%; margin-right: 5%; margin-left: 36%">
                        <h3 style="margin-left: 0%;">Selecione os Sabores Desejados.</h3>                        
                    </div>

                    <div>
                        <button type="button" onclick="confirmedFlavors()" class="btn btn-success" style="margin-top: -2.5%; float: right; margin-right: 5%">Confirma Sabores</button>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th></th>
                                <th>Imagen</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Preço</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $cont = 0 ?>
                            @foreach($flavors as $flavor)                            
                            <tr>                                
                                <td>{{ $flavor->id }}</td>
                                <td>
                                    <input type="checkbox" name="flavors_id[{{ $cont }}]" id="flavor_id" flavor="{{ $flavor->name }} R$ {{ $flavor->price }} " price="{{ $flavor->price }}" value="{{ $flavor->id }}" class="checkbox">
                                </td>
                                <td>
                                    <img class="img-rounded img-responsive" src="{{ url('uploads/'.$flavor->images->lists('id')->first().'.'.$flavor->images->lists('extension')->first()) }}" width="80">
                                </td>
                                <td>{{ $flavor->name }}</td>
                                <td>{{ $flavor->description }}</td>
                                <td>R$ {{ $flavor->price }}</td>
                            </tr>
                            <?php $cont++ ?>
                            @endforeach
                        </tbody>
                    </table>


                </div>

                <button type="button" onclick="confirmedFlavors()" class="btn btn-success">Confirma Sabores</button>
            </div>
            <!--------------->
            <div id="order_options" style="width: 50%; margin-left: auto; margin-right: auto">

                <div class="form-group">
                    {!! Form::label('drink_id','Selecione uma Bebida:') !!}

                    <select name="drink_id" id="drink_id" class="form-control">
                        <option value="0" price="0">Selecione</option>
                        @foreach($drinks as $drink)                            
                        <option value="{{ $drink->id }}" price="{{ $drink->price }}">{{ $drink->name }}:  R$ {{ $drink->price }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="form-group">
                    {!! Form::label('delivery_mean_id','Forma de Entrega:') !!}

                    <select name="delivery_mean_id" id="delivery_mean_id" class="form-control">
                        <option value="0" price="0">Selecione</option>
                        @foreach($deliveryMeans as $deliveryMean)                            
                        <option value="{{ $deliveryMean->id }}" price="{{ $deliveryMean->price }}">{{ $deliveryMean->name }}:  R$ {{ $deliveryMean->price }}</option>
                        @endforeach
                    </select>

                </div>

                <button type="button" onclick="confirmedChecked(), confirmCheck(), totalOrder();" class="btn btn-success">Confirma Opcionais</button>
            </div>

            <!--------------->
            <div id="order_checked" style="width: 50%; margin-left: auto; margin-right: auto">

                <div class="form-group" id="confirmedCheck"></div>
                <div class="form-group">
                    {!! Form::label('observation','Observação:') !!}
                    {!! Form::textarea('observation', null, ['class'=>'form-control', 'size' => '50x4']) !!}
                </div>

                <button onclick="confirmeDatas()" type="button" class="btn btn-success">Confirma Dados</button>

            </div>

            <!--------------->
            <div id="order_finishing" style="width: 50%; margin-left: auto; margin-right: auto">

                <div class="form-group" id="payment_form">
                    {!! Form::label('payment_form','Forma de Pagamento:') !!}
                    {!! Form::select('payment_form', 
                    [0=>'Selecione', 'Dinheiro'=>'Dinheiro', 'PagSeguro'=>'PagSeguro'],
                    null, ['class' => 'form-control', 'onchange' => 'paymentForm()']) !!}
                </div>               

                <div id="div_exchange_money">
                    <label>Precisa de troco?</label>
                    <div class="radio">                    
                        <label>
                            <input onchange="exchangeMoneyYes()" type="radio" name="radio_exchange_money" id="exchange_money_yes" value="yes">
                            Sim
                        </label>
                        <label>
                            <input onchange="exchangeMoneyNo()" type="radio" name="radio_exchange_money" id="exchange_money_no" value="no" checked="">
                            Não
                        </label>
                    </div> 
                </div>

                <div class="form-group" id="complement_payment"></div>
                <div class="form-group" id="complement_payment_2"></div>

                <button type="submit" class="btn btn-success">Finalizando</button>

            </div>

        </div>

    </div>

    {!! Form::close() !!}

</div>

@stop