@extends('Tenants.layouts.app')

@section('content')

<div class="container">
    <div>
        <h1>Cadastrar de novo Gabinete</h1>
        <form class="form" method="post" action={{route('organizacao.store')}}>
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="col-form-label">Nome</label>
                    <input id="name" type="text" name="name" class="form-control" required maxlength="100"> 
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="col-form-label">Dominio</label>
                    <input id="domain" type="text" name="domain" class="form-control" placeholder="Exemplo: gab01" required maxlength="50"> 
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="col-form-label">Database</label>
                    <input id="bd_database" type="text" name="bd_database" class="form-control" placeholder="Exemplo: gab01" required maxlength="50"> 
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6" style="margin-left:20px;">
                    <input class="form-check-input" type="checkbox" id="altear-db" name="altear-db" onclick="showConfig()">
                    <label class="form-check-label" for="alterar-db">Alterar configurações da database</label>
                </div>
            </div>
            <div id="conf-db" hidden>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label">Host</label>
                        <input id="bd_hostname" type="text" name="bd_hostname" class="form-control" value="{{env('DB_HOST')}}"> 
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label">Porta</label>
                        <input id="bd_port" type="text" name="bd_port" class="form-control" value="{{env('DB_PORT')}}"> 
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label">Usuario</label>
                        <input id="bd_username" type="text" name="bd_username" class="form-control" value="{{env('DB_USERNAME')}}"> 
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label">Senha</label>
                        <input id="bd_password" type="password" name="bd_password" class="form-control" value=""> 
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6" style="margin-left:20px;">
                    <input class="form-check-input" type="checkbox" id="create_db" name="create_db" checked>
                    <label class="form-check-label" for="div_resposta">Criar Banco de dados?</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
</div>
@endsection

<script>
    function showConfig(){
        document.getElementById('conf-db').hidden =  !document.getElementById('conf-db').hidden;
    }
</script>

