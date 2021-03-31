<div class="cadastro">
<h1 class="titulo" style="text-align:center; padding-right:10%;">Alteração de Documento</h1>
<form id="altera_documento" class="form" method="post" action={{route('documento.update',$docC->cod_documento)}} enctype="multipart/form-data">
    @method("PUT")
    @csrf

    <div class="form-row">
        <div class="form-group col-md-4">
            <label class="col-form-label negrito" for="input_tipo_documento">Tipo de Documento</label>
            <select id="input_cod_atendimento" class="form-control col-md-11" name="GAB_TIPO_DOCUMENTO_cod_tip_doc">
                <option name="" value="" selected>Selecione</option>
                @foreach ($tipoDocumento as $tipoDocumento)
                    <option name="GAB_TIPO_DOCUMENTO_cod_tip_doc" value="{{ $tipoDocumento->cod_tip_doc}}" @if($tipoDocumento->cod_tip_doc==$docC->GAB_TIPO_DOCUMENTO_cod_tip_doc) selected @endif>{{ $tipoDocumento->nom_tip_doc}}</option>
                @endforeach
            </select> 
        </div>            
        <div class="form-group col-md-4">
            <label class="col-form-label negrito" for="nom_documento">Número</label>
            <input id="nom_documento" type="text" class="form-control col-md-10" name="nom_documento" value="{{$docC->nom_documento}}"  autocomplete="nom_documento" autofocus  maxlength="50" required>
        </div>
        <div class="form-group col-md-4">
            <label class="col-form-label negrito" for="dat_ano">Ano</label>
            <input id="dat_ano" type="year" class="form-control col-md-9" name="dat_ano" value="{{$docC->dat_ano}}"  autocomplete="dat_ano"  maxlength="4" required>                       
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-4">
            <label class="col-form-label negrito">Unidade Administrativa</label>
             <select id="input_cod_atendimento" class="form-control col-md-11" name="GAB_UNIDADE_DOCUMENTO_cod_uni_doc">
                <option name="" value="" selected>Selecione</option>
                @foreach ($unidadeDocumento as $unidadeDocumento)
                    <option name="GAB_UNIDADE_DOCUMENTO_cod_uni_doc" value="{{ $unidadeDocumento->cod_uni_doc}}" @if($unidadeDocumento->cod_uni_doc==$docC->GAB_UNIDADE_DOCUMENTO_cod_uni_doc) selected @endif>{{ $unidadeDocumento->nom_uni_doc}}</option>
                @endforeach
            </select>                   
        </div>            
        <div class="form-group col-md-4">
            <label class="col-form-label negrito">Situação do Documento</label>
            <select id="input_cod_status" class="form-control col-md-10" name="GAB_STATUS_DOCUMENTO_cod_status">
                <option name="" value="" selected>Selecione</option>
                @foreach ($situacaoDoc as $situacaoDoc)
                    <option name="GAB_STATUS_DOCUMENTO_cod_status" value="{{ $situacaoDoc->cod_status}}" @if($situacaoDoc->cod_status==$docC->GAB_STATUS_DOCUMENTO_cod_status) selected @endif >{{ $situacaoDoc->nom_status}}</option>
                @endforeach
            </select>                             
        </div>
        <div class="form-group col-md-4">
                <label class="col-form-label negrito" for="dat_documento">Data</label>
                <input id="dat_documento" type="date" name="dat_documento" value="{{$docC->dat_documento}}" class="form-control input-md datepicker col-md-9"  required>
        </div>
    </div>

   <div class="form-row">
        <div class="form-group col-md-6">
            @if($docC->path_doc!=null)
                <label class="col-form-label negrito">Baixar documento: </label>  <strong><a class="link-documento" href="{{asset("storage/{$docC->path_doc}")}}" download="{{$docC->tipoDocumento->nom_tip_doc}}-{{$docC->nom_documento}}-{{$docC->dat_ano}}">{{$docC->tipoDocumento->nom_tip_doc}}-{{$docC->nom_documento}}-{{$docC->dat_ano}}</a></strong>
                <br>
                <input class="form-check-input" type="checkbox" id="altera_doc" name="altera_doc" onclick="mostraAlteraDoc()" style="margin-left:3px;">
                <label class="form-check-label negrito" style="margin-left:25px;">Substituir Documento</label>   
                <input id="path_doc" type="file" class="form-control col-md-10 input-arquivo" name="path_doc" id="path_doc" hidden="true"> 
                <label id="alert-documento" class="alert-obrigatorio" hidden="true">* A extensão do arquivo não é aceita.</label>
                <label id="alert-doc-tamanho" class="alert-obrigatorio" hidden="true">* O tamanho máximo de arquivo aceito é 25mb.</label>            
            @else
                <label class="col-form-label negrito" for="input_tipo_documento">Documento</label>
                <input type="file" class="form-control col-md-10 input-arquivo" name="path_doc" id="path_doc" autofocus >
                <label id="alert-documento" class="alert-obrigatorio" hidden="true">* A extensão do arquivo não é aceita.</label>
                <label id="alert-doc-tamanho" class="alert-obrigatorio" hidden="true">* O tamanho máximo de arquivo aceito é 25mb.</label>
            @endif
        </div>
        <div class="form-group col-md-6">
            @if($docC->lnk_documento!=null)
                <label class="col-form-label negrito">Link:</label><strong><a class="link-documento" href="{{url('//' . (strpos($docC->lnk_documento, '//') !== false ? substr($docC->lnk_documento, strpos($docC->lnk_documento, '//') + 2) : ltrim($docC->lnk_documento, '/')))}}" target="_blank">{{$docC->lnk_documento}}</a></strong>
                <br>   
                <input class="form-check-input" type="checkbox" id="altera_link" name="altera_link" onclick="mostraAlteraLink()" style="margin-left:3px;">
                <label class="form-check-label negrito" for="altera_link" style="margin-left:25px;">Link Documento</label>
                <input id="lnk_documento" name="lnk_documento" type="text" class="form-control col-md-10" hidden="true" autofocus >       
            @else
                <label class="col-form-label negrito" for="input_tipo_documento">Link Documento</label>
                <input id="lnk_documento" type="text" class="form-control col-md-10" name="lnk_documento">
            @endif
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-11">
            <label class="col-form-label negrito" for="txt_assunto">Assunto</label>
            <textarea class="form-control" rows="3" id="txt_assunto"  name="txt_assunto">{{$docC->txt_assunto}}</textarea>
        </div>
    </div> 

    {{---Lembrete--}}
    @if($docC->lembrete===1)
        <div class="form-row">
            <div class="form-group col-md-11">
                <fieldset id="fieldset_lembrete" class="fieldset-personalizado">
                    <div class="pull-right">
                        <a type="button" data-toggle="modal" data-target="#ModalAuxiliarDocumento" onclick="populaModal('lembrete')" style="float: right">
                            <img src="{{asset('utils/excluir.png')}}" style="float: right" alt="excluir lembrete" title="Excluir Lembrete">
                        </a>
                    </div>
                    <div class="form-inline" style="margin-bottom:5px;" >
                        <label for="lembrar_dias" class="col-form-label negrito">Lembrete em</label><input class="input-lembrar" id="dat_lembrete" name="dat_lembrete" type="date" value="{{$docC->dat_lembrete}}" style="margin-left:5px; margin-right:5px;">
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
                        <label for="lembrar_dias" class="col-form-label negrito">Me lembre em</label><input class="input-lembrar" id="dat_lembrete" name="dat_lembrete" type="date" value="{{$docC->dat_lembrete}}" style="margin-left:5px; margin-right:5px;">
                    </div>
                </div>
                </fieldset>
            </div>
        </div>
    @endif

    <div class="form-row">
        <div class="form-group col-md-11">
            @if($docC->GAB_ATENDIMENTO_cod_atendimento!=null)
                <fieldset id="segunda_secao" class="fieldset-personalizado" form="altera_documento">
                    <div class="pull-right">
                        <a type="button" data-toggle="modal" data-target="#ModalAuxiliarDocumento" onclick="populaModal('atendimento')" style="float: right">
                            <img src="{{asset('utils/unlink.png')}}" style="float: right" alt="Desvincular Atendimento" title="Desvincular Atendimento">
                        </a>
                    </div>
                    <h5 class="negrito">Atendimento Relacionado</h5>
                    <div class=form-group id="form_cad_resultado_alteracao">
                        <label style="font-weight: bolder">Data:</label> <label>{{date('d/m/Y', strtotime($docC->antedimentoRelacionado->dat_atendimento))}}</label>
                        <br>
                        <label style="font-weight: bolder">Pessoa:</label> <label>{{$docC->antedimentoRelacionado->pessoa->nom_nome}}</label>
                        <br>
                        <label style="font-weight: bolder">Doc.Identificação:</label> <label>{{$docC->antedimentoRelacionado->pessoa->cod_cpf_cnpj}}</label>
                        <br>
                        <label style="font-weight: bolder">Tipo:</label> <label>{{$docC->antedimentoRelacionado->tipoAtendimento->nom_tipo}}</label>
                        <br>
                        <label style="font-weight: bolder">Situação:</label> <label>{{$docC->antedimentoRelacionado->statusAtendimento->nom_status}}</label>                     
                    </div>
                    <input class="form-check-input" type="checkbox" id="adicionaAtendimento" onclick="alterarPesquisaAtendimento()" style="margin-left:3px;">
                    <label class="form-check-label negrito" style="margin-left:25px;">Alterar Atendimento</label> 
                    <div id="pesquisaAtendimento" name="pesquisaAtendimento" style="display:none;">
                            @include('Utils/form_pesquisa_atendimento')
                    </div>              
                </fieldset>
            @else
                <fieldset id="segunda_secao" class="fieldset-personalizado" form="altera_documento">
                    <input class="form-check-input" type="checkbox" id="adicionaAtendimento" onclick="mostraPesquisaAtendimento()" style="margin-left:3px;">
                    <label class="form-check-label negrito" style="margin-left:25px; margin-bottom:5px;">Adicionar Atendimento</label> 
                    <div id="pesquisaAtendimento" name="pesquisaAtendimento" style="display:none;">
                        @include('Utils/form_pesquisa_atendimento')
                    </div> 
                </fieldset>          
            @endif
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-11">
            <fieldset id="terceira_secao" class="fieldset-personalizado" form="form_cadastro_documento">
            @if($docC->dat_resposta!=null)
                    <div class="pull-right">
                        <a type="button" data-toggle="modal" data-target="#ModalAuxiliarDocumento" onclick="populaModal('resposta')" style="float: right">
                            <img src="{{asset('utils/excluir.png')}}" style="float: right" alt="Excluir Resposta" title="Excluir Resposta">
                        </a>
                    </div>
                    <h5 class="negrito">Resposta do Documento</h5>
                    <div class="form-row" id="input_nom pessoa">
                        <div class="form-group col-md-6">
                            <label class="col-form-label negrito" for="dat_resposta">Data</label>
                            <input id="dat_resposta" type="date" name="dat_resposta" value="{{$docC->dat_resposta}}" class="form-control input-md datepicker">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            @if($docC->path_doc_resp!=null)
                                <label class="col-form-label negrito">Baixar documento: </label> <strong><a class="link-documento" href="{{asset("storage/{$docC->path_doc_resp}")}}" download="Documento-Resposta">{{"Resposta"}}-{{$docC->tipoDocumento->nom_tip_doc}}-{{$docC->nom_documento}}-{{$docC->dat_ano}}</a></strong>
                                <br>
                                <input class="form-check-input" type="checkbox" id="altera_doc_resp" name="altera_doc_resp" onclick="mostraAlteraDocResp()" style="margin-left:3px;">
                                <label class="form-check-label negrito" style="margin-left:25px;">Substituir Documento de Resposta</label>   
                                <input id="path_doc_resp" type="file" class="form-control col-md-10 input-arquivo" name="path_doc_resp" hidden>                                 
                            @else
                                <label class="col-form-label negrito" for="path_doc_resp">Documento de Resposta</label>
                                <input type="file" class="form-control input-arquivo" name="path_doc_resp" id="path_doc_resp">
                                <label id="alert-documento-resp" class="alert-obrigatorio" hidden="true">* A extensão do arquivo não é aceita.</label>
                                <label id="alert-doc-resp-tamanho" class="alert-obrigatorio" hidden="true">* O tamanho máximo de arquivo aceito é 25mb.</label>                                
                            @endif
                            
                        </div>
                    </div>                       
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            @if($docC->link_resposta!=null)
                                <label class="col-form-label negrito">Link: </label><strong> <a class="link-documento" href="{{url('//' . (strpos($docC->link_resposta, '//') !== false ? substr($docC->link_resposta, strpos($docC->link_resposta, '//') + 2) : ltrim($docC->link_resposta, '/')))}}" target="_blank">{{$docC->link_resposta}}</a></strong>
                                <br>   
                                <input class="form-check-input" type="checkbox" id="altera_link_resp" id="altera_link_resp" onclick="subsLinkResp()" style="margin-left:3px;">
                                <label class="form-check-label negrito" for="altera_link" style="margin-left:25px;">Substituir link de resposta</label>
                                <input id="link_resposta" name="link_resposta" type="text" class="form-control col-md-10" hidden="true" autofocus >       
                            @else
                                <label class="col-form-label negrito" for="link_doc">Link Resposta {{--<img src="{{url("utils/icone_ajuda.png")}}" title="Caso o documento estaja salvado na nuvem ou em algum site você pode inserir o link aqui." >--}}</label>
                                <input id="link_resposta" type="text" class="form-control" name="link_resposta" >
                            @endif
                        </div>
                    </div>                        
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label negrito" for="txt_obs">Detalhes</label>
                            <textarea class="form-control" rows="3" id="txt_resposta"  name="txt_resposta">{{$docC->txt_resposta}}</textarea>  
                        </div>
                    </div>    
                    <input type="hidden" NAME="ind_status" VALUE="A">                   
            @else
                <div class="form-check form-check-inline" id="div_resposta" style="margin-bottom:5px;">
                    <input class="form-check-input" type="checkbox" id="resp_rel" name="resp_rel" onclick="mostraResposta(document.getElementById('resposta').hidden)">
                    <label class="form-check-label negrito">Adicionar Resposta</label>
                </div>      
                <div id="resposta" hidden=true>
                        <div class="form-row" id="input_nom pessoa">
                            <div class="form-group col-md-6">
                                <label class="col-form-label negrito" for="dat_resposta">Data</label>
                                <input id="dat_resposta" type="date" name="dat_resposta" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-form-label negrito" for="link_doc">Documento de Resposta</label>
                                <input type="file" class="form-control input-arquivo" name="path_doc_resp" id="path_doc_resp">
                                <label id="alert-documento-resp" class="alert-obrigatorio" hidden="true">* A extensão do arquivo não é aceita.</label>
                                <label id="alert-doc-resp-tamanho" class="alert-obrigatorio" hidden="true">* O tamanho máximo de arquivo aceito é 25mb.</label>
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
                </div>     
            </fieldset>  
            @endif
        </div>
    </div>

    {{--INPUTS QUE CONTROLAM SE EXCLUIU OU NÃO OS ATENDIMENTOS/LEMBRETE/RESPOSTA RELACIONADOS--}}
    <input type="hidden" NAME="ind_status" VALUE="A"> 
    <input type="hidden" id="GAB_ATENDIMENTO_cod_atendimento" NAME="GAB_ATENDIMENTO_cod_atendimento" VALUE="{{$docC->GAB_ATENDIMENTO_cod_atendimento}}">
    <input type="hidden" id="excluir_lembrete" NAME="excluir_lembrete" VALUE="">
    <input type="hidden" id="excluir_resposta" NAME="excluir_resposta" VALUE="">

    @include('Utils/modal_alterarDocumento')

    <div class="form-row div-botoes-cadastro">
        <div>           
            <button id="btn-alterar" type="submit" class="btn btn-primary alterar">Alterar</button>
            <a href="javascript:history.back()" class="btn btn-primary alterar">Voltar</a>
        </div>
    </div>

