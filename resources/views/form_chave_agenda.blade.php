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
        <!--lstagem das ja cadastradas-->
        <div class="table-of row">
            <table id="tb_situacao_Atendimento" class="mtab table table-striped table-hover table-responsive-lg" cellspacing="10" width="100%">
                <thead class="thead-dark">
                    <tr>
                        <th>Nome da Agenda</th>
                        <th>Google Calendar API</th>
                        <th>Google Calendar ID</th>
                        <th style="text-align: center;">Alterar</th>
                        <th style="text-align: center;">Excluir</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($Chaves as $Chave)
                    <tr>
                        <td  width='20%'>{{$Chave->name}}</td>
                        <td  width='20%'>{{$Chave->api_key}}</td>
                        <td  width='20%'>{{$Chave->calendar_id}}</td>
                        <td  width='10%' style="text-align: center;">
                            <a href="{{route('chaveAgenda.edit', $Chave->id )}}"><img src="{{asset('utils/alterar.png')}}" alt="Alterar"></a>
                        </td>
                        <td  width='10%' style="text-align: center;">
                                <form action="{{route('chaveAgenda.destroy', "id_exclusao")}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a type="button" data-toggle="modal" data-target="#modalExclusao" data-id_exclusao="{{$Chave->id}}"><img src="{{asset('utils/excluir.png')}}" alt="Excluir"></a>
                                    @include('exclusao/exclusao_modal')
                                </form>
                            </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
            {!! $Chaves->links() !!} <!-- pacote coletive forms. Criar os links a serem passados da tabela -->


</div>
</body>

@endsection
