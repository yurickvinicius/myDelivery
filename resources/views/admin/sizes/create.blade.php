@extends('app')
@section('content')

<div class="container">
    <h3>Novo Tamanho</h3>

    {!! Form::open(['route'=>'admin.sizes.store']) !!}

    @include('admin.sizes._form')

    <div class="form-group">
        {!! Form::submit('Criar Tamanho', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

</div>

@endsection
