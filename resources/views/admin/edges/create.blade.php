@extends('app')
@section('content')

<div class="container">
    <h3>Nova Borda</h3>

    {!! Form::open(['route'=>'admin.edges.store']) !!}

    @include('admin.edges._form')

    <div class="form-group">
        {!! Form::submit('Criar Borda', ['class'=>'btn btn-primary']) !!}
        <a href="{{ route('admin.edges.index') }}" class="btn btn-default">Voltar</a>
    </div>

    {!! Form::close() !!}

</div>

@endsection
