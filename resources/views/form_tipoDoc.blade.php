@extends('layouts.app')


@section('content')
<head>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/forms.css') }}" rel="stylesheet">
<!-- Scripts -->
<script src="{{ asset('js/exclusao.js') }}" defer></script>
</head>
<body>


    <div id="tipo_documentoo" class="container">
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
             @include('alteracao/alt_tipoDocumento')
        @else
            @include('cadastro/cad_tipoDocumento')
        @endif

        <!--lISTAGEM DOS atendimentos ja cadastrados-->
        <div class="table-of row">
        <table id="tb_tipo_documento" class="mtab table table-striped table-hover table-responsive-lg" width="100%">
            <thead class="thead-dark">
                <tr>
                    <th>Tipo de Documento</th>
                    <th>Status</th>
                    <th style="text-align: center;">Alterar</th>
                    <th style="text-align: center;">Excluir</th>
                </tr>
            </thead>
            <tbody>
            @foreach($tipoDocumento as $tipoDoc)
            <tr>
                <td  width='60%'>{{$tipoDoc->nom_tip_doc}}</td>
                <td  width='20%'>
                    @if($tipoDoc->ind_tip_doc == 'A'){{"Ativo"}}
                    @else {{"Inativo"}} 
                    @endif   
                </td>
                <td  width='10%' style="text-align: center;">
                    <a href="{{route('tipoDocumento.edit', $tipoDoc->cod_tip_doc)}}"><img src="{{asset('utils/alterar.png')}}" alt="Alterar"></a>
                </td>
                <td  width='10%' style="text-align: center;">
                        <form action="{{route('tipoDocumento.destroy', "id_exclusao")}}" method="post">
                            @csrf
                            @method('DELETE')
                            <a type="button" data-toggle="modal" data-target="#modalExclusao" data-id_exclusao="{{$tipoDoc->cod_tip_doc}}"><img src="{{asset('utils/excluir.png')}}" alt="Excluir"></a>
                            @include('exclusao/exclusao_modal')
                        </form>
                 </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div> 
        {!! $tipoDocumento->links() !!} <!-- pacote coletive forms. Criar os links a serem passados da tabela -->  
             
</div>
</body>

@endsection