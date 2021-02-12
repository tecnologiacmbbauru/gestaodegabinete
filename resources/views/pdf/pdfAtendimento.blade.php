<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Atendimentos</title>
    <style type="text/css">
        h3 {text-align: center; margin: 0px}
        h4 {text-align: center; margin: 0px}
        p {text-align: center; margin: 0px}
    </style>
</head>
<body>
    <h3>{{$agentePolitico->cargoPolitico->nom_car_pol}} {{$agentePolitico->nom_vereador}}</h3>
    <h4>{{$agentePolitico->nom_orgao}}</h4>
    <p>
        {{$agentePolitico->nom_endereco}} {{$agentePolitico->nom_numero}} - {{$agentePolitico->nom_complemento}} - {{$agentePolitico->nom_cidade}}/{{$agentePolitico->nom_estado}} - @if($agentePolitico->num_cep!=null)CEP: {{$agentePolitico->num_cep}}@endif
    </p>
    <h3 style="margin:10px;text-decoration: underline">Gestão de Gabinete - Atendimento</h3>

    <table>
        <tr>
          <td><strong>Data:</strong></td>
          <td>{{date('d/m/Y', strtotime($atendimentos->dat_atendimento))}}</td>
        </tr>
        <tr>
          <td><strong>Pessoa:</strong></td>
          <td>{{$atendimentos->pessoa->nom_nome}}</td>
        </tr>
        <tr>
          <td><strong>CPF:</strong></td>
          <td>{{$atendimentos->pessoa->cod_cpf_cnpj}}</td>
        </tr>
        <tr>
          <td><strong>RG:</strong></td>
          <td>{{$atendimentos->pessoa->cod_rg}}</td>
        </tr>
        <tr>
          <td><strong>Tipo de Atendimento:</strong></td>
          <td>{{$atendimentos->tipoAtendimento->nom_tipo}}</td>
        </tr>
        <tr>
          <td><strong>Situação do Atendimento:</strong></td>
          <td>{{$atendimentos->statusAtendimento->nom_status}}</td>
        </tr>
        <tr>
          <td><strong>Detalhes:</strong></td>
        </tr>
    </table>
        {{$atendimentos->txt_detalhes}}
</body>
</html>