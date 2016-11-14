@extends('app')
@section('content')

<div class="container">
    <h3>Novo Tamanho</h3>

    {!! Form::model($size, ['route'=>['admin.sizes.update', $size->id]]) !!}

    @include('admin.sizes._form')

    <div class="form-group">
        {!! Form::submit('Atualizar Tamanho', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

</div>

@endsection
