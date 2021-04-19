<head>
    <title>Database não encontrada</title>
    <html lang=”pt-br”>
        
    <script type='text/javascript' defer>
        console.log("entrei");
        function mostra(element){
            document.getElementById("solucoes").hidden=!element.hidden;
        }
    </script>
    <link href="{{ asset('css/404.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="box">
            <h1>500</h1>
        </div>
    </div>
    <div style="display:flex;justify-content:center;align-items:center;">
        <h2>Base de dados não pode ser conectada</h2>
    </div>
    <div style="display:flex;justify-content:center;align-items:center;">
        <p>O sistema não pode se conectar a base de dados.
            <br>
            Contate o administrador do sistema para resolver o problema.
            <br>
            <a href="#" onclick="mostra(document.getElementById('solucoes'))">Possíveis soluções</a>
        </p>
    </div>
    <div style="display:flex;justify-content:center;align-items:center;">
        <p id="solucoes" hidden>
            <b style="font-size:18px;">Usuário do banco de dados inválido</b>:
            <br>
            Verifique se o usuário e senha cadastrado no gabinete são válidos
            <br>
            e que possua os privilégios necessários.
        </p>
    </div>

    <div style="display:flex;justify-content:center;align-items:center;">
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="bt bt-vd">Voltar Início</button>
        </form>
    </div>
</body>
