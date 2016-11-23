<div class="form-group">
  <label class="col-md-4 control-label">Tamanho</label>
  <div class="col-md-6">
    {!! Form::text('size', null, ['class'=>'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('parts','Dividido no maximo em quantas partes?', ['class'=>'col-md-4 control-label']) !!}
  <div class="col-md-6">
    {!! Form::select('parts',
      [0=>'Selecione', 1=>'Unica Parte', 2, 3, 4, 5, 6, 7, 8, 9, 10],
      null, ['class' => 'form-control']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('parts','Possui quantos de pedaços?', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-2">
      {!! Form::number('pieces',null, ['class' => 'form-control', 'min'=>'1', 'max'=>'50']) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label">Preço</label>
    <div class="col-md-6">
      {!! Form::text('price', null, ['class'=>'form-control maskMoney', 'placeholder'=>'R$']) !!}
    </div>
  </div>
