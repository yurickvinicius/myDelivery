<div class="form-group">
    <label class="col-md-4 control-label">Nome</label>
    <div class="col-md-6">
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Descrição</label>
    <div class="col-md-6">
        {!! Form::textarea('description', null, ['class'=>'form-control', 'rows'=>'4']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Preço</label>
    <div class="col-md-6">
        {!! Form::text('price', null, ['class'=>'form-control maskMoney', 'placeholder'=>'R$ 0.00']) !!}
    </div>
</div>
