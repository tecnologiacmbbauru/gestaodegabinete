<div class="modal fade" id="ModalHelpPessoa" tabindex="-1" role="dialog" aria-labelledby="ModalHelpPessoa" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalHelpPessoa">Bem-vindo ao cadastro de Pessoas!</h5>
      </div>
        <div class="modal-body">
            <p>
                Nesta página você pode cadastrar pessoas, fisicas ou juridicas, para realizar atendimentos e gerar relatórios e ser informado sobre seus aniversários.
            </p>
            <p>
                <b>Pesquisa:</b>Você pode realizar pesquisas para consultar os dados das pessoas cadastradas preenchendo qualquer campo e clicando em pesquisar. Se nenhum campo for preenchido, a pesquisa retornara todas pessoas cadastradas.<br>
                Depois de fazer a busca você pode gerar relatórios ou planilha no excel com o resultado destas buscas.
            </p>
            <p>
                <b>Atenção:</b>Você pode realizar um <u>cadastro de forma rápida</u> apenas preenchendo o <b>Nome</b> e clicando em <b>cadastrar</b>.
                <br>
                Os demais campos são opicionais, mas lembre-se que o endereço é importante para gerar relatórios personalizados!
            </p>
            <p>Consulte o Manual do Usuário na aba <b>Ajuda</b> para mais informações.</</p>
            <div>
                <input type="checkbox" id="scape" name="scape" checked>
                <label for="scape">Não mostrar esta ajuda novamente.</label>
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