@extends('app')
@section('content')

  {!! Form::model($deliverymean, ['route'=>['admin.deliverymeans.update', $deliverymean->id], 'class'=>'form-horizontal']) !!}
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
          <div class="panel-heading">Atualizar Forma de Entrega</div>
          <div class="panel-body">

            @include('admin.deliverymeans._form')

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                {!! Form::submit('Atualizar Forma', ['class'=>'btn btn-primary']) !!}
                <a href="{{ route('admin.deliverymeans.index') }}" class="btn btn-default">Voltar</a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  {!! Form::close() !!}

@endsection
