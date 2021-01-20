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
                                                                                                            src="{{asset("storage/padrao/padrao.jpg")}}">
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
                    select: function (event, ui) {
                        $('#pessoa_busca').val(ui.item.nome); // display the selected text

                        $('#GAB_PESSOA_cod_pessoa').val(ui.item.value); // save selected id to input
                        
                        if (ui.item.path_imagem!=null){
                            $('#img_pessoa').attr("src","../../storage/"+ui.item.path_imagem);
                            $('#img_pessoa').attr("hidden",false);
                        }else{
                            $('#img_pessoa').attr("src","../../storage/padrao/padrao.jpg");
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
                            <option name="GAB_TIPO_ATENDIMENTO_cod_tipo" value="{{$tipoAtendimento->cod_tipo}}" @if($tipoAtendimento->cod_tipo==$atendimentoC->GAB_TIPO_DOCUMENTO_cod_tip_doc) selected @endif>{{$tipoAtendimento->nom_tipo}}</option>
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
        
        <div class="form-row" id="input_txt_detalhes">
            <div class="form-group col-md-12">
                <label class="col-form-label negrito" for="txt_detalhes">Detalhes</label>
                <textarea class="form-control col-md-11" rows="5" id="txt_detalhes"  name="txt_detalhes">{{$atendimentoC->txt_detalhes}}</textarea>
            <div>
        </div>
        <input type="hidden" NAME="ind_status" VALUE="A">

        <div class="form-row div-botoes-cadastro" style="margin-top:20px;">
            <div>           
                <button type="submit" class="btn btn-primary alterar">Alterar</button>
                <a href="javascript:history.back()" class="btn btn-primary alterar">Voltar</a>
            </div>
        </div>
        
    </form>
</div>