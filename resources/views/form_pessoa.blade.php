@extends('layouts.app')
@section('content')
<head>
    <!--Estilo-->
    <link href="{{ asset('css/pesquisa.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{asset('js/jquery-mask.js')}}" defer></script>
    <script src="{{asset('js/mask-pessoa.js')}}" defer></script>
    <script src="{{asset('js/voltarTopo.js')}}" defer></script>
    <script defer>
 
        function checarF() {
            var check = document.getElementsByName("ind_pessoa"); 
            document.getElementById("limpar").click();
           
           //Lógica separada, pois precisa desabilitar campo para não enviar no banco de dados
            document.getElementById("cod_cpf").disabled=false;
            document.getElementById("cod_cpf").hidden=false;
            document.getElementById("cod_cnpj").disabled=true;
            document.getElementById("cod_cnpj").hidden=true;
           
            check[0].checked = true;
            for(var i=2;i<15;i++){
                document.getElementById("label"+i).hidden=true;
                i++;
            }
            for(var j=1;j<15;j++){
                document.getElementById("label"+j).hidden=false;
                j++;
            }
        }
        function checarJ(){
            var check = document.getElementsByName("ind_pessoa"); 
            document.getElementById("limpar").click();
            
            //Lógica separada, pois precisa desabilitar campo para não enviar no banco de dados
            document.getElementById("cod_cpf").disabled=true;
            document.getElementById("cod_cpf").hidden=true;
            document.getElementById("cod_cnpj").disabled=false;
            document.getElementById("cod_cnpj").hidden=false;
            
            check[1].checked = true;
            for(var i=2;i<15;i++){
                document.getElementById("label"+i).hidden=false;
                i++;
            }
            for(var j=1;j<15;j++){
                document.getElementById("label"+j).hidden=true;
                j++;
            }    
        }    
    </script>
    <!--Script para preenchimento automatico de enredeço-->
    <script type="text/javascript"> 

        jQuery(document).ready(function(){
            jQuery('#num_cep').on('focusout',function(){
                var cep = document.getElementById('num_cep').value; 
                $.ajax({
                url: 'https://viacep.com.br/ws/'+cep+'/json/unicode/',
                dataType: 'json',
                success: function(resposta){
                        $('#nom_endereco').val(resposta.logradouro);
                        $("#nom_complemento").val(resposta.complemento);
                        $("#nom_bairro").val(resposta.bairro);
                        $('#nom_cidade').val(resposta.localidade);
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
             @include('alteracao/alt_pessoa')
        @else
            @include('cadastro/cad_pessoa')
        @endif

        <!--lISTAGEM Das pessoas ja cadastradas-->
        @if(isset($mostraPesq))
            @include('pesquisa/tabela_pessoa')    
        @endif
      
    </div>  
</body>

@endsection