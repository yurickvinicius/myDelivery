@extends('app')
@section('content')

<div class="container">
    <h3>Bebidas</h3>

    <a href="{{ route('admin.drinks.create') }}" class="btn btn-default">Nova Bebida</a>
    <br><br>

    <table class="table table-bordered">
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
                    <a href="{{ route('admin.drinks.edit',['id'=>$drink->id]) }}" class="btn btn-default btn-sm">
                        Editar
                    </a>
                    <a href="#modal_delete_<?= $drink->id ?>" data-toggle="modal" class="btn btn-default btn-sm">
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

@endsection
