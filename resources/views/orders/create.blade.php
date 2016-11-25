@extends('app')
@section('content')

  {!! Form::open(['route'=>'order.store']) !!}
  <input type="hidden" id="typeOrder" value="orderIn">
  <div class="col-md-12">

    <div>
      <button onclick="orderIn(), clearOrderOut()" type="button" class="btn btn-primary ">Pedido no estabelicimento</button>
      <button onclick="orderOut(), clearOrderIn()" type="button" class="btn btn-primary ">Pedido fora do estabelicimento</button>
    </div><br>

    <div id="divOrderOut" class="panel panel-default">
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

    <!--------------------------------->
    <div id="divOrderIn" class="panel panel-default">
      <div class="panel-body">
        <div class="col-md-12">

          <div class="col-md-3">
            <div id="divCadBoard" class="form-group">
              <label class="control-label f_left" style="margin-right:5px; margin-top: 5px" for="cadBoard">N° da Mesa: </label>
              <input name="cadBoard" type="number" min="1" class="form-control" id="cadBoard" style="width:100px;">
            </div>
          </div>

          <div class="col-md-6">
            <div id="divCadResponsible" class="form-group">
              <label class="control-label f_left" style="margin-right:5px; margin-top: 5px" for="cadResponsible">Nome do Responsavel: </label>
              <input name="cadResponsible" type="text" class="form-control" id="cadResponsible" style="width:280px;">
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!--------------------------------->

  <input name="total" type="hidden" value="total" id="order_total">
  <div class="col-md-12" style="margin-bottom: 10%">
    <div id="total_all" class="font-25 canto"><b>TOTAL:</b> </div>

    <div id="generate_pizzas"></div>
    <div id="generate_options"></div>
    <!--------------------------->

    <div id="divFineshed" class="col-md-12" style='margin-top:3%; margin-left:-1%'>
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
      <button type="button" class="btn btn-primary add_new_pizza">Adicionar Nova Pizza</button>
      <button href="#modal_options" data-toggle="modal" type="button" class="btn btn-primary">Adicionar Opções</button>
      <button onclick="validateOrder(); return false;" class="btn btn-success" type="submit">Finalizar Cadastrar</button>
    </div>

  </div>

  @include('orders.partials.modal_options')

  {!! Form::close() !!}

@endsection
