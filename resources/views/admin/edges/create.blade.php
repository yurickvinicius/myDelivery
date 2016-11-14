@extends('app')
@section('content')

<div class="container">
    <h3>Nova Borda</h3>

    {!! Form::open(['route'=>'admin.edges.store']) !!}

    @include('admin.edges._form')

    <div class="form-group">
        {!! Form::submit('Criar Borda', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

</div>

@endsection
