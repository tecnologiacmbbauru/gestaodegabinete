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
            border-collapse: collapse;
        }

        td{
            border: 1px solid;
            border-color: #1C1C1C;
            text-align: center;
            padding:5px;
        }
        th {
            text-align: center;
            border: 1px solid;
            border-color: #1C1C1C;
        }
        .sem_borda{
          border-right:0px;
	        border-left:0px;
          height : 1px;
        }
        /*Escolher se tabela zebrada ou pulando*/
       .tabela tbody tr:nth-child(4n) {
            background-color: #DCDCDC;
        }
        .tabela tbody tr:nth-child(4n-1) {
            background-color: #DCDCDC;
        }

    </style>
</head>
<body>
    <h3>{{$agentePolitico->nom_vereador}}</h3>
    <h4>{{$agentePolitico->nom_orgao}}</h4>
    <p>
        {{$agentePolitico->nom_endereco}}, {{$agentePolitico->nom_numero}} - {{$agentePolitico->nom_complemento}} - {{$agentePolitico->nom_cidade}}/{{$agentePolitico->nom_estado}} - CEP:{{$agentePolitico->nom_cep}}
    </p>
    <h3 style="margin:10px;text-decoration: underline">Gestão de Gabinete -Relatório de Atendimentos</h3>

    <table class="tabela">
        <tr>
          <th>Data:</th>
          <th>Pessoa:</th>
          <th>Telefone(s):</th>
          <th>Localização:</th>
          <th>Tipo:</th>
          <th>Situação:</th>
        </tr>
        <tr><td colspan="6" class="sem_borda"></td></tr>
      <tbody>
      @php $i=0; @endphp
      @foreach($atendimentos as $atendimento)
      @php $i++; @endphp
      <tr>
          <td>{{date('d/m/Y', strtotime($atendimento->dat_atendimento))}}</td>
          @if($atendimento->GAB_PESSOA_cod_pessoa!=null)
            <td>
              {{$atendimento->pessoa->nom_nome}}
              <br>
              {{$atendimento->pessoa->cod_cpf_cnpj}}
              <br>
              {{$atendimento->pessoa->cod_rg}}
            </td>
            <td>
              {{$atendimento->pessoa->num_ddd_tel}}-{{$atendimento->pessoa->num_tel}}
              <br>
              {{$atendimento->pessoa->num_ddd_cel}}-{{$atendimento->pessoa->num_cel}}
            </td>
            <td>
              {{$atendimento->pessoa->nom_bairro}}
              <br>
              {{$atendimento->pessoa->nom_cidade}}-{{$atendimento->pessoa->nom_estado}}
            </td>
          @else
            <td>Não existe pessoa relacionada</td>
            <td>-</td>
            <td>-</td>
          @endif
          <td>{{$atendimento->tipoAtendimento->nom_tipo}}</td>
          <td>{{$atendimento->statusAtendimento->nom_status}}</td>
          <tr>
            <td>Detalhes:</td>
            <td colspan="5" style="text-align: justify; padding: 10px;">{{$atendimento->txt_detalhes}}</td>
          </tr>
    </tr>
    <!--<tr><td colspan="6" class="sem_borda"></td></tr>-->
    @endforeach
    </tbody>
    </table>
    <label>Total de Registros:{{$i}}</label>
    <script type='text/php'>
      if (isset($pdf)) {               
        $pdf->page_text(540, $pdf->get_height()-25, "{PAGE_NUM} de {PAGE_COUNT}", null, 12, array(0,0,0));
      }
    </script>
</body>
</html>
