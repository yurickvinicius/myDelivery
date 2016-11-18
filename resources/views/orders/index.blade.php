@extends('app')
@section('content')

  <div class="col-md-12">

    <h3 style="float: left">Pedidos</h3>
    <div style="float: right; margin-top: 1%">
      <a href="{{ route('order.create') }}" class="btn btn-primary">Novo Pedido</a>
    </div>

    <br><br>

    <table class="table table-hover table-condensed">
      <thead>
        <tr>
          <th>#</th>
          <th>Cliente</th>
          <th>N° Pedido</th>
          <th>Form. Entrega</th>
          <th>Status</th>
          <th>Data</th>
          <th>Entregador</th>
          <th>Valor</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $cont = 1;
        ?>
        @foreach($orders as $order)
          <?php $color = 'danger' ?>

          @if($order->status == 'Preparando')
            <?php $color = 'warning' ?>
          @endif

          @if($order->status == 'Enviado')
            <?php $color = 'info' ?>
          @endif

          @if($order->status == 'Entregue')
            <?php $color = '' ?>
          @endif

          <tr class="{{ $color }}">
            <td>{{ $cont++ }}</td>
            <td>{{ $order->client->name }}</td>
            <td>{{ $order->id }}</td>
            <td>{{ $order->deliveryMean->name }}</td>
            <td>{{ $order->status }}</td>
            <td>{{ $order->created_at }}</td>
            <td>
              @if(isset($order->deliverie->id))
                {{ $order->deliverie->user->name }}
              @endif
            </td>
            <td>{{ $order->total }}</td>
            <td>
              <a href="{{ route('order.show', ['id'=>$order->id]) }}" class="btn btn-default btn-sm">
                Vizualizar Detalhes
              </a>
              <a href="#modal_delete_<?= $order->id ?>" data-toggle="modal" class="btn btn-default btn-sm">
                Cancelar
              </a>
            </td>
          </tr>
          @include('orders.partials.modal_delete')
        @endforeach
      </tbody>
    </table>

    {!! $orders->render() !!}

  </div>

@endsection
