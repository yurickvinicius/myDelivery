@extends('app')
@section('content')

  {!! Form::model($size, ['route'=>['admin.sizes.update', $size->id], 'class'=>'form-horizontal']) !!}
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
          <div class="panel-heading">Atualizar Tamanho</div>
          <div class="panel-body">

            @include('admin.sizes._form')

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                {!! Form::submit('Atualizar Tamanho', ['class'=>'btn btn-primary']) !!}
                <a href="{{ route('admin.sizes.index') }}" class="btn btn-default">Voltar</a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  {!! Form::close() !!}

@endsection
