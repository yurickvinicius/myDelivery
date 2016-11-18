@extends('app')
@section('content')

<div class="container">
    <h3>Atualizar Forma de Entrega</h3>

    {!! Form::model($deliverymean, ['route'=>['admin.deliverymeans.update', $deliverymean->id]]) !!}

    @include('admin.deliverymeans._form')

    <div class="form-group">
        {!! Form::submit('Atualizar Forma', ['class'=>'btn btn-primary']) !!}
        <a href="{{ route('admin.deliverymeans.index') }}" class="btn btn-default">Voltar</a>
    </div>

    {!! Form::close() !!}

</div>

@endsection
