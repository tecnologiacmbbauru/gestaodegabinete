<div class="cadastro">
<h1 class="titulo" style="text-align:center; padding-right:10%;">Cadastro de Documento</h1>

<form  id="form_cadastro_documento" method="post" action={{route('documento.store')}} enctype="multipart/form-data">
    @csrf
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="col-form-label negrito" for="input_tipo_documento">Tipo de Documento</label>
                <select id="GAB_TIPO_DOCUMENTO_cod_tip_doc" class="form-control col-md-11" name="GAB_TIPO_DOCUMENTO_cod_tip_doc" onClick="ocultarAlerta(document.getElementById('alert-tipo'))">
                    <option name="GAB_TIPO_DOCUMENTO_cod_tip_doc" value=""  style="font-style: italic;">Selecione</option>
                    @foreach ($tipoDocumento as $tipoDocumento)
                        <option name="GAB_TIPO_DOCUMENTO_cod_tip_doc" value="{{ $tipoDocumento->cod_tip_doc}}">{{ $tipoDocumento->nom_tip_doc}}</option>
                    @endforeach
                </select> 
                <label id="alert-tipo" class="alert-obrigatorio" hidden="true">* Campo obrigatório</label>
            </div>            
            <div class="form-group col-md-4">
                    <label class="col-md-4 col-form-label negrito" for="nom_documento">Número</label>
                    <input id="nom_documento" type="number" class="form-control col-md-10" name="nom_documento" value="{{old('nom_documento')}}" autofocus  maxlength="50" required>
            </div>
            <div class="form-group col-md-4">
                <label class="col-md-4 col-form-label negrito" for="dat_ano">Ano</label>
                <input id="dat_ano" type="year" class="form-control col-md-9" name="dat_ano" value="{{old('dat_ano')}}" autocomplete="dat_ano"   maxlength="4" required>                         
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="col-form-label negrito">Unidade Administrativa</label>
                <select id="GAB_UNIDADE_DOCUMENTO_cod_uni_doc" class="form-control col-md-11" name="GAB_UNIDADE_DOCUMENTO_cod_uni_doc" onClick="ocultarAlerta(document.getElementById('alert-uni'))"> 
                    <option name="GAB_UNIDADE_DOCUMENTO_cod_uni_doc" value=""  style="font-style: italic;">Selecione</option>
                    @foreach ($unidadeDocumento as $unidadeDocumento)
                        <option name="GAB_UNIDADE_DOCUMENTO_cod_uni_doc" value="{{ $unidadeDocumento->cod_uni_doc}}">{{ $unidadeDocumento->nom_uni_doc}}</option>
                    @endforeach
                </select>      
                <label id="alert-uni" class="alert-obrigatorio" hidden="true">* Campo obrigatório</label>                  
            </div>            
            <div class="form-group col-md-4">
                <label class="col-form-label negrito" for="dat_nascimento">Situação do Documento</label>
                <select id="GAB_STATUS_DOCUMENTO_cod_status" class="form-control col-md-10" name="GAB_STATUS_DOCUMENTO_cod_status"  onClick="ocultarAlerta(document.getElementById('alert-situacao'))"> 
                    <option name="GAB_UNIDADE_DOCUMENTO_cod_uni_doc" value=""  style="font-style: italic;">Selecione</option>
                    @foreach ($situacaoDoc as $situacaoDoc)
                        <option name="GAB_STATUS_DOCUMENTO_cod_status" value="{{ $situacaoDoc->cod_status}}">{{ $situacaoDoc->nom_status}}</option>
                    @endforeach
                </select>      
                <label id="alert-situacao" class="alert-obrigatorio" hidden="true">* Campo obrigatório</label>                      
            </div>
            <div class="form-group col-md-4">
                <label class="col-form-label negrito" for="dat_documento">Data</label>
                <input id="dat_documento" type="date" name="dat_documento" placeholder="" class="form-control input-md datepicker col-md-9" required> 
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6" id="input_documento">
                <label class="col-form-label negrito" for="input_tipo_documento">Documento</label>
                <input type="file" id="path_doc" class="form-control col-md-10 input-arquivo" name="path_doc" onClick="ocultarAlerta(document.getElementById('alert-documento'))">
                <label id="alert-documento" class="alert-obrigatorio" hidden="true">* A extensão do arquivo não é aceita.</label>
            </div>

            <div class="form-group col-md-6" id="link">
                <label class="col-form-label negrito" for="link_doc">Link Documento {{--<img src="{{asset('utils/icone_ajuda.png')}}" title="Caso o documento esteja salvo em algum site você pode inserir o link aqui." style="padding-bottom:6px;">--}}</label>
                <input id="lnk_documento" type="text" class="form-control col-md-10" name="lnk_documento">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-11">
                <label class="col-form-label negrito" for="txt_assunto">Assunto</label>
                <textarea class="form-control" rows="3" id="txt_assunto"  name="txt_assunto"></textarea>
            </div>
        </div>  

        <div class="form-row">
            <div class="form-group col-md-11">
                <div class="form-check form-check-inline" id="div_atend_rel" style="margin-bottom:5px;">
                    <input class="form-check-input" type="checkbox" id="atend_rel" name="atend_rel" onclick="mostraAtendimento(document.getElementById('segunda_secao').hidden)">
                    <label class="form-check-label negrito" for="div_atend_rel">Possui Atendimento Relacionado</label>
                </div>
                <fieldset id="segunda_secao" class="fieldset-personalizado" form="form_cadastro_documento" hidden=true >
                    @include('Utils/form_pesquisa_atendimento')
                </fieldset>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-11">
                <div class="form-check form-check-inline" id="div_resposta" style="margin-bottom:5px;">
                    <input class="form-check-input" type="checkbox" id="resp_rel" name="resp_rel" onclick="mostraResposta(document.getElementById('resposta').hidden)">
                    <label class="form-check-label negrito" for="div_resposta">Possui Resposta</label>
                </div>      
                <div id="resposta" hidden=true>
                    <fieldset id="terceira_secao" class="fieldset-personalizado" form="form_cadastro_documento">
                        <div class="form-row" id="input_nom pessoa">
                            <div class="form-group col-md-6">
                                <label class="col-form-label negrito" for="dat_resposta">Data</label>
                                <input id="dat_resposta" type="date" name="dat_resposta" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-form-label negrito" for="link_doc">Documento de Resposta</label>
                                <input type="file" class="form-control input-arquivo" name="path_doc_resp">
                            </div>
                        </div>                       
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-form-label negrito" for="link_doc">Link Resposta {{--<img src="{{asset('utils/icone_ajuda.png')}}" title="Caso o documento estaja salvado na nuvem ou em algum site você pode inserir o link aqui." >--}}</label>
                                <input id="link_resposta" type="text" class="form-control" name="link_resposta">
                            </div>
                        </div>                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-form-label negrito" for="txt_obs">Detalhes</label>
                                <textarea class="form-control" rows="4" id="txt_resposta"  name="txt_resposta"></textarea>   
                            </div>
                        </div>    
                        <input type="hidden" NAME="ind_status" VALUE="A"> 
                    </fieldset>  
                </div>       
            </div>  
        </div>


        <div class="form-row div-botoes-cadastro">
            <div>   
                <button type="submit" onclick="return cadastrar();" class="btn btn-primary">Cadastrar</button>
                <button id="btn-pesquisa" type="submit"  onclick="pesquisar()" class="btn btn-primary">Pesquisar</button>
                <button id="limpar" type="reset" class="btn btn-primary">Limpar</button>
            </div>
        </div>

        {{--Modal de ajuda--}}
        @include('ajuda/modal_helpDocumento')
