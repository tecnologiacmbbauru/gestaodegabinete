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