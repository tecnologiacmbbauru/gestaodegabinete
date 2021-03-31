<div class="cadastro">
    <form id="form_cadastro_atendimento" class="form" method="post" action={{route('atendimento.store')}}>
        @csrf
        <div class="form-row">
            <div class="form-group col-md-2">
                <img src="" alt="Imagem de Municipe" id="img_pessoa" style="max-widht: 100px; max-height: 100px;" hidden="true">               
            </div>
            <div class="form-group col-md-8">
                <h1 class="titulo" style="text-align:center; padding-right:10%; padding-top:2%;">Cadastro de Atendimento</h1>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-6" id="input_nom pessoa">
                <label class="col-form-label negrito" for="input_nom_pessoa">Pessoa</label>
                <i><label class="col-form-label" for="nom_nome"> - Selecione uma pessoa cadastrada</label></i> 
                <input id="pessoa_busca" type="text" class="form-control col-md-10" name="pessoa_busca" autofocus required>
                <input type="text" id='GAB_PESSOA_cod_pessoa' name="GAB_PESSOA_cod_pessoa" hidden="true"  readonly>
            </div>
            <div class="form-group col-md-6">
                <label class=" col-form-label negrito" for="input_nom_pessoa">Data</label> 
                <input id="dat_atendimento" type="date" name="dat_atendimento" class="form-control col-md-10"  required>       
            </div>
        </div>
        {{--Script de busca usando jquery-ui. Não pode se colocado separado pois não funciona a rota--}}
        <script type="text/javascript"> 
            // CSRF Token
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $(document).ready(function(){

                $("#pessoa_busca" ).autocomplete({
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
                                response(data);
                            }
                        });
                    },
                    minLength:2,
                    select: function (event, ui) {
                        $('#pessoa_busca').val(ui.item.nome); // display the selected text //mostra o texto selecionado no input
                        $('#GAB_PESSOA_cod_pessoa').val(ui.item.value); // save selected id to input //salva o id do input
                            
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
                $("#pessoa_busca").on('keyup', function(e) {    //quando uma tecla é apertada
                    if ($('#pessoa_busca').is(':empty')){       //verifica se esta vazio
                        $('#img_pessoa').attr("hidden",true);  //Caso esteja limpa os campos de código e a imagem                            
                        $('#GAB_PESSOA_cod_pessoa').val("");
                    }
                });
            });
        </script>
    
        <div class="form-row">
            <div class="form-group col-md-6" id="div_cod_atendimento">
                <label class="col-form-label negrito" for="input_tipo_atendimento">Tipo de atendimento</label>
                <select id="input_tipo_atendimento" class="form-control col-md-10" name="GAB_TIPO_ATENDIMENTO_cod_tipo" onClick="ocultarAlerta(document.getElementById('alert-tipo'))">
                <option name="GAB_TIPO_ATENDIMENTO_cod_tipo" value="" style="font-style: italic;">{{"Selecione"}}</option>
                    @foreach ($tipoAtendimento as $tipoAtendimento)
                        <option name="GAB_TIPO_ATENDIMENTO_cod_tipo" value="{{ $tipoAtendimento->cod_tipo}}">{{ $tipoAtendimento->nom_tipo}}</option>
                    @endforeach
                </select>
                <label id="alert-tipo" class="alert-obrigatorio" hidden="true">* Campo obrigatório</label>
            </div>
            <div class="form-group col-md-6" id="div_input_status_atendimento">
                <label class="col-form-label negrito" for="input_cod_atendimento">Situação do Atendimento</label>
                <select id="input_cod_status_atendimento" class="form-control col-md-10" name="GAB_STATUS_ATENDIMENTO_cod_status" onClick="ocultarAlerta(document.getElementById('alert-status'))">
                <option name="GAB_STATUS_ATENDIMENTO_cod_status" value="" style="font-style: italic;">{{"Selecione"}}</option>
                    @foreach ($statusAtendimento as $statusAtendimento)
                        <option name="GAB_STATUS_ATENDIMENTO_cod_status" value="{{ $statusAtendimento->cod_status}}">{{ $statusAtendimento->nom_status}}</option>
                    @endforeach
                </select>
                <label id="alert-status" class="alert-obrigatorio" hidden="true">* Campo obrigatório</label>
            </div>
        </div> 

        @include('lembretes/div-cad-lembrete')

        <div class="form-row" id="input_txt_detalhes">
            <div class="form-group col-md-12" id="div_detalhes">
                <label class="col-form-label negrito" for="txt_detalhes">Detalhes</label>
                <textarea class="form-control col-md-11" rows="3" id="txt_detalhes"  name="txt_detalhes"></textarea>
            </div>
        </div>
        <input type="hidden" NAME="ind_status" VALUE="A">

        @include('ajuda/modal_helpAtendimento')

        <div class="form-row div-botoes-cadastro">
            <div>
                <button type="submit" onclick="return cadastrar();" class="btn btn-primary">Cadastrar</button>
                <button id="btn-pesquisa" type="submit"  onclick="pesquisar()" class="btn btn-primary">Pesquisar</button>
                <button type="reset" class="btn btn-primary" onclick="limpar()">Limpar</button>
            </div>      
        </div>
    </form>

    {{--Script responsavel por mudar os campos requiridos para caso de cadastro, e nenhuma campo requirido para caso de pesquisa--}}
    <script type="text/javascript">
        document.getElementById("pessoa_busca").required=true;
        document.getElementById("dat_atendimento").required=true;
        document.getElementById("form_cadastro_atendimento").action="{{route('atendimento.store')}}";
        function pesquisar(){
            document.getElementById("pessoa_busca").required=false;
            document.getElementById("dat_atendimento").required=false;
            document.getElementById("form_cadastro_atendimento").action="{{route('atendimento.pesquisaAtendimento')}}";
        }
    </script>

    {{--Script responsavel por impedir o cadastro com o campo "Selecione um categoria" --}}
    <script type="text/javascript" defer>
        function cadastrar(){
            var e = document.getElementById("input_tipo_atendimento");
            var tipoAtendimento = e.options[e.selectedIndex].value;//change it here

            var e = document.getElementById("input_cod_status_atendimento");
            var statusAtendimento = e.options[e.selectedIndex].value;//change it here

            if(tipoAtendimento === ""){
                document.getElementById("input_tipo_atendimento").focus();
                document.getElementById("alert-tipo").hidden=false;
                return false;
            }else if(statusAtendimento=== ""){
                document.getElementById("input_cod_status_atendimento").focus();
                document.getElementById("alert-status").hidden=false;
                return false;
            }else{
                return true;
            }
        }
        function limpar(){
            document.getElementById("img_pessoa").hidden=true;
        }  

        function ocultarAlerta(element){
            element.hidden=true;
        }
    </script>
</div>

{{--Verifica se é primeira vez que o Usuario entra e mostra a ajuda--}}
@if(Auth::user()->ajd_atendimento==1)
    <script type="text/javascript" defer>
        jQuery(document).ready(function(){
            $('#ModalHelpAtendimento').modal('show');
        });
    </script>
@endif
