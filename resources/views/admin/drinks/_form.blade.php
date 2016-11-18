<div class="form-group">
    {!! Form::label('Nome','Nome:') !!}
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('price','Preço:') !!}
    {!! Form::text('price', null, ['id'=>'xxxx', 'class'=>'form-control maskMoney', 'placeholder'=>'R$']) !!}
</div>
