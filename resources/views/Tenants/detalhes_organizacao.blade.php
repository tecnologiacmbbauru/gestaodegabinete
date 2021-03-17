@extends('Tenants.layouts.app')
<!--Estilo da pagina-->
<style type="text/css">
    body{
        font-size: 16px !important;
    }
    table{
        font-family: 'Times New Roman', Times, sans-serif;
        font-size: 20px;
        font-weight: 700;
        line-height: 30px;
    }

    .det-gab{
        color: rgb(102, 102, 102);
    }
</style>
@section('content')
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
    <div class="row">
        <div class="col-md-6">
            <h2>Detalhes do Gabinete</h2>
            <table>
                <tr>
                    <td>Nome</td>
                    <td class="det-gab">{{$organizacao->name}}</td>
                </tr>
                <tr>
                    <td>Dominio</td>
                    <td class="det-gab">{{$organizacao->domain}}</td>
                </tr>
                <tr style="border-top:1px solid rgb(26, 25, 25);">
                    <td colspan="2">Banco de dados</td>
                </tr>
                <tr>
                    <td>Database</td>
                    <td class="det-gab">{{$organizacao->bd_database}}</td>
                </tr>
                <tr>
                    <td>Host</td>
                    <td class="det-gab">{{$organizacao->bd_hostname}}</td>
                </tr>
                <tr>
                    <td>Usuario</td>
                    <td class="det-gab">{{$organizacao->bd_username}}</td>
                </tr>
                <tr>
                    <td>Senha</td>
                    <td class="det-gab">{{$organizacao->bd_password}}</td>
                </tr>
                <tr style="border-top:1px solid rgb(26, 25, 25);">
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td style="font-size:14px;">Criado em</td>
                    <td class="det-gab" style="font-size:14px;">{{date('d/m/Y', strtotime($organizacao->created_at))}}</td>
                </tr>
                
                <tr>
                    <td style="font-size:14px;">Ultima autalização</td>
                    <td class="det-gab" style="font-size:14px;">{{date('d/m/Y', strtotime($organizacao->updated_at))}}</td>
                </tr>
            </table>
            
            <form action="{{route('organizacao.destroy', $organizacao->id)}}" method="post">
                @csrf
                @method('DELETE')
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exclusaoModal">
                    Excluir Gabinete: {{$organizacao->name}}
                </button>
                @include('Tenants/modals/confirma_exclusao')
            </form>
        </div>
        <div class="col-md-6">
            <h2>Usuários de: {{$organizacao->name}}</h2>
            @if ($usuarios->isEmpty())
                Nenhum usuários cadastrado
                <br>
                <a data-toggle="modal" data-target="#usuarioPadrao" style="text-decoration:underline; color:#37474f;">Deseja criar usuarios padrão?</a>
                @include('Tenants/modals/confirma_usuario_padrao')
                

                <form class="form" method="post" action="{{route('usuario.cadastro')}}" style="margin-top:10px">
                    @csrf
                    <a class="btn btn-add col-md-6" data-toggle="modal" data-target="#cadUsuario">Cadastrar novo usario</a>
                    @include('Tenants/modals/cadastro_usuario')
                </form>

            @else
                @foreach ($usuarios as $usuario)
                    <div class="card" style="margin-bottom:10px;">
                        <div class="card-header" style="background-color:#607d8b; color:white;">
                            <a class="btn"  id="btn-alteracao-user" style="float:right; padding:3px;" data-userid="{{$usuario->id}}"><img src="{{asset('utils/reset-senha.png')}}" alt="Reset-senha" title="Resetar Senha"></a>                   
                            {{$usuario->name}} 
                            <a class="btn" id="btn-exclusao-user" style="float:right; padding:3px;" data-userid="{{$usuario->id}}"><img src="{{asset('utils/delete-usuario.png')}}" alt="Excluir" title="Excluir"></a>
                        </div>
                        <div class="card-body">
                            <b>Dominio:</b> {{$usuario->domain}} <b style="padding-left:20px;">Login:</b> {{$usuario->user_name}} <b style="padding-left:20px;">Email:</b> {{$usuario->email}}
                        </div>
                    </div>
                @endforeach

                <!--Modais de confirmação para resetar senha e excluir usuario-->
                @include('Tenants/modals/reset-senha')
                @include('Tenants/modals/confirmar_exclusao_user')

                <form class="form" method="post" action="{{route('usuario.cadastro')}}">
                    @csrf
                    <a class="btn btn-add" data-toggle="modal" data-target="#cadUsuario">Cadastrar novo usario</a>
                    @include('Tenants/modals/cadastro_usuario')
                </form>
            @endif
        </div>
    </div>
</div>
<script>
    $(document).on('click','#btn-exclusao-user',function(){
        var userID=$(this).attr('data-userid');
        $('#user_id').val(userID); 
        $('#usuarioExclusao').modal('show'); 
    });
    $(document).on('click','#btn-alteracao-user',function(){
        var userID=$(this).attr('data-userid');
        $('#alter_id').val(userID); 
        $('#resetSenha').modal('show'); 
    });
</script>
@endsection

