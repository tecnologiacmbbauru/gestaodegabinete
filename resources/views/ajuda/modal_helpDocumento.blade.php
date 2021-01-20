<div class="modal fade" id="ModalHelpDocumento" tabindex="-1" role="dialog" aria-labelledby="ModalHelpDocumento" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalHelpDocumento">Bem-vindo ao cadastro de Documentos!</h5>
      </div>
        <div class="modal-body">
            <p>
                Nesta página você pode cadastrar os documentos, para você poder consultalos posteriormente ou ter controle da situação deles.
            </p>
            <p>
                Caso queira uma <b>Unidade Administrativa</b> ou uma <b>Situação</b> que ainda não tenha, você pode adicionar clicando na aba <b>Cadastro</b>.
            </p>
            <p>
                Você pode adicionar um <b>Atendimento</b> ou uma <b>Resposta</b> ao seu documento, tanto no momento do cadastro, quanto editando ele posteriormente.
            </p>
            <p>Consulte o Manual do Usuário na aba <b>Ajuda</b> para mais informações.</</p>
            <div>
                <input type="checkbox" id="scape" name="scape" checked>
                <label for="scape">Não mostrar esta ajuda novamente.</label>
            </div>
        </div>
        <div class="modal-footer">
          <a id="btn_seguir" href="{{route('usuario.disableHelpDocumento',['id' => Auth::user()->id])}}" type="button" class="btn btn-primary">Prosseguir</a>
        </div>
    </div>
  </div>
</div>
<script>
    $("#btn_seguir").click(function(){
      if($("#scape").is(':checked')){
        //se esta checado vai para rota que permitra não mostrar mais a ajuda
        $('#btn_seguir').attr("href", "{{route('usuario.disableHelpDocumento',['id' => Auth::user()->id])}}")
      }else{
        //caso não esteja checado, continuara aparecendo a ajuda todas vezes
        $('#btn_seguir').attr("href", "#")
        $('#ModalHelpDocumento').modal('hide');
      }
    });

</script>