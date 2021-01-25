@extends('layouts.app')


@section('content')
<head>
    <link href="{{asset('css/jquery-ui.css')}}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/jquery-ui.js') }}" defer></script>
    <script src="{{asset('js/exclusao.js')}}" defer></script>
    
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