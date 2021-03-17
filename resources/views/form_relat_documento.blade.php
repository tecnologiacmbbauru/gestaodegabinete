@extends('layouts.app')

@section('content')
<head>
<!--Estilo do Jquery UI-->
<link href="{{asset('css/jquery-ui.css')}}" rel="stylesheet">
<link href="{{ asset('css/pesquisa.css') }}" rel="stylesheet">
<!--scripts-->
<script src="{{ asset('js/jquery.min.js') }}" ></script>
<script src="{{ asset('js/jquery-ui.js') }}" ></script>
<!--Script voltar ao topo-->
<script src="{{asset('js/voltarTopo.js')}}" defer></script>

<!--Scripts para mostrarem divs ocultas-->
<script src="{{asset('js/mostraRelacionados.js')}}" defer></script>
<script type="text/javascript">

    function mostraAtendimento(){
        document.getElementById("segunda_secao").hidden=!document.getElementById("segunda_secao").hidden;
    }

    function mostraDataResp(){
        document.getElementById('div_resp').hidden=!document.getElementById('div_resp').hidden;
    }

</script>
</head>
<body>
    <div class="container">
        {{--Botão de voltar ao topo--}}
        <div class="smoothscroll-top">
            <span class="scroll-top-inner" style="align-items:center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16" style="margin-top:10px;">
                    <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
                </svg>
            </span>
        </div>        
        <div class="cadastro">
            <h1 class="titulo" style="text-align:center; padding-right:10%;">Relatório de Documentos</h1>
            <form id="form" class="form" method="post" action={{route('relatorio.pesquisaDocumento')}}> 
                @csrf
                <div class="form-group row">
                    <div class="form-group col-md-4">   
                        <label class="col-form-label negrito" for="input_tipo_documento">Tipo de Documento</label>
                        <select class="form-control col-md-11" name="GAB_TIPO_DOCUMENTO_cod_tip_doc">
                        <option name="GAB_TIPO_DOCUMENTO_cod_tip_doc" value="" selected>Selecione</option>
                            @foreach ($tipoDocumento as $tipoDocumento)
                                <option name="GAB_TIPO_DOCUMENTO_cod_tip_doc" value="{{ $tipoDocumento->cod_tip_doc}}">{{ $tipoDocumento->nom_tip_doc}}</option>
                            @endforeach
                        </select> 
                    </div>
                    <div class="form-group col-md-4">   
                        <label class="col-form-label negrito" for="nom_documento">Número</label>
                        <input id="nom_documento" type="number" class="form-control col-md-10" name="nom_documento" value="{{old('nom_documento')}}" autofocus  maxlength="50">
                    </div>
                    <div class="form-group col-md-4">   
                        <label class="col-form-label negrito" for="dat_ano">Ano</label>
                        <input id="dat_ano" type="number" class="form-control col-md-9" name="dat_ano" value="{{old('dat_ano')}}" autocomplete="dat_ano"  autofocus  maxlength="4">  
                    </div>
                </div>

                <div class="form-group row">
                    <div class="form-group col-md-6">   
                        <label class="col-form-label negrito">Unidade Administrativa</label>
                        <select class="form-control col-md-10" name="GAB_UNIDADE_DOCUMENTO_cod_uni_doc">
                        <option name="GAB_UNIDADE_DOCUMENTO_cod_uni_doc" value="" selected>Selecione</option>
                            @foreach ($unidadeDocumento as $unidadeDocumento)
                                <option name="GAB_UNIDADE_DOCUMENTO_cod_uni_doc" value="{{ $unidadeDocumento->cod_uni_doc}}">{{ $unidadeDocumento->nom_uni_doc}}</option>
                            @endforeach
                        </select>
                    </div>                
                    <div class="form-group col-md-6">   
                        <label class="col-form-label negrito" for="dat_nascimento">Situação do Documento</label>
                        <select id="input_cod_status" class="form-control col-md-10" name="GAB_STATUS_DOCUMENTO_cod_status">
                            <option name="GAB_STATUS_DOCUMENTO_cod_status" value="" selected>Selecione</option>
                            @foreach ($situacaoDoc as $situacaoDoc)
                                <option name="GAB_STATUS_DOCUMENTO_cod_status" value="{{ $situacaoDoc->cod_status}}">{{ $situacaoDoc->nom_status}}</option>
                            @endforeach
                        </select>                            
                    </div>
                </div>


                <div class="form-group row">
                    <div class="form-group col-md-4">   
                        <label class="col-form-label negrito" for="dat_ini">Data Inicial</label>
                        <input id="dat_ini" type="date" name="dat_ini" placeholder="" class="form-control input-md datepicker col-md-11">
                    </div>
                    <div class="form-group col-md-4">   
                        <label class="col-form-label negrito" for="dat_fim">Data Final</label>
                        <input id="dat_fim" type="date" name="dat_fim" placeholder="" class="form-control input-md datepicker col-md-10" >
                    </div>
                    <div class="form-group col-md-4">   
                        <input name="resp_rel" class="form-check-input" type="checkbox" id="resp_rel" onclick="mostraDataResp()" style="margin-left:0px;"><b style="margin-left:20px;">Possui resposta</b>
                        <div class="form-inline row" id="div_resp" hidden=true>
                            <label class="col-form-label negrito" style="margin-right: 5%;">Data</label>
                            <input id="dat_resposta" type="date" name="dat_resposta" placeholder="" class="form-control input-md datepicker col-md-7">
                        </div>
                    </div>
                </div>

                <div class="form-check form-check-inline" id="div_atend_rel" style="margin-bottom:20px;">
                    <input class="form-check-input" type="checkbox" id="atend_rel" name="atend_rel" onclick="mostraAtendimento()">
                    <label class="form-check-label" for="div_atend_rel">Possui Atendimento Relacionado</label>
                </div>

                <div class="form-group row">
                    <div class="form-group col-md-11">   
                        <fieldset id="segunda_secao" class="fieldset-personalizado" form="form_cadastro_documento" hidden=true >
                            @include('Utils/form_pesquisa_atendimento')
                        </fieldset>
                    </div>                
                </div>

                <div class="form-row div-botoes-cadastro">
                    <div>
                        <button id="btn_pesquisar" onclick="form_pesquisa()" type="submit" name="action" value="pesquisar" class="btn btn-primary" >Pesquisar</button>
                        <button type="reset" class="btn btn-primary">Limpar</button> 
                    </div>
                </div>   
            </form>
        </div>
    
        @if($mostrarTodos==true)

            {{--Verificar se dispostivo é desktop ou mobile--}}
            @php
                $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
                $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
                $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
                $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
                $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
                $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
                $symbian = strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");

                if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
                    $dispositivo = "mobile";
                }else{
                    $dispositivo = "computador";
                } 
            @endphp

            <div id="topo-pesqDocumento"  style="margin-top:5px; display:flex">
                @if(isset($dataform) and $dispositivo=="mobile")
                    <div class="row">
                        <div class="col" style="margin-bottom: 20px;margin-top: 20px;display:flex;justify-content:center;align-items:center;">
                            <form class="form-horizontal" method="post" target="_blank" action={{route('relatorio.pesquisaDocumento',['dataform'=>$dataform])}}>
                                @method('get')
                                <button type="submit" aria-label="Gerar relatório pdf" class="btn-pdf" style="background-color: #f5f5f5;" name="action" value="relatorio">
                                    <img src="{{asset('utils/pdf.png')}}" alt="Exportar para PDF" title="Exportar para PDF">
                                </button>
                                <button type="submit" aria-label="Gerar relatório Excel" class="btn-pdf" style="background-color: #f5f5f5;" name="action" value="relatorioExcel">
                                    <img src="{{asset('utils/xls.png')}}" alt="Exportar para XLS" title="Exportar para XLS"> 
                                </button>
                            </form>
                        </div>
                        <div class="col" style="margin-bottom: 20px;text-align:center;">
                                {{--Se existir mais de 20 dados abre os links--}}
                                Total de registros: {{$documentos->total()}} (a pesquisa retorna até 500)
                                @if(isset($dataform))
                                    {!!$documentos->appends($dataform)->links()!!}
                                @endif
                        </div>
                    </div>
                @endif

                @if(isset($dataform) and $dispositivo=="computador")
                    <div class="col" style="margin-bottom: 15px;margin-top: 20px;">
                        {{--Se existir mais de 20 dados abre os links--}}
                        <label style="margin-left:10px;"> Total de registros: {{$documentos->total()}} (a pesquisa retorna até 500)</label>
                        @if(isset($dataform))        
                            {!!$documentos->appends($dataform)->links()!!}
                        @endif
                    </div>
                    <div class="col-md-8" style="display:flex;justify-content:flex-end;align-items:center; margin-bottom: 10px;">
                        <div>
                            <form class="form-horizontal" method="post" target="_blank" action={{route('relatorio.pesquisaDocumento',['dataform'=>$dataform])}}>
                                @method('get')
                                <button type="submit" aria-label="Gerar relatório pdf" class="btn-pdf" style="background-color: #f5f5f5;" name="action" value="relatorio">
                                    <img src="{{asset('utils/pdf.png')}}" alt="Exportar para PDF" title="Exportar para PDF">
                                </button>
                                <button type="submit" aria-label="Gerar relatório Excel" class="btn-pdf" style="background-color: #f5f5f5;" name="action" value="relatorioExcel">
                                    <img src="{{asset('utils/xls.png')}}" alt="Exportar para XLS" title="Exportar para XLS"> 
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
            <!--listagem da busca documentos-->
            <div class="table-of row">
                <table id="tb_documento" class="mtab table table-striped table-hover table-responsive-lg" style="width:100%;">
                <thead class="thead-dark">
                    <tr>
                        <th>Data</th>
                        <th>Número/Ano</th>
                        <th>Tipo</th>
                        <th>Situação</th>
                        <th>Unidade</th>
                        <th>Atendimento</th>
                        <th>Resposta</th>
                        <th style="text-align: center;">Anexos</th>
                    </tr>
                </thead>             
                @if($documentos->isEmpty()) {{--caso pesquisa não tenha resultado, o método isEmpty ja esta na classe LengthAwarePaginator na qual retorna a pesquisa paginada--}}
                    <td colspan="7" style="text-align: center;">Não foi encontrado nenhum registro</td>
                @endif
                @php
                    $i=1; //contador para saber qual o atendimento relacionado
                @endphp
                <tbody>
                @foreach($documentos as $documento)
                    <tr>
                        <td  width='12%'>
                            {{date('d/m/Y', strtotime($documento->dat_documento))}}
                        </td>
                        <td  width='12%'>
                            {{$documento->nom_documento}}/{{$documento->dat_ano}}              
                        </td>
                        <td  width='12%'>
                            {{$documento->tipoDocumento->nom_tip_doc}}             
                        </td> 
                        <td  width='12%'>
                            {{$documento->situacaoDoc->nom_status}}             
                        </td> 
                        <td  width='12%'>
                            {{$documento->unidadeDocumento->nom_uni_doc}}              
                        </td>
                        <td width='18%'>
                            @if($documento->GAB_ATENDIMENTO_cod_atendimento!=null)  
                                @if($documento->antedimentoRelacionado->ind_status=="A")
                                    Sim 
                                    {{--CÓDIGO PARA MOSTRAR INFORMAÇÕES SOBRE O ATENDIMENTO--}}
                                    {{--Passa o contador de parametro para a função que mostra o atendimento--}}
                                        <img class="seta" type="button" src="{{asset('Utils/seta-down.svg')}}" id="seta{{$i}}" onclick="atendimentoR({{$i}})">
                                    {{--O nome da div tem o cotnador relacionado, para a função atendimnetoR saber qual div é para mostrar--}} 
                                    <div id="atendimentoRela{{$i}}" hidden="true"> 
                                        <label style="font-weight: bolder">Data:</label> <label>{{date('d/m/Y', strtotime($documento->antedimentoRelacionado->dat_atendimento))}}</label>
                                        <br>
                                        <label style="font-weight: bolder">Pessoa:</label> <label>{{$documento->antedimentoRelacionado->pessoa->nom_nome}}</label>
                                        <br>
                                        <label style="font-weight: bolder">Tipo:</label> <label>{{$documento->tipoDocumento->nom_tip_doc}}</label>
                                        <br>
                                        <label style="font-weight: bolder">Situação:</label> <label>{{$documento->situacaoDoc->nom_status}}</label>          
                                    </div>
                                @else
                                    Não
                                @endif                            
                            @else
                                Não
                            @endif
                        </td>
                        <td width='10%'>
                            @if($documento->dat_resposta!=null)
                                Sim
                                <img class="seta" type="button" src="{{asset('Utils/seta-down.svg')}}" id="seta-res{{$i}}" onclick="respRela({{$i}})">
                                {{--O nome da div tem o cotnador relacionado, para a função atendimnetoR saber qual div é para mostrar--}} 
                                <div id="respRela{{$i}}" hidden="true" style="font-weight: 540;"> 
                                    {{$documento->dat_resposta = date('d/m/yy',strtotime($documento->dat_resposta))}}
                                    @if($documento->path_doc_resp!=null)
                                        <a class="link-documento" href="{{asset("storage/{$documento->path_doc_resp}")}}" download="Documento-Resposta"><img src="{{asset('utils/baixar-doc.png')}}" alt="Baixar Documento de Resposta" title="Baixar Documento de Resposta"></a>  
                                        @if($documento->link_resposta!=null)
                                            <a href="{{$documento->link_resposta}}" target="_blank"><img src="{{asset('utils/link-doc.png')}}" alt="Link Resposta do Documento" title="Link Resposta do Documento"></a>
                                        @endif 
                                    @else
                                        @if($documento->link_resposta!=null)
                                            <a href="{{$documento->link_resposta}}" target="_blank"><img src="{{asset('utils/link-doc.png')}}" alt="Link Resposta do Documento" title="Link Resposta do Documento"></a>
                                        @endif    
                                    @endif
                                </div>
                            @else
                                Não
                            @endif                    
                        </td>  
                        @if($documento->path_doc!=null)
                            <td  width='10%' style="text-align: center;">
                                <a class="link-documento" href="{{asset("storage/{$documento->path_doc}")}}" download="{{$documento->tipoDocumento->nom_tip_doc}}-{{$documento->nom_documento}}-{{$documento->dat_ano}}"><img src="{{asset('utils/baixar-doc.png')}}" alt="Baixar Documento" title="Baixar Documento"></a>
                                @if($documento->lnk_documento!=null)
                                    <a href="{{$documento->lnk_documento}}" target="_blank"><img src="{{asset('utils/link-doc.png')}}" alt="Link Documento" title="Link do Documento"></a>
                                @endif
                            </td>
                        @else
                            <td  width='10%' style="text-align: center;">
                                @if($documento->lnk_documento!=null)
                                    <a href="{{$documento->lnk_documento}}" target="_blank"><img src="{{asset('utils/link-doc.png')}}" alt="Link Documento" title="Link do Documento"></a>
                                @endif 
                            </td>
                        @endif 
                    </tr>
                    @php
                        $i++;
                    @endphp
                @endforeach
                </tbody>
                </table>
            </div> 
            {!!$documentos->appends($dataform)->links()!!}  
            <script type="text/javascript" defer>
                //foca na tabela quando mostra todos é igual a true e a pagina carrega
                $(document).ready(function() { 
                    window.location.href='#topo-pesqDocumento';
                });
            </script>
        @endif
    </div>
</body>
@endsection
