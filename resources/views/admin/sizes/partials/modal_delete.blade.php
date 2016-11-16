
<div class="modal fade" id="modal_delete_<?= $sizePizza->id ?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirma</h4>
      </div>
      <div class="modal-body">
        <p>Gostaria de remover o tamanho <b>{{ $sizePizza->size }}</b>?</p>
      </div>
      <div class="modal-footer">
        <a href="{{ route('admin.sizes.destroy',['id'=>$sizePizza->id]) }}" class="btn btn-default">Sim</a>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
