@extends('Tenants.layouts.app')

@section('content')

<div class="container">
    <div id="carregando" hidden style="display:flex;justify-content:center;align-items:center;">
        <div>
            <h4>Cadastrando novo gabinete...</h4>
            <img src="{{asset('utils/carregando.gif')}}" style="padding-left:50px;">
            <h5 style="padding-right:40px;">Este processo pode levar alguns minutos...</h5>
        </div>
    </div>
    <form id="cad-gab" class="form" method="post" action={{route('organizacao.store')}}>
        <h1>Cadastro de Gabinete</h1>
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="col-form-label">Nome</label>
                <input id="name" type="text" name="name" class="form-control" required maxlength="100"> 
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="col-form-label">Banco de dados (database)</label>
                <input id="bd_database" type="text" name="bd_database" class="form-control" placeholder="Exemplo: gab_01" required maxlength="50"> 
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6" style="margin-left:20px;">
                <input class="form-check-input" type="checkbox" id="altear-db" name="altear-db" onclick="showConfig()">
                <label class="form-check-label" for="alterar-db">Alterar configurações do banco de dados</label>
            </div>
        </div>
        <div id="conf-db" hidden>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="col-form-label">Host</label>
                    <input id="bd_hostname" type="text" name="bd_hostname" class="form-control" value="{{env('DB_HOST')}}" required maxlength="50"> 
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="col-form-label">Porta</label>
                    <input id="bd_port" type="text" name="bd_port" class="form-control" value="{{env('DB_PORT')}}" required maxlength="50"> 
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="col-form-label">Usuário</label>
                    <input id="bd_username" type="text" name="bd_username" class="form-control" value="{{env('DB_USERNAME')}}" required maxlength="50"> 
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="col-form-label">Senha</label>
                    <input id="bd_password" type="password" name="bd_password" class="form-control" value="" maxlength="50"> 
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6" style="margin-left:20px;">
                <input class="form-check-input" type="checkbox" id="create_db" name="create_db" checked>
                <label class="form-check-label" for="div_resposta">Criar Banco de dados?</label>
            </div>
        </div>
        <button onclick="cadastrar()" type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>
<script>
    function showConfig(){
        document.getElementById('conf-db').hidden =  !document.getElementById('conf-db').hidden;
    }
    function cadastrar(){
        //Primeiro verifica se todos campos estão preenchidos
        if(document.getElementById('name').value===""){
            document.getElementById('name').focus;
        }else if(document.getElementById('domain').value===""){
            document.getElementById('domain').focus;
        }else if(document.getElementById('bd_database').value===""){
            document.getElementById('bd_database').focus;
        }else if(document.getElementById('bd_database').value===""){
            document.getElementById('bd_hostname').focus;
        }else if(document.getElementById('bd_hostname').value===""){
            document.getElementById('bd_port').focus;
        }else if(document.getElementById('bd_port').value===""){
            document.getElementById('bd_username').focus;
        }else if(document.getElementById('bd_username').value===""){
            document.getElementById('bd_database').focus;
        }else{
            event.preventDefault();
            document.getElementById('app').hidden=true;
            document.getElementById('cad-gab').hidden=true;
            document.getElementById('carregando').hidden=false;
            document.getElementById('cad-gab').submit();
        }
        
    }
</script>

@endsection


