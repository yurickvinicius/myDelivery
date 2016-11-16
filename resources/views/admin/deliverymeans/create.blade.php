@extends('app')
@section('content')

<div class="container">
    <h3>Nova Forma de Entrega</h3>

    {!! Form::open(['route'=>'admin.deliverymeans.store']) !!}

    @include('admin.deliverymeans._form')

    <div class="form-group">
        {!! Form::submit('Criar Forma', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

</div>

@endsection
