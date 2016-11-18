@extends('app')
@section('content')

<div class="container">
  <div class="col-md-12">
    <a href="{{ route('admin.drinks.create') }}" class="btn btn-default">Nova Bebida</a><br><br>
    <div class="panel panel-primary">
      <div class="panel-heading">Bebidas</div>
      <div class="panel-body">


        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Preço</th>
              <th>Ação</th>
            </tr>
          </thead>

          <tbody>
            @foreach($drinks as $drink)
            <tr>
              <td>{{ $drink->id }}</td>
              <td>{{ $drink->name }}</td>
              <td>{{ $drink->price }}</td>
              <td>
                <a href="{{ route('admin.drinks.edit',['id'=>$drink->id]) }}" class="btn btn-default btn-xs">
                  Editar
                </a>
                <a href="#modal_delete_<?= $drink->id ?>" data-toggle="modal" class="btn btn-default btn-xs">
                  Remover
                </a>
              </td>
            </tr>
            @include('admin.drinks.partials.modal_delete')
            @endforeach
          </tbody>

        </table>

        {!! $drinks->render() !!}

      </div>
    </div>
  </div>
</div>

@endsection
