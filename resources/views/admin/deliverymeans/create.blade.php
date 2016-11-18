@extends('app')
@section('content')

<div class="container">
    <h3>Nova Forma de Entrega</h3>

    {!! Form::open(['route'=>'admin.deliverymeans.store']) !!}

    @include('admin.deliverymeans._form')

    <div class="form-group">
        {!! Form::submit('Criar Forma', ['class'=>'btn btn-primary']) !!}
        <a href="{{ route('admin.deliverymeans.index') }}" class="btn btn-default">Voltar</a>
    </div>

    {!! Form::close() !!}

</div>

@endsection
