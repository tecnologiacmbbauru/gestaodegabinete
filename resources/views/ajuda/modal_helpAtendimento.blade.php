<div class="modal fade" id="ModalHelpAtendimento" tabindex="-1" role="dialog" aria-labelledby="ModalHelpAtendimento" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalHelpAtendimento">Bem-vindo ao cadastro de Atendimentos!</h5>
      </div>
        <div class="modal-body">
            <p>
                Nesta página você pode cadastrar os atendimentos feitos para sociedade civil e ter controle em qual estado que eles se encontram.
                <br>
                Caso queira um <b>Tipo de Atendimento</b> ou uma <b>Situação do Atendimento</b> que ainda não tenha, você pode adicionar clicando na aba <b>Cadastro</b>.
            </p>
            <p>
                <b>Atenção:</b>Você só pode usar uma pessoa ja cadastrada. Você pode criar uma pessoa com nome anônimo caso a pessoa não queira se cadastrar.
            </p>
            <p>Consulte o Manual do Usuário na aba <b>Ajuda</b> para mais informações.</</p>
            <div>
                <input type="checkbox" id="scape" name="scape" checked>
                <label for="scape">Não mostrar esta ajuda novamente.</label>
            </div>
        </div>
        <div class="modal-footer">
          <a id="btn_seguir" href="{{route('usuario.disableHelpAtendimento',['id' => Auth::user()->id])}}" type="button" class="btn btn-primary">Prosseguir</a>
        </div>
    </div>
  </div>
</div>
<script>
    $("#btn_seguir").click(function(){
      if($("#scape").is(':checked')){
        //se esta checado vai para rota que permitra não mostrar mais a ajuda
        $('#btn_seguir').attr("href", "{{route('usuario.disableHelpAtendimento',['id' => Auth::user()->id])}}")
      }else{
        //caso não esteja checado, continuara aparecendo a ajuda todas vezes
        $('#btn_seguir').attr("href", "#")
        $('#ModalHelpAtendimento').modal('hide');
      }
    });

</script>