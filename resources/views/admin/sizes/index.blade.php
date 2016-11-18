@extends('app')
@section('content')

<div class="container">
    <h3>Tamanho das Pizzas</h3>

    <a href="{{ route('admin.sizes.create') }}"  class="btn btn-default">Novo Tamanho</a>
    <br><br>

    <table class="table table-bordered">
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
                <td>dividido no máximo: {{ $sizePizza->parts }} parte</td>
                <td>contém: {{ $sizePizza->pieces }} pedaços</td>
                <td>R$ {{ $sizePizza->price }}</td>
                <td>
                    <a href="{{ route('admin.sizes.edit',['id'=>$sizePizza->id]) }}" class="btn btn-default btn-sm">
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
