@extends('layouts.app')


@section('content')
<head>
    <!--Estilo-->
    <link href="{{ asset('css/pesquisa.css') }}" rel="stylesheet">
    <link href="{{asset('css/jquery-ui.css')}}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/jquery-ui.js') }}" defer></script>
    <script src="{{asset('js/exclusao.js')}}" defer></script>
    <!--Script voltar ao topo-->
    <script src="{{asset('js/voltarTopo.js')}}" defer></script>
    <script>
        function mostraAtendimento(checado){
            if(checado==true) {
                document.getElementById("segunda_secao").hidden=false;
            }else{
                document.getElementById("segunda_secao").hidden=true;
            }
        }
        //checado é o valor de document.getElementById("resposta").hidden recebido como parametro da função
        function mostraResposta(checado){
            if(checado==true) {
                document.getElementById("resposta").hidden=false;
                document.getElementById("dat_resposta").required=true; //valida para não cadastrar sem data da resposta
            }else{
                document.getElementById("resposta").hidden=true;
                document.getElementById("dat_resposta").required=false;
            }
        }
    
    </script>
</head>
<body>
    <div class="container">
        <!--Criar alerta de cadastro-->
            @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
    
            @if(session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif

            @if(session('sucess_delete'))
                <div class="alert alert-danger">
                    {{session('sucess_delete')}}
                </div>
            @endif

            {{--Botão de voltar ao topo--}}
            <div class="smoothscroll-top">
                <span class="scroll-top-inner" style="align-items: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
                    </svg>
                </span>
            </div>
            <!--form de update ou de cadastro-->
            @if($alteracao === true)
                @include('alteracao/alt_documento')
            @else
                @include('cadastro/cad_documento')
            @endif

            <!--Listagem dos documentos ja cadastradas-->
            @if(isset($mostraPesq))
                @include('pesquisa/tabela_documento')  
            @endif
    </div>  
</body>

@endsection