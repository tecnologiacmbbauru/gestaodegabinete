<!-- Modal -->
<div class="modal fade" id="exclusaoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><img src="{{asset('utils/warning.png')}}">  Deseja excluir o Gabinete?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div style="padding-left:20px">
                <input class="form-check-input" type="checkbox" id="delete_bd" name="delete_bd" onclick="showAlert()">
                <b>Excluir também o  banco de dados?</b>
            </div>
            <br>
            <p id="msg-alert" hidden>
                <b>Atenção:</b> Ao excluir o banco de dados, nenhuma informação poderá ser recuperada.
            </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
          <button type="submit" class="btn btn-primary">Sim</button>
        </div>
      </div>
    </div>
</div>

<script>
    function showAlert(){
        document.getElementById('msg-alert').hidden =  !document.getElementById('msg-alert').hidden;
    }
</script>
