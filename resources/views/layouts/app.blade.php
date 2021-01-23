<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name', 'Gestão de Gabinete') }}</title>

    <!-- Scripts -->
   <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts 
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">-->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/gabinete.css') }}" rel="stylesheet">
    <!--Checa no banco de dados para escolher qual sera a cor do sistema-->
        <link href="{{ asset('css/coresSistema/inicio-cores.css') }}" rel="stylesheet">
@auth  
    @if(Auth::user()->corSystem=="blue")
        <link href="{{ asset('css/coresSistema/blue.css') }}" rel="stylesheet">
    @elseif(Auth::user()->corSystem=="blue-grey")
        <link href="{{ asset('css/coresSistema/blue-grey.css') }}" rel="stylesheet">
    @elseif(Auth::user()->corSystem=="brown")
        <link href="{{ asset('css/coresSistema/brown.css') }}" rel="stylesheet">
    @elseif(Auth::user()->corSystem=="dark-purple")
        <link href="{{ asset('css/coresSistema/dark-purple.css') }}" rel="stylesheet">
    @elseif(Auth::user()->corSystem=="green")
        <link href="{{ asset('css/coresSistema/green.css') }}" rel="stylesheet">
    @elseif(Auth::user()->corSystem=="grey")
        <link href="{{ asset('css/coresSistema/grey.css') }}" rel="stylesheet">
    @elseif(Auth::user()->corSystem=="indigo")
        <link href="{{ asset('css/coresSistema/indigo.css') }}" rel="stylesheet">
    @elseif(Auth::user()->corSystem=="purple")
        <link href="{{ asset('css/coresSistema/purple.css') }}" rel="stylesheet">
    @elseif(Auth::user()->corSystem=="teal")
        <link href="{{ asset('css/coresSistema/teal.css') }}" rel="stylesheet">
    @endif
@endauth

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light nav-principal">
        <div class="container">
            <a class="navbar-brand negrito" href="{{ url('/home') }}">
                <b>Gestão de Gabinete</b>
                {{--config('app.name', "Gestão de Gabinete")--}}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}</a>
                    </li>
                @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            {{--Iten de Configuração do Usuario--}}
                            <a class="dropdown-item" href="{{route('usuario.edit',Auth::user()->id)}}">Configurações</a>
                            
                            {{--Iten de logout--}}
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Sair') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
            @endguest
        </div>
        </nav>
    </div>
    @auth 
        <nav class="navbar navbar-expand-md navbar-light systemColor nav-segundaria">
            <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#segundaNav" aria-controls="segundaNav" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="segundaNav"> 
                <ul class="navbar-nav mr-auto">
                    <li class = "nav-item">
                        <a class="nav-link negrito" href="{{ route('agenda') }}">{{ __('Agenda') }}</a>
                    </li>
                    <li class = "nav-item">
                        <a class="nav-link negrito" href="{{ route('pessoa.index') }}">{{ __('Pessoa') }}</a>
                    </li>
                    <li class = "nav-item">
                        <a class="nav-link negrito" href="{{ route('atendimento.index') }}">{{ __('Atendimento') }}</a>
                    </li>
                    <li class = "nav-item">
                        <a class="nav-link negrito" href="{{ route('documento.index') }}">{{ __('Documento') }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle negrito" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Cadastros
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item negrito" href="{{ route('agentePolitico.index') }}">{{ __('Agente Político') }}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item negrito" href="{{ route('cargoPolitico.index') }}">{{ __('Cargo Político') }}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item negrito" href="{{ route('tipoAtendimento.index') }}">{{ __('Tipo de Atendimento') }}</a>
                        <a class="dropdown-item negrito" href="{{ route('statusAtendimento.index') }}">{{ __('Situação do Atendimento') }}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item negrito" href="{{ route('tipoDocumento.index') }}">{{ __('Tipo de Documento') }}</a>
                        <a class="dropdown-item negrito" href="{{ route('situacaoDoc.index') }}">{{ __('Situação do Documento') }}</a>
                        <a class="dropdown-item negrito" href="{{ route('unidadeDocumento.index') }}">{{ __('Unidade Administrativa (Documento)') }}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item negrito" href="{{ route('chaveAgenda.index') }}">{{ __('Chaves - Google Agenda') }}</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle negrito" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Relatórios
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item negrito" href="{{ route('relatorio.retornaAtendimento') }}">{{ __('Atendimentos') }}</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item negrito" href="{{ route('relatorio.retornaDocumento') }}">{{_('Documentos')}}</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item negrito" href="{{route('relatorio.retornaEtiqueta')}}" }}>Etiquetas de Aniversariantes</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle negrito" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ajuda
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item negrito" href="{{ route('sobre') }}" }}>Sobre o Sistema</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item negrito" href="{{ route('manual') }}" }}>Manual do Usuário</a>
                        </div>
                    </li>  
                </ul>
            </div>
            </div>
        </nav>
    @endauth

    <main class="py-4">
        @yield('content')
    </main>

</body>

<footer class="footer">Desenvolvido pelo Serviço Tecnológico em Informática da <a class="a-footer" href="https://www.bauru.sp.leg.br/" target="blank">Câmara Municipal de Bauru</a> / São Paulo em software livre e aberto.</footer>
</html>