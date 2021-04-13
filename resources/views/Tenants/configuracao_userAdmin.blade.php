@extends('Tenants/layouts.app')


@section('content')
<head>
<link href="{{ asset('css/config.css') }}" rel="stylesheet">
{{--Scripts--}}
<script src="{{asset('js/escolhaCor.js')}}" defer></script>
</head>
<body>
    <div class="container">
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
        <div class="div-configuracao">
            <div class="form-row">
                <div class="form-group col-md-6" style="display:flex;justify-content:center;align-items:center;">
                    <h1 class="titulo ">Configurações</h1> 
                </div>
            </div>   
            <form class="form" method="post" action={{route('usuario.editar', Auth::user()->id)}}>
                @method("PUT")
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label negrito">Nome</label>
                        <input id="name" type="text" name="name" class="form-control" value="{{Auth::user()->name}}"> 
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label negrito">Usuário</label>
                        <input id="user_name" type="text" name="user_name" class="form-control" value="{{Auth::user()->user_name}}"> 
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label negrito">E-mail</label>
                        <input id="email" type="email" name="email" class="form-control" value="{{Auth::user()->email}}"> 
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label negrito">Trocar Senha</label>
                        <input id="password" type="password" name="password" minlength="3" class="form-control"> 
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label negrito">Confirmar Nova Senha</label>
                        <input id="password-confirm" type="password" name="password-confirm" minlength="3" class="form-control" onkeyup="validarSenha()"> 
                        <label id="alert-senha" class="alert-obrigatorio" hidden="true">*Senhas digitadas não iguais</label>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6" style="display:flex;justify-content:center;align-items:center;">
                        <div>
                            <button id="btn-alterar" type="submit" class="btn btn-primary">Alterar</button>
                        </div>
                    </div>
                </div>   

            </form>
        </div>
    </div>
</body>

<script type="text/javascript">
    var password = document.getElementById("password"),confirm_password = document.getElementById("password-confirm");
    
    function validarSenha(){
        if(password.value != confirm_password.value) {
            document.getElementById("alert-senha").hidden=false;
            document.getElementById("btn-alterar").disabled=true;
        } else {
            document.getElementById("alert-senha").hidden=true;
            document.getElementById("btn-alterar").disabled=false;
        }
    }
</script>
@endsection
