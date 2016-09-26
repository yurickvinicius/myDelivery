@extends('app')
@section('content')

<div class="container">
    <h3>Nova Bebida</h3>

    @include('errors._check')

    {!! Form::model($drink, ['route'=>['admin.drinks.update', $drink->id]]) !!}

    @include('admin.drinks._form')

    <div class="form-group">
        {!! Form::submit('Criar Bebida', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

</div>

@endsection