</form>
</div>
{{--Script responsavel por mudar os campos requiridos para caso de cadastro, e nenhuma campo requirido para caso de pesquisa--}}
<script type="text/javascript">
    document.getElementById("nom_documento").required=true;
    document.getElementById("dat_ano").required=true;
    document.getElementById("dat_documento").required=true;
    document.getElementById("form_cadastro_documento").action="{{route('documento.store')}}";
    function pesquisar(){
        document.getElementById("nom_documento").required=false;
        document.getElementById("dat_ano").required=false;
        document.getElementById("dat_documento").required=false;
        document.getElementById("form_cadastro_documento").action="{{route('documento.pesquisaDocumento')}}";
    }
</script>
{{--Script responsavel por impedir cadastro com o valor "selecione"| Valor apenas de pesquisa--}}
{{--Tambem valida se o arquivo não é um programa com claro potencial malicioso--}}
<script type="text/javascript" defer>
    function cadastrar(i){
        var e = document.getElementById("GAB_TIPO_DOCUMENTO_cod_tip_doc");
        var tipoDocumento = e.options[e.selectedIndex].value;//change it here

        var e = document.getElementById("GAB_UNIDADE_DOCUMENTO_cod_uni_doc");
        var unidadeDocumento = e.options[e.selectedIndex].value;//change it here

        var e = document.getElementById("GAB_STATUS_DOCUMENTO_cod_status");
        var statusDocumento = e.options[e.selectedIndex].value;//change it here 

        var inputDocumento = document.getElementById("path_doc");
        var nomDoc = inputDocumento.value.split(".");
        var docExtension = "."+nomDoc.pop();
        
        if(tipoDocumento === ""){
            document.getElementById("GAB_TIPO_DOCUMENTO_cod_tip_doc").focus();
            document.getElementById("alert-tipo").hidden=false;
            return false;
        }else if(unidadeDocumento === ""){
            document.getElementById("GAB_UNIDADE_DOCUMENTO_cod_uni_doc").focus();
            document.getElementById("alert-uni").hidden=false;
            return false;
        }else if(statusDocumento === ""){
            document.getElementById("GAB_STATUS_DOCUMENTO_cod_status").focus();
            document.getElementById("alert-situacao").hidden=false;
            return false;
        }else{
            if(docExtension===".exe"||docExtension===".bat"||docExtension===".msi"||docExtension===".com"||docExtension===".cmd"
            ||docExtension===".hta"||docExtension===".scr"||docExtension===".pif"||docExtension===".reg"||docExtension===".js"
            ||docExtension===".vbs"||docExtension===".reg"||docExtension===".wsf"||docExtension===".cpl"||docExtension===".jar"){
                document.getElementById("alert-documento").hidden=false;
                jQuery('html, body').animate({scrollTop: 0}, 300); //Faz a animação da tela subindo até o topo, onde tem a mensagem
                document.getElementById("path_doc").focus;
                return false;
            }else{
                return true;
            }  
        }
    }

    function limpar(){
        document.getElementById("img_pessoa").hidden=true;
    }   

    function ocultarAlerta(element){
        element.hidden=true;
    }
</script>

@if(Auth::user()->ajd_documento==1)
<script type="text/javascript" defer>
    jQuery(document).ready(function(){
        $('#ModalHelpDocumento').modal('show');
    });
</script>
@endif

