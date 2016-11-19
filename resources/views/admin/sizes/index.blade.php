@extends('app')
@section('content')

  <div class="container">
    <div class="col-md-12">
      <a href="{{ route('admin.sizes.create') }}"  class="btn btn-default">Novo Tamanho</a><br><br>
      <div class="panel panel-primary">
        <div class="panel-heading">Tamanho das Pizzas</div>
        <div class="panel-body">

          <table class="table table-condensed">
            <thead>
              <tr>
                <th>ID</th>
                <th>Tamanho</th>
                <th>Partes</th>
                <th>Pedaços</th>
                <th>Preço</th>
                <th>Ação</th>
              </tr>
            </thead>

            <tbody>
              @foreach($sizePizzas as $sizePizza)
                <tr>
                  <td>{{ $sizePizza->id }}</td>
                  <td>{{ $sizePizza->size }}</td>

                  @if($sizePizza->parts == 1)
                    <td>dividido no máximo: unica parte</td>
                  @else
                    <td>dividido no máximo: {{ $sizePizza->parts }} parte</td>
                  @endif
                  
                  <td>contém: {{ $sizePizza->pieces }} pedaços</td>
                  <td>R$ {{ $sizePizza->price }}</td>
                  <td>
                    <a href="{{ route('admin.sizes.edit',['id'=>$sizePizza->id]) }}" class="btn btn-default btn-xs">
                      Editar
                    </a>
                    <a href="#modal_delete_<?= $sizePizza->id ?>" data-toggle="modal" class="btn btn-default btn-xs">
                      Remover
                    </a>
                  </td>
                </tr>
                @include('admin.sizes.partials.modal_delete')
              @endforeach
            </tbody>
          </table>

          {!! $sizePizzas->render() !!}

        </div>
      </div>
    </div>
  </div>

@endsection
