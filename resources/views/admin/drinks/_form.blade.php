<div class="form-group">
    <label class="col-md-4 control-label">Nome</label>
    <div class="col-md-6">
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Preço</label>
    <div class="col-md-6">
        {!! Form::text('price', null, ['class'=>'form-control maskMoney', 'placeholder'=>'R$']) !!}
    </div>
</div>
