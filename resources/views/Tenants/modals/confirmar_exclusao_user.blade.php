<!-- Modal -->
<div class="modal fade" id="usuarioExclusao" tabindex="-1" role="dialog" aria-labelledby="ModalusuarioExclusao" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalusuarioExclusao" style="color: black;">Deseja excluir usuário?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
       
        <div class="modal-footer">
           {{--Form responsavel por chamar o metodo de deletar o usuario enviando como parametro user_id para uma requisição do tipo POST--}}
          <form action="{{route('usuario.exclusao')}}" method="post" style="margin: 0px; padding:0px;">
            @csrf
            <input hidden name="user_id" id="user_id" value="">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
            <button type="submit" class="btn btn-danger">Sim</button>
          </form>
        </div>
      </div>
    </div>
</div>