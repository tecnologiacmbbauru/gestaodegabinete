
<!-- Modal com Poup de confirmação de exclusão-->
<div class="modal" id="modalExclusao" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tem certeza que deseja excluir este registro?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <input type="hidden" name="id_exclusao" id="id_exclusao" value="">
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Sim</button> <!--Submit que vai enviar o método delete esta aqui -->
      </div>
    </div>
  </div>
</div>
