<div class="modal fade" id="ModalHelpDocumento" tabindex="-1" role="dialog" aria-labelledby="ModalHelpDocumento" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalHelpDocumento">Bem-vindo ao cadastro de Documentos!</h5>
      </div>
        <div class="modal-body">
            <p>
                Nesta página, você pode cadastrar Documentos relacionados ou não aos Atendimentos já cadastrados no sistema.
            </p>
            <p>
                Caso não exista o <b>Tipo de Documento</b>, a <b>Situação do Documento</b> ou a <b>Unidade Administrativa</b> que você deseja, é possível cadastrar clicando no menu <b>Cadastros</b> -> <b>Tipo de Documento</b>, <b>Situação do Documento</b> e <b>Unidade Administrativa</b>.
            </p>
            <p>
              <b>Atenção:</b>Você pode vincular um <b>Atendimento</b> e uma <b>Resposta</b> ao seu Documento, tanto no momento do cadastro quanto posteriormente.
            </p>
            <p>Para mais informações, consulte o Manual do Usuário no menu <b>Ajuda</b>.</</p>
            <div>
                <input type="checkbox" id="scape" name="scape" checked>
                <label for="scape">Não mostrar novamente.</label>
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