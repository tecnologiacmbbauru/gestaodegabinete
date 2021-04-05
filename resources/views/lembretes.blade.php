@extends('layouts.app')


@section('content')
<head>
<!---
<style>
/*Define efeito de transição (Passar mouse por cima)*/
.card:hover
{
	-webkit-transform: scale(1.3);
	-ms-transform: scale(1.3);
	transform: scale(1.3);
}

</style>
-->
<style>
.card{
    max-width: 22%;
}

@media(max-width: 480px) {
    .card{
        max-width: 100%;
        margin: 0px;
    }
}
.card-header-danger{
    color: #761b18 !important;
    background-color: #f9d6d5 !important;
}
.card-header-warning{
    color: #857b26 !important;
    background-color: #fffbdb !important; 
}

.ver-mais{
    color:grey;
    text-decoration: underline;
}
.ver-mais:hover{
    color:black;
}

.ver-menos{
    color:grey;
    text-decoration: underline;
}
.ver-menos:hover{
    color:black;
}

.card-link{
    color:rgb(56, 51, 51);
}
.card-link:hover{
    color:rgb(0, 0, 0);
}


</style>
</head>

<body>
    <div class="container">

        <!--Alertas de sucesso-->
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

        <div class="form-group col-md-8">
            <label class="col-form-label negrito">Selecione os lembretes</label>
                <form id="form-pesquisa" action="{{route('lembrete.pesquisa')}}" method="POST">
                    @csrf
                    <select id="select-lembrete" class="form-control col-md-8" name="select-lembrete"> 
                        <option value="semana" @if($exibir==="semana") selected @endif>Lembretes próximos 5 dias</option>
                        <option value="atendimento" @if($exibir==="atendimento") selected @endif>Lembretes de Atendimento</option>
                        <option value="documento" @if($exibir==="documento") selected @endif>Lembretes de Documento</option>
                    </select>    
                </form>  
        </div>

        @if($exibir==="semana")
            @include('lembretes/lembrete_semana')
        @elseif($exibir==="atendimento")
            @include('lembretes/lembrete_atendimentos')
        @elseif($exibir==="documento")
            @include('lembretes/lembrete_documentos')
        @endif

    </div>
</body>

<script>
    function verDetalhes(contador){
        //oculta os detalhes do atendimento
        document.getElementById("detalhes"+contador).hidden = !document.getElementById("detalhes"+contador).hidden;
        
        //altera o texto de "ver mais" para "ver menos" ou vice versa dependendo da classe atual
        if(document.getElementById("ver-mais"+contador).className=="ver-mais"){
            document.getElementById("ver-mais"+contador).innerHTML="ver menos";
            document.getElementById("ver-mais"+contador).className="ver-menos";
        }else{
            document.getElementById("ver-mais"+contador).innerHTML="ver mais";
            document.getElementById("ver-mais"+contador).className="ver-mais";
        }
    }

    function finalizar(contador){
        document.getElementById("card"+contador).remove();
        //document.location.reload(true);//atualiza a pagina
    }

    $('#select-lembrete').change(function(){
        $('#form-pesquisa').submit();
    });
</script>


{{--Script para excluir notificações--}}
<script>
    function deleteAlert(){
        document.getElementById("alert").remove();
    }
</script>

@endsection
