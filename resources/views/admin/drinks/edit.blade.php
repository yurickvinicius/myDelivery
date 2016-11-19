@extends('app')
@section('content')

  {!! Form::model($drink, ['route'=>['admin.drinks.update', $drink->id], 'class'=>'form-horizontal']) !!}

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
          <div class="panel-heading">Novo Usuário</div>
          <div class="panel-body">

            @include('admin.drinks._form')

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                {!! Form::submit('Atualizar Opção', ['class'=>'btn btn-primary']) !!}
                <a href="{{ route('admin.drinks.index') }}" class="btn btn-default">Voltar</a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  {!! Form::close() !!}

@endsection
