@extends('layouts.app')


@section('content')
<head>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/forms.css') }}" rel="stylesheet">
<!-- Scripts -->
<script src="{{ asset('js/exclusao.js') }}" defer></script>
</head>
<body>


    <div id="situcao_atendimento" class="container">
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
             @include('alteracao/alt_tipoAtendimento')
        @else
            @include('cadastro/cad_tipoAtendimento')
        @endif

        <!--lISTAGEM DOS atendimentos ja cadastrados-->
        <div class="table-of row">
        <table id="tb_situacao_Atendimento" class="mtab table table-striped table-hover table-responsive-lg" width="100%">
            <thead class="thead-dark">
                <tr>
                    <th>Tipo de Atendimento</th>
                    <th>Status</th>
                    <th style="text-align: center;">Alterar</th>
                    <th style="text-align: center;">Excluir</th>
                </tr>
            </thead>
            @foreach($tipoAtendimento as $tipoA)
            <tbody>
                <td  width='60%'>{{$tipoA->nom_tipo}}</td>
                <td  width='20%'>
                    @if($tipoA->ind_tipo == 'A'){{"Ativo"}}
                    @else {{"Inativo"}} 
                    @endif   
                </td>
                <td  width='10%' style="text-align: center;">
                    <a href="{{route('tipoAtendimento.edit',  $tipoA->cod_tipo)}}"><img src="{{asset('utils/alterar.png')}}" alt="Alterar"></a>
                </td>
                <td  width='10%' style="text-align: center;">
                        <form action="{{route('tipoAtendimento.destroy', "id_exclusao")}}" method="post">
                            @csrf
                            @method('DELETE')
                            <a type="button" data-toggle="modal" data-target="#modalExclusao" data-id_exclusao="{{$tipoA->cod_tipo}}"><img src="{{asset('utils/excluir.png')}}" alt="Excluir"></a>
                            @include('exclusao/exclusao_modal')
                        </form>
                 </td>
            </tbody>
            @endforeach
        </table>
        </div> 
        {!! $tipoAtendimento->links() !!} <!-- pacote coletive forms. Criar os links a serem passados da tabela -->  
             
</div>
</body>

@endsection