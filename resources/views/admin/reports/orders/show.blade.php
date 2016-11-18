@extends('app')
@section('content')

  <div class="container">
    <div class="col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading">Pedidos {{ $status }}</div>
        <div class="panel-body">


          <table class="table table-hover table-condensed" contenteditable="true">
            <thead>
              <tr>
                <th>#</th>
                <th>Realizado</th>
                <th>N° Pedido</th>
                <th>Cliente</th>
                <th>Tipo</th>
                <th>Entrega</th>
                <th>Status</th>
                <th>Data</th>
                <th>Total</th>
                <th>Opções</th>
              </tr>
            </thead>
            <tbody>
              <?php $cont=1 ?>
              @foreach($reports as $report)
                <tr>
                  <td>{{ $cont++ }}</td>
                  <td>{{ $report->user->name }}</td>
                  <td>{{ $report->id }}</td>
                  <td>{{ $report->client->name }}</td>
                  <td>{{ $report->type_order }}</td>
                  <td>{{ $report->deliveryMean->name }}</td>
                  <td>{{ $report->status }}</td>
                  <td>{{ $report->created_at }}</td>
                  <td>R$ {{ $report->total }}</td>
                  <td>
                    <a href="#modal_detalhes_<?= $report->id ?>" data-toggle="modal" class="btn btn-primary btn-xs">Vizualizar</a>
                  </td>
                </tr>
                @include('admin.reports.orders.partials.modal_detalhes')
              @endforeach
            </tbody>
          </table>


        </div>
      </div>
    </div>

  </div>

@endsection
