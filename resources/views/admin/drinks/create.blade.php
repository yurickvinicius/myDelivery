@extends('app')
@section('content')

<div class="container">
    <h3>Nova Bebida</h3>

    {!! Form::open(['route'=>'admin.drinks.store']) !!}

    @include('admin.drinks._form')

    <div class="form-group">
        {!! Form::submit('Criar Bebida', ['class'=>'btn btn-primary']) !!}
        <a href="{{ route('admin.drinks.index') }}" class="btn btn-default">Voltar</a>
    </div>

    {!! Form::close() !!}

</div>

@endsection
