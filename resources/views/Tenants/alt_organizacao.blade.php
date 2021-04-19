@extends('Tenants.layouts.app')

@section('content')
<div class="container">
    <div>
        <h2>Alteração do Gabinete {{$organizacao->name}}</h2>
        <form class="form" method="post" action={{route('organizacao.update',$organizacao->id)}}>
            @method('PUT')
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="col-form-label">Nome</label>
                    <input id="name" type="text" name="name" class="form-control" value="{{$organizacao->name}}"> 
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="col-form-label">Banco de dados (database)</label>
                    <input id="bd_database" type="text" name="bd_database" class="form-control" value="{{$organizacao->bd_database}}"> 
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
                        <input id="bd_hostname" type="text" name="bd_hostname" class="form-control" value="{{$organizacao->bd_hostname}}"> 
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label">Porta</label>
                        <input id="bd_port" type="text" name="bd_port" class="form-control"  value="{{$organizacao->bd_port}}"> 
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label">Usuario</label>
                        <input id="bd_username" type="text" name="bd_username" class="form-control" value="{{$organizacao->bd_username}}"> 
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label">Senha</label>
                        @php 
                            //descriptografação da senha para mostrar na tela
                            use Illuminate\Support\Facades\Crypt;
                            $senha  = Crypt::decryptString($organizacao->bd_password);
                        @endphp
                        <input id="bd_password" type="password" name="bd_password" class="form-control" value="{{$senha}}"> 
                    </div>
                </div>
            </div>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmaAltDb">
                Editar
            </button>
            @include('Tenants/modals/confirma_alteracao')
        </form>
    </div>
</div>
<script>
    function showConfig(){
        document.getElementById('conf-db').hidden =  !document.getElementById('conf-db').hidden;
    }
</script>
@endsection
