<!-- Modal -->
<div class="modal fade" id="usuarioPadrao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Deseja criar os usuarios padrão deste Gabinete?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p >
                Serão criados três (3) usuários para o Gabinete.
                <br>
                Os nomes de usuário terão o seguinte formato: <b><i>nome do banco de dados</i>+</b><b><i>número sequencial</i></b>.
                <br>
                A senha será igual ao nome de usuário.
            </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
          <a  href="{{route('usuarios.padrao.cadastro',$organizacao->domain)}}">Sim</a>
        </div>
      </div>
    </div>
</div>
