@extends('app')
@section('content')

  <div class="container">
    <div class="col-md-12">
      <a href="{{ route('admin.edges.create') }}" class="btn btn-default">Nova Borda</a><br><br>
      <div class="panel panel-primary">
        <div class="panel-heading">Bordas</div>
        <div class="panel-body">

          <table class="table table-condensed">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Price</th>
                <th>Ação</th>
              </tr>
            </thead>

            <tbody>
              @foreach($edges as $edge)
                <tr>
                  <td>{{ $edge->id }}</td>
                  <td>{{ $edge->name }}</td>
                  <td>R$ {{ $edge->price }}</td>
                  <td>
                    <a href="{{ route('admin.edges.edit',['id'=>$edge->id]) }}" class="btn btn-default btn-xs">
                      Editar
                    </a>
                    <a href="#modal_delete_<?= $edge->id ?>" data-toggle="modal" class="btn btn-default btn-xs">
                      Remover
                    </a>
                  </td>
                </tr>
                @include('admin.edges.partials.modal_delete')
              @endforeach
            </tbody>

          </table>

        </div>
      </div>
      {!! $edges->render() !!}
    </div>
  </div>

@endsection
