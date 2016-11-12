@extends('app')
@section('content')

<div class="container">
    <h3>Tamanho das Pizzas</h3>

    <a href="#"  class="btn btn-default">Novo Tamanho</a>
    <br><br>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tamanho</th>
            <th>Divididos</th>
            <th>Preço</th>
            <th>Ação</th>
        </tr>
        </thead>

        <tbody>
        @foreach($sizePizzas as $sizePizza)
            <tr>
                <td>{{ $sizePizza->id }}</td>
                <td>{{ $sizePizza->size }}</td>
                <td>no máximo: {{ $sizePizza->parts }} parte</td>
                <td>{{ $sizePizza->price }}</td>
                <td>
                    <a href="#" class="btn btn-default btn-sm">
                        Editar
                    </a>
                    <a href="#modal_delete_<?= $sizePizza->id ?>" data-toggle="modal" class="btn btn-default btn-sm">
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

@endsection
