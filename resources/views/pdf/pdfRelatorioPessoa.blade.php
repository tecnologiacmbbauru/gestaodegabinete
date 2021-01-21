<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Atendimentos</title>
    <style type="text/css">
        h3 {text-align: center; margin: 0px}
        h4 {text-align: center; margin: 0px}
        p {text-align: center; margin: 0px}
        table {
            border-collapse:collapse;
            table-layout:auto;
            width: 100%;
        }

        td{
            border: 1px solid;
            border-color: #1C1C1C;
            text-align: center;
            padding:3px;
        }
        th {
            text-align: center;
            border: 1px solid;
            border-color: #1C1C1C;
        }
        .sem_borda{
          border-right:0px;
	      border-left:0px;
          height:1px;
        }
        /*.;
        TABELA ZEBRADA
        tabela tbody tr:nth-child(even) {
            background-color: #DCDCDC;
        }*/
    </style>
</head>
<body>
    <h3>{{$agentePolitico->nom_vereador}}</h3>
    <h4>{{$agentePolitico->nom_orgao}}</h4>
    <p>
        {{$agentePolitico->nom_endereco}} {{$agentePolitico->nom_numero}} - {{$agentePolitico->nom_complemento}} - {{$agentePolitico->nom_cidade}}/{{$agentePolitico->nom_estado}} - @if($agentePolitico->num_cep!=null)CEP: {{$agentePolitico->num_cep}}@endif
    </p>
    <h3 style="margin:10px;text-decoration: underline">Gestão de Gabinete - Relatório de Pessoas</h3>
    
    <table class="tabela">
        <tr>
          <th>Nome</th>
          <th>Doc.Identificação</th>
          <th>Telefone(s)</th>
          <th>Endereço</th>
        </tr>
      <tbody>
      @php $i=0; @endphp
      @foreach($pessoas as $pessoa)
      @php $i++; @endphp
      <tr>
            <td>{{$pessoa->nom_nome}}
                <br>
                {{$pessoa->nom_apelido}}
            </td>
            <td>
                @if($pessoa->ind_pessoa=='PF')
                    <strong>CPF:</strong>
                    {{$pessoa->cod_cpf_cnpj}}
                    <br>
                    <strong>RG:</strong>
                    {{$pessoa->cod_rg}}                    
                 @else
                    <strong>CNPJ:</strong> 
                    {{$pessoa->cod_cpf_cnpj}} 
                    <br>
                    <strong>IE:</strong>
                    {{$pessoa->cod_ie}}                      
                 @endif
            </td>
            <td>
                {{$pessoa->num_ddd_tel}}  {{$pessoa->num_tel}}
                <br>
                {{$pessoa->num_ddd_cel}}  {{$pessoa->num_cel}}
            </td>
            <td>
                {{$pessoa->nom_endereco}} {{$pessoa->nom_numero}}
                <br>@if($pessoa->nom_bairro!=null){{$pessoa->nom_bairro}},@endif
                @if($pessoa->nom_cidade!=null){{$pessoa->nom_cidade}}/{{$pessoa->nom_estado}}@endif
            </td>
    </tr>
    @endforeach
    </tbody>
    </table>    
    <br>
    <label>Total de Registros:{{$i}}</label>
    <script type='text/php'>
      if (isset($pdf)) {               
        $pdf->page_text(540, $pdf->get_height()-25, "{PAGE_NUM} de {PAGE_COUNT}", null, 12, array(0,0,0));
      }
    </script>
</body>
</html>