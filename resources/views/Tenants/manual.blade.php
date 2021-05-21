@extends('Tenants.layouts.app')


@section('content')
<head>

</head>
<body>
    <h1 class="titulo" style="text-align:center;">Manual do Administrador</h1>
    <div class="container">
            <p>
                Para conhecer mais sobre o software de Gestão de Gabinete, leia o Manual do Administrador nesta página ou clique <a href="{{asset('utils/Manual_do_Administrador.pdf')}}">aqui</a> para acessar o documento.
                <iframe style="width:100%; height:500px" src="{{asset('utils/Manual_do_Administrador.pdf')}}"></iframe>
            </p>
    </div>
</body>

@endsection
