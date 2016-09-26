@extends('app')
@section('content')

<div class="container">
    <h3>Nova Imagen</h3>

    @include('errors._check')

    {!! Form::open(['route'=>['admin.flavors.images.store',$flavor->id], 'method'=>'post', 'enctype'=>"multipart/form-data"]) !!}

    <div class="form-group">
        {!! Form::label('image','Image:') !!}
        {!! Form::file('image', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Upload Imagen', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

</div>

@endsection