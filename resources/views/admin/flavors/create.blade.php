@extends('app')
@section('content')

  {!! Form::open(['route'=>'admin.flavors.store','class'=>'form-horizontal']) !!}
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
          <div class="panel-heading">Novo Sabor</div>
          <div class="panel-body">

            @include('admin.flavors._form')

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                {!! Form::submit('Criar Sabor', ['class'=>'btn btn-primary']) !!}
                <a href="{{ route('admin.flavors.index') }}" class="btn btn-default">Voltar</a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  {!! Form::close() !!}

@endsection
