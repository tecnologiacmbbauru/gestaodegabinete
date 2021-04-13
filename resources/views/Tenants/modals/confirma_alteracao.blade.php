<!-- Modal -->
<div class="modal fade" id="confirmaAltDb" tabindex="-1" role="dialog" aria-labelledby="confirmaAltDb" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmaAltDb"><img src="{{asset('Utils/warning-yellow.png')}}">  Deseja alterar o registro?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <b>Atenção:</b><p>Por questões de segurança a alteração <b>não</b> afeta o banco de dados.
            <br>Caso os dados alterados não conhecidam  com o banco, a aplicação não ira funcionar.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
          <button type="submit" class="btn btn-primary">Sim</button>
        </div>
      </div>
    </div>
  </div>