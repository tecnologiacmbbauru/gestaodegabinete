@extends('layouts.app')


@section('content')
<head>
<!--Estilo do JQuery ui-->
<link href="{{asset('css/jquery-ui.css')}}" rel="stylesheet">
<link href="{{ asset('css/pesquisa.css') }}" rel="stylesheet">

<!--Script voltar ao topo-->
<script src="{{asset('js/voltarTopo.js')}}" defer></script>

<script src="{{ asset('js/jquery.min.js') }}" ></script>
<script src="{{ asset('js/jquery-ui.js') }}" ></script>
</head>
<body>
{{--Botão de voltar ao topo--}}
<div class="smoothscroll-top">
    <span class="scroll-top-inner" style="align-items: center;">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
        </svg>
    </span>
</div>
<form id="form" class="form" method="post" action={{route('relatorio.pesquisaAtendimento')}}>     
    @csrf
    <div id="atendimento" class="container">
    <div class="cadastro">
        @csrf

        <div class="form-row">    
            <div class="form-group col-md-2">
                <img src="" alt="Imagem de Municipe" id="img_pessoa" style="max-widht: 100px; max-height: 100px;" hidden="true">
            </div>
            <div class="form-group col-md-8">
                <h1 class="titulo" style="text-align:center; padding-right:10%; padding-top:2%;">Relatório de Atendimentos</h1>
            </div>
        </div>

        <div class="form-row">    
            <div class="form-group  col-md-6">
                <label class="negrito col-form-label" for="input_nom_pessoa">Pessoa</label>
                <input id="pessoa_busca" type="text" class="form-control col-md-10" name="pessoa_busca" autofocus >
                <input type="text" id='GAB_PESSOA_cod_pessoa' name="GAB_PESSOA_cod_pessoa" hidden="true"  readonly>
            </div>
            <div class="form-group  col-md-6">
                <label class="col-form-label negrito">Estado</label>
                <select id="nom_estado" class="form-control col-md-10" name="nom_estado">
                    <option name="" value="" selected>Selecione</option>
                    @foreach ($estados as $estado)
                        @if($estado=="AC")<option name="AC" value="AC">{{('Acre')}}</option>@endif
                        @if($estado=="AL")<option name="AL" value="AL">{{('Alagoas')}}</option>@endif 
                        @if($estado=="AP")<option name="AP" value="AP">{{('Amapá')}}</option>@endif 
                        @if($estado=="AM")<option name="AM" value="AM">{{('Amazonas')}}</option>@endif 
                        @if($estado=="BA")<option name="BA" value="BA">{{('Bahia')}}</option>@endif 
                        @if($estado=="CE")<option name="CE" value="CE">{{('Ceará')}}</option>@endif 
                        @if($estado=="DF")<option name="DF" value="DF">{{('Distrito Federal')}}</option>@endif
                        @if($estado=="ES")<option name="ES" value="ES">{{('Espírito Santo')}}</option>@endif
                        @if($estado=="GO")<option name="GO" value="GO">{{('Goiás')}}</option>@endif
                        @if($estado=="MA")<option name="MA" value="MA">{{('Maranhão')}}</option>@endif
                        @if($estado=="MT")<option name="MT" value="MT">{{('Mato Grosso')}}</option>@endif
                        @if($estado=="MS")<option name="MS" value="MS">{{('Mato Grosso do Sul')}}</option>@endif
                        @if($estado=="MG")<option name="MG" value="MG">{{('Minas Gerais')}}</option>@endif
                        @if($estado=="PA")<option name="PA" value="PA">{{('Pará')}}</option>@endif
                        @if($estado=="PB")<option name="PB" value="PB">{{('Paraíba')}}</option>@endif
                        @if($estado=="PR")<option name="PR" value="PR">{{('Paraná')}}</option>@endif
                        @if($estado=="PE")<option name="PE" value="PE">{{('Pernambuco')}}</option>@endif
                        @if($estado=="PI")<option name="PI" value="PI">{{('Piauí')}}</option>@endif
                        @if($estado=="RJ")<option name="RJ" value="RJ">{{('Rio de Janeiro')}}</option>@endif
                        @if($estado=="RN")<option name="RN" value="RN">{{('Rio Grande do Norte')}}</option>@endif
                        @if($estado=="RS")<option name="RS" value="RS">{{('Rio Grande do Sul')}}</option>@endif
                        @if($estado=="RO")<option name="RO" value="RO">{{('Rondônia')}}</option>@endif
                        @if($estado=="RR")<option name="RR" value="RR">{{('Roraima')}}</option>@endif
                        @if($estado=="SC")<option name="SC" value="SC">{{('Santa Catarina')}}</option>@endif
                        @if($estado=="SP")<option name="SP" value="SP">{{('São Paulo')}}</option>@endif
                        @if($estado=="SE")<option name="SE" value="SE">{{('Sergipe')}}</option>@endif
                        @if($estado=="TO")<option name="TO" value="TO">{{('Tocantins')}}</option>@endif
                    @endforeach
                </select>
            </div>
        </div>

                <script type="text/javascript" >
                    // CSRF Token
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $(document).ready(function(){

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
                        $('#pessoa_busca').val(ui.item.nome); // display the selected text //mostra o texto selecionado

                        $('#GAB_PESSOA_cod_pessoa').val(ui.item.value); // save selected id to input //salva o id do input
                        
                        if (ui.item.path_imagem!=null){
                            $('#img_pessoa').attr("src","../storage/"+ui.item.path_imagem);
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

        <div class="form-row">    
            <div class="form-group  col-md-6">
                <label class="negrito col-form-label">Cidade</label>
                <select name="nom_cidade" id="nom_cidade" class="form-control col-md-10">
                <option value="" selected>Selecione</option>
                    @foreach ($cidades as $cidade)
                        <option value="{{$cidade}}">{{$cidade}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group  col-md-6">
                <label class="col-form-label negrito">Bairro</label>
                    <select name="nom_bairro" id="nom_bairro" class="form-control col-md-10">
                    <option  value="" selected>Selecione</option>
                        @foreach ($bairros as $bairro)
                            <option value="{{$bairro}}">{{$bairro}}</option>
                        @endforeach
                    </select>
            </div>
        </div>            

        <div class="form-row">    
            <div class="form-group  col-md-6">
                <label class="col-form-label negrito">Data Inicial</label>
                <input id="dat_ini" type="date" name="dat_ini" placeholder="" class="form-control input-md datepicker col-md-10">
            </div>
            <div class="form-group  col-md-6">
                <label class="col-form-label negrito">Data final</label>
                <input id="dat_fim" type="date" name="dat_fim" placeholder="" class="form-control input-md datepicker col-md-10">
            </div>
        </div>   

        <div class="form-row">    
            <div class="form-group  col-md-6">
                <label class="col-form-label negrito">Tipo de Atendimento</label>
                <select class="form-control col-md-10" name="GAB_TIPO_ATENDIMENTO_cod_tipo">
                <option name="GAB_TIPO_ATENDIMENTO_cod_tipo" value="" selected>Selecione</option>
                    @foreach ($tipoAtendimentos as $tipoAtendimento)
                        <option name="GAB_TIPO_ATENDIMENTO_cod_tipo" value="{{$tipoAtendimento->cod_tipo}}">{{$tipoAtendimento->nom_tipo}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group  col-md-6">
                <label class="col-form-label negrito">Situação do Atendimento</label>
                <select class="form-control col-md-10" name="GAB_STATUS_ATENDIMENTO_cod_status">
                    <option name="GAB_STATUS_ATENDIMENTO_cod_status" value="" selected>Selecione</option>
                    @foreach ($statusAtendimentos as $statusAtendimento)
                        <option name="GAB_STATUS_ATENDIMENTO_cod_status" value="{{$statusAtendimento->cod_status}}">{{$statusAtendimento->nom_status}}</option>
                    @endforeach
                </select>
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

        <div id="topo-pesqAtendimento"  style="margin-top:5px; display:flex">

            @if(isset($dataform) and $dispositivo=="mobile")
                <div class="row">
                    <div class="col" style="margin-bottom:5px;margin-top: 20px;display:flex;justify-content:center;align-items:center;">
                        <form class="form-horizontal" method="post" target="_blank" action={{route('relatorio.pesquisaAtendimento',['dataform'=>$dataform])}}>
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
                            Total de registros: {{$atendimentos->total()}} (a pesquisa retorna até 500)
                            @if(isset($dataform))
                                {!!$atendimentos->appends($dataform)->links()!!}
                            @endif
                    </div>
                </div>
            @endif

            @if(isset($dataform) and $dispositivo=="computador")
                <div class="col" style="margin-bottom: 10px;margin-top: 10px;">
                    {{--Se existir mais de 20 dados abre os links--}}
                    <label style="margin-left:10px;"> Total de registros: {{$atendimentos->total()}} (a pesquisa retorna até 500)</label>
                    @if(isset($dataform))        
                        {!!$atendimentos->appends($dataform)->links()!!}
                    @endif
                </div>
                <div class="col-md-8" style="display:flex;justify-content:flex-end;align-items:center; margin-bottom: 10px;">
                    <div>
                        <form class="form-horizontal" method="post" target="_blank" action={{route('relatorio.pesquisaAtendimento',['dataform'=>$dataform])}}>
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
        <!--lISTAGEM DOS atendimentos ja cadastrados-->
        <div class="table-of row">
            <table id="tb_atendimento" class="mtab table table-striped table-hover table-responsive-lg" cellspacing="10" width="100%">
                <thead class="thead-dark">
                    <tr>
                        <th>Data</th>
                        <th>Pessoa</th>
                        <th>Doc. Identificação</th>
                        <th>Endereço</th>
                        <th>Tipo</th>
                        <th>Situação</th>
                    </tr>
                </thead>
                @if($atendimentos->isEmpty()) {{--caso pesquisa não tenha resultado, o método isEmpty ja esta na classe LengthAwarePaginator (classe responsavel por retornar a pesquisa paginada)--}}
                    <td colspan="6" style="text-align: center;">Não foi encontrado nenhum registro</td>
                @endif
                @foreach($atendimentos as $atendimentoC)
                <tbody>
                        <td  width='10%'>   
                            {{date('d/m/Y', strtotime($atendimentoC->dat_atendimento))}} <!--Formata para modo de data usado no Brasil-->
                        </td>
                            @if($atendimentoC->GAB_PESSOA_cod_pessoa==null)
                                <td  width='19%'>
                                    Não existe pessoa relacionada
                                </td> 
                                <td  width='16%'>
                                    -
                                </td>
                                <td  width='19%'>
                                    -
                                </td>
                            @else
                                <td  width='19%'>
                                    {{$atendimentoC->pessoa->nom_nome}}
                                </td>
                                <td  width='20%'>
                                    @if($atendimentoC->pessoa->ind_pessoa=='PF')
                                        @if($atendimentoC->pessoa->cod_cpf_cnpj!=null)
                                            <strong>CPF:</strong> <label class="cpf">{{$atendimentoC->pessoa->cod_cpf_cnpj}}</label>
                                        @endif
                                        <br>
                                        @if($atendimentoC->pessoa->cod_rg!=null)
                                            <strong>RG:</strong> <label class="rg">{{$atendimentoC->pessoa->cod_rg}}</label>
                                        @endif
                                    @elseif($atendimentoC->pessoa->ind_pessoa=='PJ')
                                        @if($atendimentoC->pessoa->cod_cpf_cnpj!=null)
                                            <strong>CNPJ:</strong> <label class="cnpj">{{$atendimentoC->pessoa->cod_cpf_cnpj}}</label>
                                        @endif
                                        <br>
                                        @if($atendimentoC->pessoa->cod_ie!=null)
                                            <strong>I.E:</strong> <label class="ie">{{$atendimentoC->pessoa->cod_ie}}</label>
                                        @endif
                                    @endif
                                </td>
                                <td  width='19%'>
                                    @if(isset($atendimentoC->pessoa->nom_bairro))
                                        {{$atendimentoC->pessoa->nom_bairro}},
                                        <br>
                                    @endif
                                    {{$atendimentoC->pessoa->nom_cidade}}@if($atendimentoC->pessoa->nom_estado!=null) / {{$atendimentoC->pessoa->nom_estado}}@endif
                                </td>
                            @endif
                        <td  width='16%'>
                            {{$atendimentoC->tipoAtendimento->nom_tipo}}
                        </td>
                        <td  width='16%'>
                            {{$atendimentoC->statusAtendimento->nom_status}}
                        </td>
                </tbody>
                @endforeach
            </table>
        </div> 
        {!!$atendimentos->appends($dataform)->links()!!}
        <script type="text/javascript" defer>
            //foca na tabela quando mostra todos é igual a true e a pagina carrega
            $(document).ready(function() { 
                window.location.href='#topo-pesqAtendimento';
            });
        </script>
    @endif
</body>
<script type="text/javascript">
    function form_pesquisa(){
        estado = $('#nom_estado').val();
        cidade =  $('#nom_cidade').val();
        bairro =  $('#nom_bairro').val();
        if(cidade=="" && bairro=="" && estado=="" ){
             $('#btn_pesquisar').val("pesquisa");
        }else{
            $('#btn_pesquisar').val("pesquisaEndereco");
        }
    }
</script>
@endsection

