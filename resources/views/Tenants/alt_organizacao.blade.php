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
                    <label class="col-form-label">Dominio</label>
                    <input id="domain" type="text" name="domain" class="form-control"  value="{{$organizacao->domain}}"> 
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="col-form-label">Database</label>
                    <input id="bd_database" type="text" name="bd_database" class="form-control" value="{{$organizacao->bd_database}}"> 
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="col-form-label">Host</label>
                    <input id="bd_hostname" type="text" name="bd_hostname" class="form-control" value="{{$organizacao->bd_hostname}}"> 
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
                    <input id="bd_password" type="password" name="bd_password" class="form-control" value="{{$organizacao->bd_password}}"> 
                </div>
            </div>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Editar
            </button>
            @include('Tenants/modals/confirma_alteracao')
        </form>
    </div>
</div>
@endsection
