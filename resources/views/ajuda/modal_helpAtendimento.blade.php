<div class="modal fade" id="ModalHelpAtendimento" tabindex="-1" role="dialog" aria-labelledby="ModalHelpAtendimento" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalHelpAtendimento">Bem-vindo ao cadastro de Atendimentos!</h5>
      </div>
        <div class="modal-body">
            <p>
                Nesta página, você pode cadastrar Atendimentos para as Pessoas já cadastradas no sistema.
                <br>
                <br>
                Caso não exista o <b>Tipo de Atendimento</b> ou a <b>Situação do Atendimento</b> que você deseja, é possível cadastrar clicando no menu <b>Cadastros</b> -> <b>Tipo de Atendimento</b> e <b>Situação do Atendimento</b>.
          <br>
            </p>
            <p>
                <b>Atenção:</b>Caso não exista a <u><i>Pessoa</i></u> que você deseja incluir o Atendimento, você deve cadastrar clicando no menu <b>Pessoa</b>.
            </p>
            <p>Para mais informações, consulte o Manual do Usuário no menu <b>Ajuda</b>.</</p>
            <div>
                <input type="checkbox" id="scape" name="scape" checked>
                <label for="scape">Não mostrar novamente.</label>
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