<div class="form-group">
  <label class="col-md-4 control-label">Nome</label>
  <div class="col-md-6">
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label">E-Mail</label>
  <div class="col-md-6">
    {!! Form::email('email', null, ['class'=>'form-control']) !!}
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label">Status</label>
  <div class="col-md-6">

    <select name="role" class="form-control">
      @if(isset($user->role))
        <option value="{{ $user->role }}">{{ $user->role }}</option>
      @else
        <option value="0">Selecione</option>
      @endif
      <option value="Entregador">Entregador</option>
      <option value="Atendente">Atendente</option>
      <option value="Administrador">Administrador</option>
    </select>
  </div>
</div>
