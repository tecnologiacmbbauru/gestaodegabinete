<div class="modal fade" id="ModalAgentePolit" tabindex="-1" role="dialog" aria-labelledby="ModalAgentePolitico" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalAgentePolit">Bem-vindo ao sistema de Gestão de Gabinete!</h5>
      </div>
        <div class="modal-body">
          <p style="text-align: justify;text-justify: inter-word;">Para começar, cadastre o Agente Político.
          <br>
          É bem rápido! Você deve informar os <u><i>dados do Agente Político</i></u>, incluir uma <u><i>Foto</i></u> e fornecer o <u><i>endereço do Órgâo</i></u> que ele pertence.
          <br>
          <br>
          Caso não exista o <u><i>Cargo Político</i></u> que você deseja, é possível cadastrar clicando no menu <b>Cadastros</b> -> <b>Cargo Político</b>.
          <br>
          <p>Para mais informações, consulte o Manual do Usuário no menu <b>Ajuda</b>.</</p>
          <p>
          <div>
            <input type="checkbox" id="scape" name="scape"
                  checked>
            <label for="scape">Não mostrar novamente.</label>
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