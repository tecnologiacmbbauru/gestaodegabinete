<!-- Modal -->
<div class="modal fade" id="resetSenha" tabindex="-1" role="dialog" aria-labelledby="resetSenha" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="resetSenha"  style="color: black;">Deseja resetar a senha do usuário?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p style="color: black;">
                A nova senha do usuário passara a ser o mesmo que o ‘login’.
                Oriente o usuário para alterar sua senha logando no sistema e indo em configurações.
            </p>
        </div>
        <div class="modal-footer">
          <form action="{{route('usuario.reset')}}" method="post" style="margin: 0px; padding:0px;">
            @csrf
            <input hidden name="alter_id" id="alter_id" value="">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
            <button type="submit" class="btn btn-primary">Sim</button>
          </form>   
        </div>
      </div>
    </div>
</div>
