<div class="form-group">
    {!! Form::label('edge','Borda:') !!}
    {!! Form::select('edge', 
    [0=>'Selecione', 'Sem Borda'=>'Sem Borda', 'Com Borda'=>'Com Borda'],
    null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('size','Tamanho:') !!}
    
    {!! Form::select('size', 
    [0=>'Selecione', 'Pequena'=>'Pequena', 'Média'=>'Média', 'Grande'=>'Grande', 'Família'=>'Família'],
    null, ['class' => 'form-control']) !!}    
</div>

<div class="form-group">
    {!! Form::label('parts','Partes:') !!}
    
    {!! Form::select('parts', 
    [0=>'Selecione', 1, 2, 3, 4],
    null, ['class' => 'form-control']) !!}    
</div>

<div class="form-group">
    {!! Form::label('price','Preço:') !!}
    {!! Form::text('price', null, ['placeholder'=>'R$', 'class'=>'form-control']) !!}
</div>