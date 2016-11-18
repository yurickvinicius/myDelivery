@extends('app')
@section('content')

<div class="container">
    <h3>Novo Sabor</h3>

    {!! Form::open(['route'=>'admin.flavors.store']) !!}

    @include('admin.flavors._form')

    <div class="form-group">
        {!! Form::submit('Criar Sabor', ['class'=>'btn btn-primary']) !!}
        <a href="{{ route('admin.flavors.index') }}" class="btn btn-default">Voltar</a>
    </div>

    {!! Form::close() !!}

</div>

@endsection
