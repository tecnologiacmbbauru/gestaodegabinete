@extends('Tenants.layouts.app')


@section('content')
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

        <div class="form-inline">
            <h1 style="display: inline">Gabinetes</h1> 
        </div>

        <fieldset class="form-inline">
            @foreach ($organizacoes as $organizacao)
            <div class="card" style="width: 18rem; margin:5px;">
                <div class="card-body">
                  <h5 class="card-title" style="font-weight:bold">{{$organizacao->name}}</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Criado em: {{date('d/m/Y', strtotime($organizacao->created_at))}}</h6>
                    <p class="card-text">
                        <b>Banco de dados:</b> {{$organizacao->bd_database}}
                        <br>
                        <b>Host:</b> {{$organizacao->bd_hostname}}
                    </p>
                  <u style="float: left"><a href="{{route('organizacao.show',$organizacao->id)}}" class="card-link">Detalhes</a></u>
                  <u style="float: right"><a href="{{route('organizacao.edit',$organizacao->id)}}" class="card-link">Editar</a></u>
                </div>
              </div>
            @endforeach
        </fieldset>
        <a class="btn btn-add" href="{{route('organizacao.index','cadastro')}}" style="float: left;"> 
            Adicionar
        </a>
    </div>
</body>

@endsection
