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
          height:1px;
        }
        .tabela tbody tr:nth-child(even) {
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
    <h3 style="margin:10px;text-decoration: underline">Gestão de Gabinete - Relatório de Documentos</h3>
    <table class="tabela">
        <tbody>
        <tr>
            <th>Data:</th>
            <th>Número/Ano:</th>
            <th>Tipo:</th>
            <th>Situação:</th>
            <th>Unidade:</th>
            <th>Atendimento:</th>
            <th>Resposta:</th>
        </tr>
        @php $i=0; @endphp
        @foreach($documentos as $documento)
        @php $i++; @endphp
        <tr>
            <td>
                {{date('d/m/Y', strtotime($documento->dat_documento))}}
            </td>
            <td>
                {{$documento->nom_documento}}/{{$documento->dat_ano}}
            </td>
            <td>
                {{$documento->tipoDocumento->nom_tip_doc}}
            </td>
            <td>
                {{$documento->situacaoDoc->nom_status}}
            </td>
            <td>
                {{$documento->unidadeDocumento->nom_uni_doc}}
            </td>
            <td>
                @if($documento->GAB_ATENDIMENTO_cod_atendimento!=null)
                    @if($documento->antedimentoRelacionado->ind_status=="A")
                        {{date('d/m/Y', strtotime($documento->antedimentoRelacionado->dat_atendimento))}}
                        <br>
                        {{$documento->antedimentoRelacionado->pessoa->nom_nome}}
                        <br>
                        {{$documento->antedimentoRelacionado->pessoa->cod_cpf_cnpj}}
                        <br>
                        Tipo: {{$documento->tipoDocumento->nom_tip_doc}}
                        <br>
                        Situação: {{$documento->situacaoDoc->nom_status}}
                    @endif
                @endif
            </td>
            <td>
                @if($documento->dat_resposta!=null)
                    Data:{{date('d/m/Y', strtotime($documento->dat_resposta))}}
                @endif
            </td>
        </tr>
        
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