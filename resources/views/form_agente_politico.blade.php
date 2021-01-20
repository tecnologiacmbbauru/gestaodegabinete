@extends('layouts.app')


@section('content')
<head>
<!-- Scripts -->
<script src="{{asset('js/exclusao.js')}}" defer></script>
{{--<script src="{{asset('js/jquery.min.js')}}" defer></script>--}}
<script src="{{asset('js/jquery-mask.js')}}" defer></script>
<script src="{{asset('js/mask-pessoa.js')}}" defer></script>
<script type="text/javascript"> 
    jQuery(document).ready(function(){
        jQuery('#num_cep').on('focusout',function(){//assim que o campo de cep perde o foco
            var cep = document.getElementById('num_cep').value; 
            $.ajax({
            url: 'https://viacep.com.br/ws/'+cep+'/json/unicode/',
            dataType: 'json',
            success: function(resposta){
                $("#nom_endereco").val(resposta.logradouro);
                $("#nom_complemento").val(resposta.bairro);
                $("#nom_cidade").val(resposta.localidade);
                $("#nom_estado").val(resposta.uf);
                //Focar numero automaticamente após preencher
                $("#nom_numero").focus();
                }   
            });
        });
    });    
</script>
</head>

<body>


    <div class="container">
    <!--Criar alerta de cadastro-->

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
 
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach  
        </ul>
        @endif
        <div class="cadastro">
        @if($alteracao==false)
            @include('cadastro/cad_agentePolitico')
        @else 
            @include('alteracao/alt_agentePolitico')
        @endif
        </div>

             
    </div>
</body>

@endsection