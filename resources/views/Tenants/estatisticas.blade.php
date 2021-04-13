@extends('Tenants.layouts.app')
@section('content')

@if(!isset($mostraPesq))<!--Se não tiver pesquisado nada -->
    <div class="container">
        <h1>Estatísticas Avançadas</h1>
        <h3>Selecione o Gabinete</h3>
        <form id="form-pesquisa" action="{{route('estatisticas.pesquisa')}}" method="POST">
            @csrf
            <select id="select-gab" name="select-gab" class="custom-select custom-select-lg col-lg-5" style="margin-bottom: 15px;"> 
                <option name="organizacoes-opt" value="" selected>Selecione</option>
                @foreach ($Organizacoes as $Organizacao)
                    <option name="organizacoes-opt" value="{{ $Organizacao->domain}}">{{ $Organizacao->name}}</option>
                @endforeach
            </select> 
        </form>  
    </div> 
@else
    <div class="container">
        <h1>Estatísticas Avançadas</h1>
        <h3>Selecione o Gabinete</h3>
        <form id="form-pesquisa" action="{{route('estatisticas.pesquisa')}}" method="POST">
            @csrf
            <select id="select-gab" name="select-gab" class="form-control custom-select custom-select-lg col-lg-5" style="margin-bottom: 15px;"> 
                <option name="organizacoes-opt" value="" selected>Selecione</option>
                @foreach ($Organizacoes as $Organizacao)  
                    <option name="organizacoes-opt" value="{{$Organizacao->domain}}" @if($Organizacao->domain==$domain) selected @endif>{{ $Organizacao->name}}</option>
                @endforeach
            </select> 
        </form>  
        <fieldset style="font-size:1.1rem !important;">
            <!--<h4>Dados do Gabinete</h4>-->
            <h4>Armazenamento do gabinete:</h4>
            Fotos: {{$tamanhoFoto}}
            <br>
            Documentos: {{$tamanhoDocumento}}
            <br>
            Espaço Total: {{$tamanhoTotal}}
        </fieldset>
    </div> 
@endif


<script type="text/javascript" defer> 
    $('#select-gab').change(function(){
        var id= $(this).val();
        $('#form-pesquisa').submit();
    });
</script>
@endsection

