@extends('app')
@section('content')

  {!! Form::open(['route'=>'admin.edges.store','class'=>'form-horizontal']) !!}
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
          <div class="panel-heading">Nova Borda</div>
          <div class="panel-body">

            @include('admin.edges._form')

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                {!! Form::submit('Criar Borda', ['class'=>'btn btn-primary']) !!}
                <a href="{{ route('admin.edges.index') }}" class="btn btn-default">Voltar</a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  {!! Form::close() !!}

@endsection
