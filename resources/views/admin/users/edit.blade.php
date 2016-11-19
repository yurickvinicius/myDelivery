@extends('app')
@section('content')

  {!! Form::model($user, ['route'=>['admin.users.update', $user->id], 'class'=>'form-horizontal']) !!}

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
          <div class="panel-heading">Atualizar Usuário</div>
          <div class="panel-body">

            @include('admin.users.partials._form')

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  Atualizar Dados
                </button>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  {!! Form::close() !!}
@endsection
