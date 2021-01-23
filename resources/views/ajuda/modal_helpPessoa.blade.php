<div class="modal fade" id="ModalHelpPessoa" tabindex="-1" role="dialog" aria-labelledby="ModalHelpPessoa" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalHelpPessoa">Bem-vindo ao cadastro de Pessoas!</h5>
      </div>
        <div class="modal-body">
            <p>
                Nesta página, você pode cadastrar Pessoas, <u>Físicas e Jurídicas</u>, informando seus respectivos dados e fotos.
                Após ter cadastrado Pessoas, é possível registrar Atendimentos e Documentos, gerar relatórios e planilhas, imprimir etiquetas, ser notificado sobre Aniversários, entre outros.
            </p>
            <p>
                Você pode pesquisar as Pessoas cadastradas e exportar os dados consultados para relatórios ou planilhas.
            </p>
            <p>
                <b>Atenção:</b>Você pode realizar um <u>cadastro de forma rápida</u> apenas preenchendo o <b>Nome</b> da Pessoa. Mas lembre-se que o preenchimento de todos os dados de uma Pessoa é importante para ajudar nas pesquisas, além da geração de relatórios e notificações de Aniversários!
            </p>
            <p>Para mais informações, consulte o Manual do Usuário no menu <b>Ajuda</b>.</</p>
            <div>
                <input type="checkbox" id="scape" name="scape" checked>
                <label for="scape">Não mostrar novamente.</label>
            </div>
        </div>
        <div class="modal-footer">
          <a id="btn_seguir" href="{{route('usuario.disableHelpPessoa',['id' => Auth::user()->id])}}" type="button" class="btn btn-primary">Prosseguir</a>
        </div>
    </div>
  </div>
</div>
<script>
    $("#btn_seguir").click(function(){
      if($("#scape").is(':checked')){
        //se esta checado vai para rota que permitra não mostrar mais a ajuda
        $('#btn_seguir').attr("href", "{{route('usuario.disableHelpPessoa',['id' => Auth::user()->id])}}")
      }else{
        //caso não esteja checado, continuara aparecendo a ajuda todas vezes
        $('#btn_seguir').attr("href", "#")
        $('#ModalHelpPessoa').modal('hide');
      }
    });

</script>