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
                <th>Ação</th>
            </tr>
        </thead>

        <tbody>
            @foreach($edges as $edge)
            <tr>
                <td>{{ $edge->id }}</td>
                <td>{{ $edge->name }}</td>
                <td>
                    <a href="#" class="btn btn-default btn-sm">
                        Editar
                    </a>
                    <a href="#" class="btn btn-default btn-sm">
                        Deletar
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

    {!! $edges->render() !!}

</div>

@endsection