@extends('layouts.app')


@section('content')
<head>
<!--Estilo-->
<link href="{{ asset('css/pesquisa.css') }}" rel="stylesheet">
<!--Stilo do Jquey ui-->
<link href="{{asset('css/jquery-ui.css')}}" rel="stylesheet">
<!-- Scripts -->
<script src="{{ asset('js/jquery-ui.js') }}" defer></script>
<script src="{{ asset('js/exclusao.js') }}" defer></script>
<!--Script voltar ao topo-->
<script src="{{asset('js/voltarTopo.js')}}" defer></script>
</head>
<body>
    <div id="atendimento" class="container">
    <!--Criar alerta de cadastro-->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if(session('sucess_delete'))
            <div class="alert alert-danger">
                {{ session('sucess_delete') }}
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
             @include('alteracao/alt_atendimento')
        @else
            @include('cadastro/cad_atendimento')
        @endif         
        <!--Listaegm dos atendimentos ja cadastradas-->
        @if(isset($mostraPesq))
            @include('pesquisa/tabela_atendimento')  
        @endif
    </div>
</body>

@endsection