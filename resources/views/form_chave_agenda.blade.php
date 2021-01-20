@extends('layouts.app')

@section('content')
<head>
    <!-- Scripts -->
    <script src="{{ asset('js/exclusao.js') }}" defer></script>
</head>
<body>

    <div class="container">
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
             @include('alteracao/alt_chaveAgenda')
        @else
            @include('cadastro/cad_chave_agenda')
        @endif
             
</div>
</body>

@endsection