</form>
</div>

<!--Scripts para mostrar divs ocultas como substituir documentos-->
<script  type="text/javascript">
    var checkAD = true;
    var checkAl = true;
    var hiddenDocResp = true;
    hiddenLinkReps = true;
    var checkAddAtendimento = true;
    var checkAltAtendimento = true;

    function mostraAlteraDoc(){
        if(checkAD==true) {
            document.getElementById("path_doc").hidden=false;
            checkAD=false;
        }else{
            document.getElementById("path_doc").hidden=true;
            checkAD=true;
        }
    }

    function mostraAlteraDocResp(){
        if(hiddenDocResp==true) {
            document.getElementById("path_doc_resp").hidden=false;
            hiddenDocResp=false;
        }else{
            document.getElementById("path_doc_resp").hidden=true;
            hiddenDocResp=true;
        }
    }

    function subsLinkResp(){
        if(hiddenLinkReps==true) {
            document.getElementById("link_resposta").hidden=false;
            hiddenLinkReps=false;
        }else{
            document.getElementById("link_resposta").hidden=true;
            hiddenLinkReps=true;
        }
    }
        
    function mostraAlteraLink(){
         if(checkAl==true) {
            document.getElementById("lnk_documento").hidden=false;
            checkAl=false;
        }else{
            document.getElementById("lnk_documento").hidden=true;
            checkAl=true;
        }
    }
    function mostraPesquisaAtendimento(){
        if(checkAddAtendimento==true){
            $("#pesquisaAtendimento").css("display", "block"); 
            checkAddAtendimento=false;
        }else{
            $("#pesquisaAtendimento").css("display", "none"); 
            checkAddAtendimento=true;            
        }
    }

    function alterarPesquisaAtendimento(){
        if(checkAltAtendimento==true){
            $("#form_cad_resultado_alteracao").css("display", "none"); 
            $("#pesquisaAtendimento").css("display", "block");
            checkAltAtendimento=false;
        }else{
            $("#form_cad_resultado_alteracao").css("display", "block");
            $("#pesquisaAtendimento").css("display", "none"); 
            checkAltAtendimento=true;            
        }
    }
    
