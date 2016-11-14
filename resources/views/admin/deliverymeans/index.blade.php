@extends('app')
@section('content')

<div class="container">
    <h3>Formas de Entrega</h3>

    <a href="{{ route('admin.deliverymeans.create') }}" class="btn btn-default">Nova Borda</a>
    <br><br>

    <table class="table table-bordered">
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
                    <a href="{{ route('admin.deliverymeans.edit',['id'=>$deliverymean->id]) }}" class="btn btn-default btn-sm">
                        Editar
                    </a>
                    <a href="#modal_delete_<?= $deliverymean->id ?>" data-toggle="modal" class="btn btn-default btn-sm">
                        Remover
                    </a>
                </td>
            </tr>
            @include('admin.deliverymeans.partials.modal_delete')
            @endforeach
        </tbody>

    </table>

    {!! $deliverymeans->render() !!}

</div>

@endsection
