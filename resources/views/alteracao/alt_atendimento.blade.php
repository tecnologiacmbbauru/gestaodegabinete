<div class="cadastro">
    <form class="form" method="post" action={{route('atendimento.update', $atendimentoC->cod_atendimento)}}>
        @method("PUT")
        {{ csrf_field() }}

        <div class="form-row">
            <div class="form-group col-md-2">
                @if($atendimentoC->GAB_PESSOA_cod_pessoa!=null)
                <img alt="Imagem de Municipe" id="img_pessoa" style="max-widht: 150px; max-height: 100px;" 
                                                                                                        @if($atendimentoC->pessoa->image!=null)
                                                                                                            src="{{asset("storage/{$atendimentoC->pessoa->image}")}}">
                                                                                                        @else
                                                                                                            src="{{asset("utils/sem-imagem.jpg")}}">
                                                                                                        @endif
                @endif               
            </div>
            <div class="form-group col-md-8">
                <h1 class="titulo" style="text-align:center; padding-right:10%; padding-top:2%;">Alteração de Atendimento</h1>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6" id="input_nom pessoa">
                <label class="col-form-label negrito" for="input_nom_pessoa">Pessoa</label>
                <input id="pessoa_busca" type="text" class="form-control col-md-10" name="pessoa_busca" @if($atendimentoC->GAB_PESSOA_cod_pessoa!=null)
                                                                                                            value="{{$atendimentoC->pessoa->nom_nome}}"
                                                                                                        @elseif($atendimentoC->pessoa->ind_status!="A")
                                                                                                            Não existe pessoa relacionada 
                                                                                                        @else
                                                                                                            value="Não existe pessoa relacionada"
                                                                                                        @endif >
                <input type="text" id='GAB_PESSOA_cod_pessoa' name="GAB_PESSOA_cod_pessoa" value="{{$atendimentoC->GAB_PESSOA_cod_pessoa}}" hidden="true" readonly>
            </div>
            <div class="form-group col-md-6" id="input_dat_atendimento">
                <label class="col-form-label negrito" for="input_nom_pessoa">Data</label>
                <input id="dat_atendimento" type="date" name="dat_atendimento" class="form-control col-md-10" value="{{$dataFormatada}}" autofocus >   
            </div>
        </div>
        {{--Script de busca usando jquery-ui. Não pode se colocado separado pois não funciona a rota--}}
        <script type="text/javascript" >
                // CSRF Token
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $(document).ready(function(){
                //var param = $(this).val();
                //if(param.length <= 3){
                $( "#pessoa_busca" ).autocomplete({
                    source: function( request, response ) {
                    // Fetch data
                    $.ajax({
                        url:"{{route('atendimento.seleciona_pessoa')}}",
                        type: 'post',
                        dataType: "json",
                        data: {
                        _token: CSRF_TOKEN,
                        search: request.term
                        },
                        success: function( data ) {
                            response( data );
                        }
                    });
                    },
                    minLength:2,
                    select: function (event, ui) {
                        $('#pessoa_busca').val(ui.item.nome); // display the selected text

                        $('#GAB_PESSOA_cod_pessoa').val(ui.item.value); // save selected id to input
                        
                        if (ui.item.path_imagem!=null){
                            $('#img_pessoa').attr("src","storage/"+ui.item.path_imagem);
                            $('#img_pessoa').attr("hidden",false);
                        }else{
                            $('#img_pessoa').attr("src","{{asset('utils/sem-imagem.jpg')}}");
                            $('#img_pessoa').attr("hidden",false);
                        }
                        return false;
                    }
                });

                });
        </script> 

        <div class="form-row" id="input_cod_atendimento">
            <div class="form-group col-md-6">
                <label class="col-form-label negrito" for="input_cod_atendimento">Tipo de atendimento</label>
                    <select id="input_cod_atendimento" class="form-control col-md-10" name="GAB_TIPO_ATENDIMENTO_cod_tipo">
                        @foreach ($tipoAtendimento as $tipoAtendimento)
                            <option name="GAB_TIPO_ATENDIMENTO_cod_tipo" value="{{$tipoAtendimento->cod_tipo}}" @if($tipoAtendimento->cod_tipo==$atendimentoC->GAB_TIPO_ATENDIMENTO_cod_tipo) selected @endif>{{$tipoAtendimento->nom_tipo}}</option>
                        @endforeach
                    </select>
            </div>
            <div class="form-group col-md-6">
                <label class="col-form-label negrito" for="input_cod_atendimento">Situação do Atendimento</label>
                    <select id="input_cod_atendimento" class="form-control col-md-10" name="GAB_STATUS_ATENDIMENTO_cod_status">
                        @foreach ($statusAtendimento as $statusAtendimento)
                            <option name="GAB_STATUS_ATENDIMENTO_cod_status" value="{{ $statusAtendimento->cod_status}}"  @if($statusAtendimento->cod_status==$atendimentoC->GAB_STATUS_ATENDIMENTO_cod_status) selected @endif>{{$statusAtendimento->nom_status}}</option>
                        @endforeach
                    </select>
            </div>
        </div>
        
        {{---Lembrete--}}
        @if($atendimentoC->lembrete===1)
            <div class="form-row">
                <div class="form-group col-md-11">
                    <fieldset id="fieldset_lembrete" class="fieldset-personalizado">
                        <div class="pull-right">
                            <a type="button" data-toggle="modal" data-target="#ModalAuxiliarDocumento" onclick="populaModal('lembrete')" style="float: right">
                                <img src="{{asset('utils/excluir.png')}}" style="float: right" alt="excluir lembrete" title="Excluir Lembrete">
                            </a>
                        </div>
                        <div class="form-inline" style="margin-bottom:5px;" >
                            <label for="lembrar_dias" class="col-form-label negrito">Lembrete em</label><input class="input-lembrar" id="dat_lembrete" name="dat_lembrete" type="date" value="{{$atendimentoC->dat_lembrete}}" style="margin-left:5px; margin-right:5px;">
                        </div>
                    </fieldset>
                </div>
            </div>
        @else  
            <div class="form-row" id="div_dat_lembrete_vazia">
                <div class="form-group col-md-11">
                    <fieldset id="fieldset_lembrete" class="fieldset-personalizado">
                    <div class="form-check form-check-inline" id="div_lembrar">
                        <input class="form-check-input" type="checkbox" id="lembrete" name="lembrete" onclick="mostraLembrete(document.getElementById('div_dat_lembrete').hidden)">
                        <label class="form-check-label negrito" for="div_lembrar">Adicionar Lembrete</label>
                    </div>
                    <div>
                        <div class="form-inline" style="margin-bottom:5px;" id="div_dat_lembrete" hidden>
                            <input type="hidden" id="lembrete" NAME="lembrete" VALUE="0">
                            <label for="lembrar_dias" class="col-form-label negrito">Me lembre em</label><input class="input-lembrar" id="dat_lembrete" name="dat_lembrete" type="date" value="{{$atendimentoC->dat_lembrete}}" style="margin-left:5px; margin-right:5px;">
                        </div>
                    </div>
                    </fieldset>
                </div>
            </div>
        @endif

        @include('Utils/modal_alterarDocumento')

        <div class="form-row" id="input_txt_detalhes">
            <div class="form-group col-md-12">
                <label class="col-form-label negrito" for="txt_detalhes">Detalhes</label>
                <textarea class="form-control col-md-11" rows="5" id="txt_detalhes"  name="txt_detalhes">{{$atendimentoC->txt_detalhes}}</textarea>
            <div>
        </div>
        <input type="hidden" NAME="ind_status" VALUE="A">
        <input type="hidden" id="excluir_lembrete" NAME="excluir_lembrete" VALUE="">

        <div class="form-row div-botoes-cadastro" style="margin-top:20px;">
            <div>           
                <button type="submit" class="btn btn-primary alterar">Alterar</button>
                <a href="javascript:history.back()" class="btn btn-primary alterar">Voltar</a>
            </div>
        </div>
    </form>
</div>

<script>
    function populaModal(acao){
      if(acao=="lembrete"){
          document.getElementById("modal-title").innerHTML = "Deseja excluir este lembrete?";
      }
      document.getElementById("acao").value = acao;
    }
  </script>

  {{--Script responsavel por mudar os campos requiridos para caso de cadastro, e nenhuma campo requirido para caso de pesquisa--}}
<script type="text/javascript">
    function mostraLembrete(){
        document.getElementById('div_dat_lembrete').hidden = !document.getElementById('div_dat_lembrete').hidden;
    }
</script>