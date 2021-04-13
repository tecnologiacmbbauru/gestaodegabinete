@extends('Tenants.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" style="text-align: center;">
            <h1>Painel Administrativo: Gestão de Gabinete</h1>
        </div>
        <p>
            <img src="{{asset('utils/company.png')}}" alt="Imagem de Empresa com pessoas"  title="Recursos Tenants">
        </p>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-4" style="margin-bottom:10px">
            <div class="card-system">
                <p class="title">Total de Gabinetes</p>
                <br>
                <p class="number">{{$totalReg}}</p>
            </div>
        </div>
        <div class="col-md-4" style="margin-bottom:10px">
            <div class="card-system">
                <p class="title">Total de Usuários</p>
                <br>
                <p class="number">{{$totalUser}}</p>
            </div>
        </div>
        <div class="col-md-4" style="margin-bottom:10px;">
            <div class="card-system">
                <p class="title">Estatísticas de Armazenamento</p>
                <a class="btn-transparente" href="{{route('tenant.estatisticas.index')}}"><img src="{{asset('utils/estatisticas.png')}}" alt="Estatisticas"></a>
            </div>
        </div>
    </div>
</div>
@endsection
