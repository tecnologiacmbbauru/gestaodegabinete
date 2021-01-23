@extends('layouts.app')


@section('content')
<head>

</head>
<body>
    <h1 class="titulo" style="text-align:center;">Manual do Usuário</h1>
    <div class="container">
            <p>
                Para conhecer mais sobre o software de Gestão de Gabinete, leia o Manual do Usuário nesta página ou clique <a href="{{asset('utils/Manual_do_Usuario.pdf')}}">aqui</a> para acessar o documento.
                <iframe style="width:100%; height:500px" src="{{asset('utils/Manual_do_Usuario.pdf')}}"></iframe>
            </p>
    </div>
</body>

@endsection
