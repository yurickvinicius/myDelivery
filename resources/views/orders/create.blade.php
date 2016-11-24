@extends('app')
@section('content')

  {!! Form::open(['route'=>'order.store']) !!}

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="col-md-12">
          <div id="divCadName" class="form-group col-xs-3">
            <label class="control-label" for="cadName">Nome</label>
            <input name="cadName" type="text" class="form-control" id="cadName" placeholder="Nome">
          </div>

          <div class="form-group col-xs-3">
            <div id="divCadCEP" class="input-group">
              <label class="control-label" for="cadCEP">CEP</label>
              <input name="cadCEP" id="cadCEP" class="form-control cepMask" placeholder="CEP">
              <div class="input-group-btn">
                <button onclick="searchCEP()" style="margin-top: 24%; padding-top: 7%" type="button" class="btn btn-primary"><i class="glyphicon glyphicon-search marg_right_5"></i>Procurar</button>
              </div>
            </div>
          </div>

          <div class="form-group col-xs-6">
            <div class="input-group" style="float:right">
              <label>Buscar</label>
              <input title='Digite o numero do telefone desejado sem o ddd' onkeyup="searchClient()" id="inpSearchClient" class="form-control" placeholder="Telefone Fixo ou Celular">
              <div id="divSearchClient" style='position:absolute; z-index: 9999; top:105%; background-color: #dce7f7'></div>
            </div>
          </div>

        </div>

        <div class="col-md-12">

          <div id="divCadNeighborhood" class="form-group col-xs-2">
            <label class="control-label" for="cadNeighborhood">Bairro</label>
            <input name="cadNeighborhood" type="text" class="form-control" id="cadNeighborhood" placeholder="Bairro">
          </div>

          <div id="divCadAddress" class="form-group col-xs-5">
            <label class="control-label" for="cadAddress">Endereço</label>
            <input name="cadAddress" type="text" class="form-control" id="cadAddress" placeholder="Endereço">
          </div>

          <div class="form-group col-xs-5">
            <label for="cadComplement">Complemento</label>
            <input name="cadComplement" type="text" class="form-control" id="cadComplement" placeholder="Complemento">
          </div>

        </div>

        <div class="col-md-12">
          <div id="divCadNumber" class="form-group col-xs-1">
            <label class="control-label" for="cadNumber">Numero</label>
            <input name="cadNumber" type="text" class="form-control" id="cadNumber">
          </div>

          <div id="divCadCellPhone" class="form-group col-xs-2">
            <label class="control-label" for="cadTelCellPhone">Tel. Celular</label>
            <input name="cadTelCellPhone" type="text" class="form-control phoneMask" id="cadTelCellPhone" placeholder="Celular">
          </div>
          <div class="form-group col-xs-2">
            <label for="cadTelPhone">Tel. Residencial</label>
            <input name="cadTelPhone" type="text" class="form-control phoneMask" id="cadTelPhone" placeholder="Telefone">
          </div>

        </div>

      </div>
    </div>
  </div>

  <!--------------------------------->

  <input name="total" type="hidden" value="total" id="order_total">
  <div class="col-md-12" style="margin-bottom: 10%">
    <div id="total_all" class="font-25 canto"><b>TOTAL:</b> </div>

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Pizza 1</h3>
      </div>
      <div class="panel-body">

        <div class="col-md-12 column ui-sortable font-25">
          <div class="col-md-4">
            <div id="divCadEdge_1" class="form-group">
              <label class="control-label" for="cad_edge_1">Borda</label>
              <select name="pizza[1][edge]" onchange="valTotalPizza(1)" class="form-control input-lg" id="cad_edge_1" style="font-size: 22px">
                <option value="0">Selecione</option>
                @foreach($edges as $edge)
                  <option value="{{ $edge->id }}" price='{{ $edge->price }}'>{{ $edge->name }}</option>
                @endforeach
              </select>
            </div>
            <div id="divCadSize_1" class="form-group">
              <label class="control-label">Tamanho</label>
              <select name="pizza[1][size]" onchange="selectedMaxParts(1), valTotalPizza(1)" class="form-control input-lg" id="cad_size_pizza_1" style="font-size: 22px">
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

          <div class="col-md-3">
            <div class="col-md-12">
              <div id="divCadFlavor_1" class="input-group">
                <label class="control-label" for="inp_flavor_cod_1" style="font-size:14px; float:left; margin-right:5px; margin-top:5px">Insira o Código: </label>
                <input title="Insira o código e após click no nome" onkeyup="showFlavorCod(1)" id="inp_flavor_cod_1" type="text" class="form-control" style="width: 90px" placeholder="código">
              </div>
            </div>

            <div style="height: 40px" class="col-md-12">
              <div id="showFlavorCod_1"></div>
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

    <div id="generate_pizzas"></div>

    <div id="generate_options"></div>
    <!--------------    -------------->

    <div class="col-md-12" style='margin-top:3%; margin-left:-1%'>
      <div id="divDeliverymeans" class="col-xs-3">
        <label class="control-label" for="delivery_means">Forma de Entrega</label>
        <select onchange="valTotalPizza()" name="delivery_means" id="delivery_means" class="form-control">
          <option value="0" price="0">Forma de Entrega</option>
          @foreach($deliveryMeans as $deliveryMean)
            <option value="{{ $deliveryMean->id }}" price="{{ $deliveryMean->price }}">{{ $deliveryMean->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group col-xs-2">
        <label for="cadTelPhone">Troco para?</label>
        <input name="cadChange" type="text" class="form-control maskMoney" id="cadChange" placeholder="R$">
      </div>
    </div>

    <div class="col-md-12">
      <button type="button" class="btn btn-primary btn-lg add_new_pizza"><i class="glyphicon glyphicon-plus marg_right_5"></i>Adicionar Nova Pizza</button>
      <button href="#modal_options" data-toggle="modal" type="button" class="btn btn-primary btn-lg">Adicionar Opções</button>
      <button onclick="validateOrder(); return false;" class="btn btn-success btn-lg" type="submit">Finalizar Cadastrar</button>
    </div>

  </div>

  @include('orders.partials.modal_flavors_pizza')
  @include('orders.partials.modal_options')

  {!! Form::close() !!}

@endsection
