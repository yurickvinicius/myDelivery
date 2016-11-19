@extends('app')
@section('content')

  <div class="container">
    <div class="col-md-12">
      <a href="{{ route('admin.deliverymeans.create') }}" class="btn btn-default">Nova Forma</a><br><br>
      <div class="panel panel-primary">
        <div class="panel-heading">Formas de Entrega</div>
        <div class="panel-body">

          <table class="table table-condensed">
            <thead>
              <tr>
                <th>ID</th>
                <th>Formas</th>
                <th>Price</th>
                <th>Ação</th>
              </tr>
            </thead>

            <tbody>
              @foreach($deliverymeans as $deliverymean)
                <tr>
                  <td>{{ $deliverymean->id }}</td>
                  <td>{{ $deliverymean->name }}</td>
                  <td>R$ {{ $deliverymean->price }}</td>
                  <td>
                    <a href="{{ route('admin.deliverymeans.edit',['id'=>$deliverymean->id]) }}" class="btn btn-default btn-xs">
                      Editar
                    </a>
                    <a href="#modal_delete_<?= $deliverymean->id ?>" data-toggle="modal" class="btn btn-default btn-xs">
                      Remover
                    </a>
                  </td>
                </tr>
                @include('admin.deliverymeans.partials.modal_delete')
              @endforeach
            </tbody>

          </table>

        </div>
      </div>

      {!! $deliverymeans->render() !!}

    </div>
  </div>

@endsection
