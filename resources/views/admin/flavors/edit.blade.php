@extends('app')
@section('content')

<div class="container">
    <h3>Novo Sabor</h3>

    {!! Form::model($flavor, ['route'=>['admin.flavors.update', $flavor->id]]) !!}

    @include('admin.flavors._form')

    <div class="form-group">
        {!! Form::submit('Criar Sabor', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

</div>

@endsection
