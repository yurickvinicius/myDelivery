@extends('app')
@section('content')

  <div class="container">
    <div class="col-md-12">
      <a href="{{ route('admin.flavors.create') }}"  class="btn btn-default">Novo Sabor</a><br><br>
      <div class="panel panel-primary">
        <div class="panel-heading">Sabores</div>
        <div class="panel-body">

          <table class="table table-condensed">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Ação</th>
              </tr>
            </thead>

            <tbody>
              @foreach($flavors as $flavor)
                <tr>
                  <td>{{ $flavor->id }}</td>
                  <td>{{ $flavor->name }}</td>
                  <td>{{ $flavor->description }}</td>
                  <td>R$ {{ $flavor->price }}</td>
                  <td>
                    <a href="{{ route('admin.flavors.edit', ['id'=>$flavor->id]) }}" class="btn btn-default btn-xs">
                      Editar
                    </a>
                    <a href="{{ route('admin.flavors.images',['id'=>$flavor->id]) }}" class="btn btn-default btn-xs">
                      Imagens
                    </a>
                    <a href="#modal_delete_<?= $flavor->id ?>" data-toggle="modal" class="btn btn-default btn-xs">
                      Remover
                    </a>
                  </td>
                </tr>
                @include('admin.flavors.partials.modal_delete')
              @endforeach
            </tbody>
          </table>

        </div>
      </div>
      {!! $flavors->render() !!}
    </div>
  </div>

@endsection
