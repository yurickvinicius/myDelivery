@extends('app')
@section('content')

<div class="container">
    <h3>Bordas</h3>

    <a href="#" class="btn btn-default">Nova Borda</a>
    <br><br>

    <table class="table table-bordered">
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
                <td>{{ $edge->price }}</td>
                <td>
                    <a href="#" class="btn btn-default btn-sm">
                        Editar
                    </a>
                    <a href="#modal_delete_<?= $edge->id ?>" data-toggle="modal" class="btn btn-default btn-sm">
                        Remover
                    </a>
                </td>
            </tr>
            @include('admin.edges.partials.modal_delete')
            @endforeach
        </tbody>

    </table>

    {!! $edges->render() !!}

</div>

@endsection
