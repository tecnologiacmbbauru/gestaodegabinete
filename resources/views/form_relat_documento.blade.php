@extends('layouts.app')

@section('content')
<head>
<!--Estilo do Jquery UI-->
<link href="{{asset('css/jquery-ui.css')}}" rel="stylesheet">
<script src="{{ asset('js/jquery.min.js') }}" ></script>
<script src="{{ asset('js/jquery-ui.js') }}" ></script>
<script type="text/javascript">
    var check = true;
    function mostraAtendimento(){
        if(check==true) {
            document.getElementById("segunda_secao").hidden=false;
            check=false;
        }else{
            document.getElementById("segunda_secao").hidden=true;
            check=true;
        }
    }
    /*var checkR = true;
    function mostraResposta(){
        if(check==true) {
            document.getElementById("div_resp").hidden=false;
            check=false;
        }else{
            document.getElementById("div_resp").hidden=true;
            check=true;
        }
    }*/
    var checkAtendR = true;
    function atendimentoR(contator){
        if(checkAtendR == true){
            document.getElementById("atendimentoRela"+contator).hidden=false;
            checkAtendR=false;
        }else{
            document.getElementById("atendimentoRela"+contator).hidden=true;
            checkAtendR=true;            
        }
    }
</script>
</head>
<body>
    <div class="container">
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

    </div>
        </form>

    @if($mostrarTodos==true)
        <div style="display:flex;justify-content:flex-end;align-items:center;">
            @if(isset($dataform))
                <form class="form-horizontal" method="post" target="_blank" action={{route('relatorio.pesquisaDocumento',['dataform'=>$dataform])}}>
                    @method('get')
                    <button type="submit" aria-label="Gerar relatório pdf" class="btn-pdf" style="background-color: #f5f5f5;" name="action" value="relatorio">
                        <img src="{{asset('utils/pdf.png')}}" alt="Exportar para PDF" title="Exportar para PDF">
                    </button>
                    <button type="submit" aria-label="Gerar relatório Excel" class="btn-pdf" style="background-color: #f5f5f5;" name="action" value="relatorioExcel">
                        <img src="{{asset('utils/xls.png')}}" alt="Exportar para XLS" title="Exportar para XLS"> 
                    </button>

                </form>
            @endif
        </div>
        <!--listagem da busca documentos-->
        <div class="table-of row">
            <table id="tb_atendimento" class="mtab table table-striped table-hover table-responsive-lg" style="width:100%;">
            <thead class="thead-dark">
                <tr>
                    <th>Data</th>
                    <th>Número/Ano</th>
                    <th>Tipo</th>
                    <th>Situação</th>
                    <th>Unidade</th>
                    <th>Atendimento</th>
                    <th>Resposta</th>
                </tr>
            </thead>             
            @if($documentos->isEmpty()) {{--caso pesquisa não tenha resultado, o método isEmpty ja esta na classe LengthAwarePaginator na qual retorna a pesquisa paginada--}}
                <td colspan="7" style="text-align: center;">Não foi encontrado nenhum registro</td>
            @endif
            @php
                $i=1; //contador para saber qual o atendimento relacionado
            @endphp
            @foreach($documentos as $documento)
                <tbody> 
                    <td  width='14%'>
                        {{date('d/m/Y', strtotime($documento->dat_documento))}}
                    </td>
                    <td  width='14%'>
                        {{$documento->nom_documento}}/{{$documento->dat_ano}}              
                    </td>
                    <td  width='14%'>
                        {{$documento->tipoDocumento->nom_tip_doc}}             
                    </td> 
                    <td  width='14%'>
                        {{$documento->situacaoDoc->nom_status}}             
                    </td> 
                    <td  width='14%'>
                        {{$documento->unidadeDocumento->nom_uni_doc}}              
                    </td>
                    <td width='14%'>
                        @if($documento->GAB_ATENDIMENTO_cod_atendimento!=null)  
                            @if($documento->antedimentoRelacionado->ind_status=="A")
                                Sim 
                                {{--CÓDIGO PARA MOSTRAR INFORMAÇÕES SOBRE O ATENDIMENTO--}}
                                {{--<button onclick="atendimentoR({{$i}})">
                                    <img id="img-seta" src="{{asset("utils/avanco-rapido.png")}}"style="height:35px; width:20px; transform: rotate(90deg); padding-left:3px;"></img> 
                                </button> {{--Passa o contador de parametro para a função que mostra o atendimento--}}
                                {{--O nome da div tem o cotnador relacionado, para a função atendimnetoR saber qual div é para mostrar--}}
                                {{--
                                <div id="atendimentoRela{{$i}}" hidden="true"> 
                                    <label style="font-weight: bolder">Data:</label> <label>{{date('d/m/Y', strtotime($documento->antedimentoRelacionado->dat_atendimento))}}</label>
                                    <br>
                                    <label style="font-weight: bolder">Pessoa:</label> <label>{{$documento->antedimentoRelacionado->pessoa->nom_nome}}</label>
                                    <br>
                                    <label style="font-weight: bolder">Tipo:</label> <label>{{$documento->tipoDocumento->nom_tip_doc}}</label>
                                    <br>
                                    <label style="font-weight: bolder">Situação:</label> <label>{{$documento->situacaoDoc->nom_status}}</label>          
                                </div>
                                --}}
                            @else
                                Não
                            @endif                            
                        @else
                            Não
                        @endif
                    </td>
                    <td width='14%'>
                        @if($documento->dat_resposta!=null)
                            Sim {{--{{$documento->dat_resposta = date('d/m/y',strtotime($documento->dat_resposta))}}--}}
                        @else
                            Não
                        @endif                    
                    </td>  
                </tbody>
                @php
                    $i++;
                @endphp
            @endforeach
            </table>
        </div> 
        {!!$documentos->appends($dataform)->links()!!}  
        @endif
    </div>
</body>
@endsection

<script type="text/javascript" defer>
    function mostraDataResp(){
        var aux = document.getElementById('div_resp').hidden;
        if(aux == true){
            document.getElementById('div_resp').hidden=false;
        }else{
            document.getElementById('div_resp').hidden=true;
        }
    }
</script>