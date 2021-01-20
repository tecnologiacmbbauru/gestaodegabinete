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
            <label class="col-md-4 col-form-label negrito" for="dat_ano">Ano</label>
            <input id="dat_ano" type="text" class="form-control col-md-9" name="dat_ano" value="{{$docC->dat_ano}}"  autocomplete="dat_ano"  maxlength="4" required>                       
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
        <div class="form-group col-md-11">
            <label class="col-form-label negrito" for="txt_assunto">Assunto</label>
            <textarea class="form-control" rows="3" id="txt_assunto"  name="txt_assunto">{{$docC->txt_assunto}}</textarea>
        </div>
    </div> 

   <div class="form-row">
        <div class="form-group col-md-6">
            @if($docC->path_doc!=null)
                <a href="{{asset("storage/{$docC->path_doc}")}}" download="{{$docC->tipoDocumento->nom_tip_doc}}-{{$docC->nom_documento}}-{{$docC->dat_ano}}">Baixar {{$docC->tipoDocumento->nom_tip_doc}}-{{$docC->nom_documento}}-{{$docC->dat_ano}}</a>
                <br>
                <input class="form-check-input" type="checkbox" id="altera_doc" onclick="mostraAlteraDoc()" style="margin-left:3px;">
                <label class="form-check-label negrito" style="margin-left:25px;">Documento</label>   
                <input id="path_doc" type="file" class="form-control col-md-10 input-arquivo" name="path_doc" hidden="true">             
            @else
                <label class="col-form-label negrito" for="input_tipo_documento">Documento</label>
                <input type="file" class="form-control col-md-10 input-arquivo" name="path_doc" autofocus >
            @endif
        </div>
        <div class="form-group col-md-6">
            @if($docC->lnk_documento!=null)
                <a href="{{$docC->lnk_documento}}" target="_blank">{{$docC->lnk_documento}}</a>
                <br>   
                <input class="form-check-input" type="checkbox" id="altera_link" onclick="mostraAlteraLink()" style="margin-left:3px;">
                <label class="form-check-label negrito" for="altera_link" style="margin-left:25px;">Link Documento</label>
                <input id="lnk_documento" type="text" class="form-control col-md-10" hidden="true" autofocus >       
            @else
                <label class="col-form-label negrito" for="input_tipo_documento">Link Documento</label>
                <input id="lnk_documento" type="text" class="form-control col-md-10" name="lnk_documento">
            @endif
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            @if($docC->GAB_ATENDIMENTO_cod_atendimento!=null)
                <fieldset id="segunda_secao" class="fieldset-personalizado" form="altera_documento">
                    <h5 class="negrito">Atendimento Relacionado</h5>
                    <div class=form-group id="form_cad_resultado_alteracao">
                        <label style="font-weight: bolder">Data:</label> <label>{{date('d/m/Y', strtotime($docC->antedimentoRelacionado->dat_atendimento))}}</label>
                        <br>
                        <label style="font-weight: bolder">Pessoa:</label> <label>{{$docC->antedimentoRelacionado->pessoa->nom_nome}}</label>
                        <br>
                        <label style="font-weight: bolder">Doc.Identificação:</label> <label>{{$docC->antedimentoRelacionado->pessoa->cod_cpf_cnpj}}</label>
                        <br>
                        <label style="font-weight: bolder">Tipo:</label> <label>{{$docC->tipoDocumento->nom_tip_doc}}</label>
                        <br>
                        <label style="font-weight: bolder">Situação:</label> <label>{{$docC->situacaoDoc->nom_status}}</label>                     
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
                    <label class="form-check-label negrito" style="margin-left:25px;">Possui Atendimento Relacionado</label> 
                    <div id="pesquisaAtendimento" name="pesquisaAtendimento" style="display:none;">
                        @include('Utils/form_pesquisa_atendimento')
                    </div> 
                </fieldset>          
            @endif
        </div>
        <div class="form-group col-md-6">
            @if($docC->dat_resposta!=null)
                <fieldset id="terceira_secao" class="fieldset-personalizado" form="form_cadastro_documento">
                    <h5 class="negrito">Resposta</h5>
                    <div class="form-row" id="input_nom pessoa">
                        <div class="form-group col-md-12">
                            <label class="col-form-label negrito" for="dat_resposta">Data</label>
                            <input id="dat_resposta" type="date" name="dat_resposta" value="{{$docC->dat_resposta}}" class="form-control input-md datepicker">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="col-form-label negrito">Documento de Resposta</label>
                            @if($docC->path_doc_resp!=null)
                                <a href="{{asset("storage/{$docC->path_doc_resp}")}}" download="Documento-Resposta">Baixar Documento de Resposta</a>                                
                            @else
                                <input type="file" class="form-control input-arquivo" name="path_doc_resp">
                            @endif
                        </div>
                    </div>                       
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="col-form-label negrito" for="link_doc">Link Resposta {{--<img src="{{url("utils/icone_ajuda.png")}}" title="Caso o documento estaja salvado na nuvem ou em algum site você pode inserir o link aqui." >--}}</label>
                            <input id="link_resposta" type="text" class="form-control" name="link_resposta" value="{{$docC->link_resposta}}" >
                        </div>
                    </div>                        
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="col-form-label negrito" for="txt_obs">Detalhes</label>
                            <textarea class="form-control" rows="3" id="txt_resposta"  name="txt_resposta">{{$docC->txt_resposta}}</textarea>  
                        </div>
                    </div>    
                    <input type="hidden" NAME="ind_status" VALUE="A"> 
                </fieldset>                  
            @else
                <fieldset id="terceira_secao" class="fieldset-personalizado" form="form_cadastro_documento">
                    <div class="form-check form-check-inline" id="div_resposta" style="margin-bottom:20px;">
                        <input class="form-check-input" type="checkbox" id="resp_rel" onclick="mostraResposta()">
                        <label class="form-check-label negrito" for="div_resposta">Possui Resposta</label>
                    </div>      
                    <div id="resposta" hidden=true>
                            <div class="form-row" id="input_nom pessoa">
                                <div class="form-group col-md-12">
                                    <label class="col-form-label negrito" for="dat_resposta">Data</label>
                                    <input id="dat_resposta" type="date" name="dat_resposta" placeholder="" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="col-form-label negrito" for="link_doc">Documento de Resposta</label>
                                    <input type="file" class="form-control input-arquivo" name="path_doc_resp">
                                </div>
                            </div>                       
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="col-form-label negrito" for="link_doc">Link Resposta {{--<img src="{{url("utils/icone_ajuda.png")}}" title="Caso o documento estaja salvado na nuvem ou em algum site você pode inserir o link aqui." >--}}</label>
                                    <input id="link_resposta" type="text" class="form-control" name="link_resposta">
                                </div>
                            </div>                        
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="col-form-label negrito" for="txt_obs">Detalhes</label>
                                    <textarea class="form-control" rows="4" id="txt_resposta"  name="txt_resposta"></textarea>   
                                </div>
                            </div>    
                            <input type="hidden" NAME="ind_status" VALUE="A"> 
                    </div>  
                </fieldset>       
            @endif
        </div>
    </div>

    <div class="form-row div-botoes-cadastro">
        <div>           
            <button type="submit" class="btn btn-primary alterar">Alterar</button>
            <a href="javascript:history.back()" class="btn btn-primary alterar">Voltar</a>
        </div>
    </div>

</form>
</div>

<script  type="text/javascript">
    var checkAD = true;
    var checkAl = true;
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