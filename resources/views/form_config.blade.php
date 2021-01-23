@extends('layouts.app')


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
            <form class="form" method="post" action={{route('usuario.update', Auth::user()->id)}}>
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
                        <label class="col-form-label negrito">Login</label>
                        <input id="user_name" type="text" name="user_name" class="form-control" value="{{Auth::user()->user_name}}" disabled > 
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label negrito">E-mail</label>
                        <input id="email" type="text" name="email" class="form-control" value="{{Auth::user()->email}}"> 
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
                    <div class="form-group col-md-8">
                        <label class="col-form-label negrito">Cor do Sistema</label>
                        <div class="input-group-append">
                        <div id="seletor" class="seletor"></div>
                        <button class="btn-seta" type="button" onclick="mostrarCors()"><img id="img-seta" src="{{asset("utils/seta.png")}}"style="height:35px; width:35px;"></button>
                                <div id="cores" hidden>
                                    <button class="btn btn-outline-secondary btn-purple btn-color" type="button" onclick="purpleChoice()"></button>
                                    <button class="btn btn-outline-secondary btn-dark-purple btn-color" type="button" onclick="darkPurpleChoice()"></button>
                                    <button class="btn btn-outline-secondary btn-indigo btn-color" type="button" onclick="indigoChoice()"></button>
                                    <button class="btn btn-outline-secondary btn-blue btn-color" type="button" onclick="blueChoice()"></button>
                                    <button class="btn btn-outline-secondary btn-teal btn-color" type="button" onclick="tealChoice()"></button>
                                    <button class="btn btn-outline-secondary btn-green btn-color" type="button" onclick="greenChoice()"></button>
                                    <button class="btn btn-outline-secondary btn-brown btn-color" type="button" onclick="brownChoice()"></button>
                                    <button class="btn btn-outline-secondary btn-grey btn-color" type="button" onclick="greyChoice()"></button>
                                    <button class="btn btn-outline-secondary btn-blue-grey btn-color" type="button" onclick="blueGrayChoice()"></button>
                                </div>
                            </div>
                        </div>
                </div>

                <input hidden id="corSystem" name="corSystem">

                <div class="form-row">
                    <div class="form-group col-md-6" style="display:flex;justify-content:center;align-items:center;">
                        <div>
                            <button id="btn-alterar" type="submit" class="btn btn-primary">Alterar</button>
                            <a href="javascript:history.back()" class="btn btn-primary">Voltar</a>
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
