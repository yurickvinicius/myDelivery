<?php ///dd($order->orderPizzas->find(8)->pizzaBuilts)  ?>

@extends('app')
@section('content')

  <div class="col-md-12" style="margin-bottom: 10%">

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title" contenteditable="true">Dados do Cliente</h3>
      </div>

      @if(isset($order->client->name))
        <div class="panel-body" contenteditable="true">
          <div class="col-md-4">
            <div>
              <label>Data do Pedido:</label>
              {{ $order->created_at }}
            </div>
            <div>
              <label>Nome do Cliente:</label>
              {{ $order->client->name }}
            </div>
            <div>
              <label>Telefone Celular:</label>
              {{ $order->client->cell_phone }}
            </div>
            <div>
              <label>Telefone Fixo:</label>
              {{ $order->client->phone }}
            </div>
          </div>
          <div class="col-md-4">
            <div>
              <label>Bairro:</label>
              {{ $order->client->neighborhood }}
            </div>
            <div>
              <label>Endereço do Cliente:</label>
              {{ $order->client->address }}
            </div>
            <div>
              <label>Numero:</label>
              {{ $order->client->number }}
            </div>
            <div>
              <label>Complemento:</label>
              {{ $order->client->complement }}
            </div>

          </div>
          <div class="col-md-4">
            <div>
              <label>Meio de Entrega:</label>
              {{ $order->deliveryMean->name }}
              <b>Valor: </b> R$ {{ $order->deliveryMean->price }}
            </div>

            <div>
              <label>Forma de Pagamento:</label>
              {{ $order->paymentForm->form }}
            </div>

            <div>
              <label>Troco para pagamento:</label>
              R$ {{ $order->paymentForm->exchange_money }}
            </div>

            <div>
              <label>Total:</label>
              R$ {{ $order->total }}
            </div>
          </div>
        </div>
      @endif

      @if(isset($order->board->number))
        <div class="panel-body" contenteditable="true">
          <div class="col-md-4">
            <div>
              <label>Data do Pedido:</label>
              {{ $order->created_at }}
            </div>
            <div>
              <label>Mesa:</label>
              {{ $order->board->number }}
            </div>
            <div>
              <label>Responsavel:</label>
              {{ $order->board->name }}
            </div>
          </div>
          <div class="col-md-4">
            <div>
              <label>Meio de Entrega:</label>
              No Estabelicimento
            </div>
            <div>
              <label>Total:</label>
              R$ {{ $order->total }}
            </div>
          </div>
        </div>
      @endif

    </div>

    <?php $contP=1 ?>
    @foreach($order->orderPizzas as $orderPizza)
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">
            Dados da Pizza <?= $contP++ ?>
            <a style="float: right" href="#" class="btn-link">Clique para Alterar Pizza</a>
          </h3>
        </div>

        <div class="panel-body">

          <div class="col-md-3">
            <div>
              <label>Tamanho:</label>
              {{ $orderPizza->pizzaBuilts->find($orderPizza->pizza_built_id)->sizePizza->size }}
            </div>

            <div>
              <label>Preço da Pizza:</label>
              R$ {{ $orderPizza->pizzaBuilts->find($orderPizza->pizza_built_id)->sizePizza->price }}
            </div>
            <div>
              <label>Borda:</label>
              {{ $orderPizza->pizzaBuilts->find($orderPizza->pizza_built_id)->edgePizza->name }}
              <b>Valor</b>: R$ {{ $orderPizza->pizzaBuilts->find($orderPizza->pizza_built_id)->edgePizza->price }}
            </div>
            <div>
              <label>Observação:</label>
              {{ $orderPizza->pizzaBuilts->find($orderPizza->pizza_built_id)->observation }}
            </div>
          </div>

          <div class="col-md-9">
            <table class="table table-hover table-condensed" contenteditable="true">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Sabor</th>
                  <th>Descrição</th>
                  <th>Valor</th>
                </tr>
              </thead>
              <tbody>
                <?php $cont=1 ?>
                @foreach($orderPizza->pizzaBuilts->find($orderPizza->pizza_built_id)->flavorsPizza as $flavoPizza)
                  <tr>
                    <td>{{ $cont++ }}</td>
                    <td>{{ $flavoPizza->flavor->name }}</td>
                    <td>{{ $flavoPizza->flavor->description }}</td>
                    <td>R$ {{ $flavoPizza->flavor->price }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    @endforeach

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">
          Opcionais
          <a style="float: right" href="#" class="btn-link">Clique para Alterar Opicionais</a>
        </h3>
      </div>
      <div class="panel-body" contenteditable="true">

        @if(count($order->orderDrinks) == 0)
          <div>Nenhum</div>
        @endif

        <table class="table table-hover table-condensed">
          <thead>
            <tr>
              <th>#</th>
              <th>Nome</th>
              <th>Preço</th>
              <th>Quantidade</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>

            <?php $cont=1; ?>
            @foreach($order->orderDrinks as $orderDrink)
              <?php $drink = $orderDrink->find($orderDrink->id)->drinks ?>

              <tr>
                <td><?= $cont++ ?></td>
                <td><?= $drink[0]['name'] ?></td>
                <td>R$ <?= $drink[0]['price'] ?></td>
                <td>{{ $orderDrink->amount }}</td>
                <td>R$ {{ $orderDrink->amount * $drink[0]['price'] }}</td>
                <tr/>

              @endforeach

            </tbody>
          </table>

        </div>
      </div>

      {!! Form::open(['route'=>'order.send']) !!}

      <div id="div_exchange_money" class="col-md-12">
        <label>Qual o estado do pedido?</label>
        <div class="radio">

          <?php
          $preparandoStatus = '';
          $sendStatus = '';
          $openStatus = '';

          if($order->status == 'Preparando')
          $preparandoStatus = 'checked';
          else if($order->status == 'Enviado')
          $sendStatus = 'checked';
          else
          $openStatus = 'checked';
          ?>

          <label>
            <input type="radio" name="pizza_delivered" value="sim">
            Entregue
          </label>
          <label>
            <input onchange="statusOrder()" type="radio" name="pizza_delivered" value="nao" <?= $openStatus ?>>
            Aberto
          </label>
          <label>
            <input onchange="statusOrder()" type="radio" name="pizza_delivered" value="Preparando" <?= $preparandoStatus ?>>
            Preparando
          </label>
          <label>
            <input onchange="statusOrder()" type="radio" name="pizza_delivered" id="rdSendPizza" value="Enviado" <?= $sendStatus ?>>
            Enviado
          </label>

        </div>
      </div>

      <input type="hidden" name="order_id" value="{{ $order->id }}">

      <div id="divDeliverymens" class="form-group">
        {!! Form::label('deliverymean_id','Entregadores:',['class'=>'col-md-1 control-label','style'=>'margin-top: 5px']) !!}
        <div class="col-md-3">
          <select name="deliverymean_id" class="form-control">
            @if($order->deliverie != '')
              <option value="{{ $order->deliverie->user->name }}">{{ $order->deliverie->user->name }}</option>
            @else
              <option value="0">Selecione Meio de Entrega</option>
            @endif

            @foreach($deliverymens as $deliverymen)
              <option value="{{ $deliverymen->id }}">Entregador: {{ $deliverymen->name }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group" style="margin-top: 2%; float: left">
        <a href="{{ route('orders.index') }}" class="btn btn-default btn-lg">Voltar</a>
        <input type="submit" class="btn btn-success btn-lg" value="Encaminhar">
        <input disabled="disabled" type="button" class="btn btn-primary btn-lg" value="Adicionar Desconto">
        <input disabled="disabled" type="button" class="btn btn-primary btn-lg" value="Versão para Impresão">
        <input disabled="disabled" type="button" class="btn btn-primary btn-lg" value="Gerar Nota Fiscal">
      </div>

      {!! Form::close() !!}

      <div style="font-size: 30px; float: right; margin-top: 2%">
        <label>Total</label>
        R$ {{ $order->total }}
      </div>

    </div>

  @endsection
