<div class="modal fade" id="ModalAgentePolit" tabindex="-1" role="dialog" aria-labelledby="ModalAgentePolitico" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalAgentePolit">Bem-vindo ao sistema de Gestão de Gabinete!</h5>
      </div>
        <div class="modal-body">
          <p style="text-align: justify;text-justify: inter-word;">Para começar, cadastre o Agente Político.
          <br>
          É bem rápido! Você só precisa colocar o <u><i>nome</i></u>, <i><u>cargo político</u></i> e se desejar uma <u><i>foto de perfil</i></u> e o <u><i>endereço</i></u> do agente político.
          <br>
          Caso não exista o <u><i>cargo politico</i></u> que você deseja, é possível cadastrar um novo clicando na aba <b>Cadastros</b> e depois em <b>Cargo Político</b>.
          <br>
          <p>
          <div>
            <input type="checkbox" id="scape" name="scape"
                  checked>
            <label for="scape">Não mostrar esta ajuda novamente.</label>
          </div>
        </div>
        <div class="modal-footer">{{--data-dismiss="modal"--}}
          {{--<button id="btn_next" class="btn btn-primary" >Prosseguir</button>--}}
          <a id="btn_seguir" type="button" class="btn btn-primary">Prosseguir</a>
        </div>{{--{{route('usuario.disableHelpIni',['id' => Auth::user()->id])}}--}}
    </div>
  </div>
</div>
<script>
    $("#btn_seguir").click(function(){
      if($("#scape").is(':checked')){
        //se esta checado vai para rota que permitra não mostrar mais a ajuda
        $('#btn_seguir').attr("href", "{{route('usuario.disableHelpIni',['id' => Auth::user()->id])}}")
      }else{
        //caso não esteja checado, continuara aparecendo a ajuda todas vezes
        $('#btn_seguir').attr("href", "#")
        $('#ModalAgentePolit').modal('hide');
      }
    });

</script>