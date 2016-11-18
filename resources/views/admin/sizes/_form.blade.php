<div class="form-group">
    {!! Form::label('size','Tamanho:') !!}
    {!! Form::text('size', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('parts','Dividido no maximo em quantos pedaços?') !!}
    {!! Form::select('parts',
    [0=>'Selecione', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
    null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('price','Preço:') !!}
    {!! Form::text('price', null, ['class'=>'form-control maskMoney', 'placeholder'=>'R$']) !!}
</div>