</script>

<!--Validações do front end para cadastro de arquivos-->
<script>
    //Validação do input de documento
    $('#path_doc').bind('change', function() {
        $("#btn-alterar").attr("disabled", false);//primeiro ativa o botão cadastrar caso estivesse desativado
        document.getElementById("alert-documento").hidden=true;//e esconde as mensagens de erro
        document.getElementById("alert-doc-tamanho").hidden=true; 

        if((this.files[0].size/1024/1024)>25){//valida se o tamanho é valido
            document.getElementById("path_doc").focus;
            document.getElementById("alert-doc-tamanho").hidden=false; 
            $("#btn-alterar").attr("disabled", true);
        }else{ //valida se a extensão é valida
            var inputDocumento = document.getElementById("path_doc");
            var nomDoc = inputDocumento.value.split(".");
            var docExtension = "."+nomDoc.pop();
            if(docExtension===".exe"||docExtension===".bat"||docExtension===".msi"||docExtension===".com"||docExtension===".cmd"
            ||docExtension===".hta"||docExtension===".scr"||docExtension===".pif"||docExtension===".reg"||docExtension===".js"
            ||docExtension===".vbs"||docExtension===".reg"||docExtension===".wsf"||docExtension===".cpl"||docExtension===".jar"){
                document.getElementById("alert-documento").hidden=false;
                document.getElementById("path_doc").focus;
                $("#btn-alterar").attr("disabled", true);
            }
        }
    });

    $('#path_doc_resp').bind('change', function() {
        $("#btn-alterar").attr("disabled", false);//primeiro ativa o botão cadastrar caso estivesse desativado
        document.getElementById("alert-documento-resp").hidden=true;//e esconde as mensagens de erro
        document.getElementById("alert-doc-resp-tamanho").hidden=true; 

        if((this.files[0].size/1024/1024)>25){
            document.getElementById("path_doc_resp").focus;
            document.getElementById("alert-doc-resp-tamanho").hidden=false; 
            $("#btn-alterar").attr("disabled", true);
        }else{ //valida se a extensão é valida
            var inputDocumento = document.getElementById("path_doc_resp");
            var nomDoc = inputDocumento.value.split(".");
            var docExtension = "."+nomDoc.pop();
            if(docExtension===".exe"||docExtension===".bat"||docExtension===".msi"||docExtension===".com"||docExtension===".cmd"
            ||docExtension===".hta"||docExtension===".scr"||docExtension===".pif"||docExtension===".reg"||docExtension===".js"
            ||docExtension===".vbs"||docExtension===".reg"||docExtension===".wsf"||docExtension===".cpl"||docExtension===".jar"){
                document.getElementById("alert-documento-resp").hidden=false;
                document.getElementById("path_doc_resp").focus;
                $("#btn-alterar").attr("disabled", true);
            }
        }
    });
</script>

{{--Script responsavel por mudar os campos requiridos para caso de cadastro, e nenhuma campo requirido para caso de pesquisa--}}
<script type="text/javascript">
    function mostraLembrete(){
        document.getElementById('div_dat_lembrete').hidden = !document.getElementById('div_dat_lembrete').hidden;
    }
</script>

<script>
  function populaModal(acao){
    if(acao=="lembrete"){
        document.getElementById("modal-title").innerHTML = "Deseja excluir este lembrete?";
    }else if(acao=="atendimento"){
        document.getElementById("modal-title").innerHTML = "Deseja desnvicular o atendimento?";
    }else if(acao=="resposta"){
        document.getElementById("modal-title").innerHTML = "Deseja excluir esta resposta?";
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