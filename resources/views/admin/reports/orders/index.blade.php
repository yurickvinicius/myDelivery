@extends('app')
@section('content')

{!! Form::open(['route'=>'admin.reports.orders']) !!}

<div class="container">
    <div class="col-md-6" style="possition:absolute; margin-left:20%">
        <div class="panel panel-primary">
          <div class="panel-heading">Pedidos Entregues</div>
            <div class="panel-body">
                <div class="col-md-12">

                  <div class="form-group col-xs-6">
                      {!! Form::label('startDate','Data Inicial:') !!}
                      {!! Form::date('startDate', null, ['class'=>'form-control']) !!}
                  </div>

                  <div class="form-group col-xs-6">
                      {!! Form::label('endDate','Data Final:') !!}
                      {!! Form::date('endDate', null, ['class'=>'form-control']) !!}
                  </div>

                </div>

                <div class="col-md-12">
                    <div class="form-group col-xs-12">
                        <label>Status: </label>
                        <select name="status" class="form-control">
                            <option value="0">Selecione</option>
                            <option value="Aberto">Aberto</option>
                            <option value="Enviado">Enviado</option>
                            <option value="Entregue">Entregue</option>
                            <option value="Todos">Todos</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group col-xs-12">
                        <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{!! Form::close() !!}
@endsection
