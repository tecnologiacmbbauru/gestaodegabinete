<table >
        <thead>
            <tr>
                <td>Data</td>
                <td>Numero/Ano</td>
                <td>Tipo</td>
                <td>Situação</td>
                <td>Unidade</td>
                <td>Resposta</td>
                <td>Atendimento</td>            
            </tr>
        </thead>
        <tbody>
        @foreach($documentos as $documento)
        <tr>
            <td width="15">
                @if(isset($documento->dat_documento))
                    {{date('d/m/Y', strtotime($documento->dat_documento))}}
                @endif
            </td>
            <td width="15">
                {{$documento->nom_documento}}/{{$documento->dat_ano}}
            </td>
            <td width="15">
                {{$documento->tipoDocumento->nom_tip_doc}}
            </td>
            <td width="15">
                {{$documento->situacaoDoc->nom_status}}
            </td>
            <td width="15">
                {{$documento->unidadeDocumento->nom_uni_doc}}
            </td>
            <td width="15">
                @if(isset($documento->dat_resposta))
                    {{date('d/m/Y', strtotime($documento->dat_resposta))}}
                @endif
            </td>            
            <td width="100">
                @if($documento->GAB_ATENDIMENTO_cod_atendimento!=null)
                    Data:{{date('d/m/Y', strtotime($documento->antedimentoRelacionado->dat_atendimento))}} 
                    Nome:{{$documento->antedimentoRelacionado->pessoa->nom_nome}} 
                    Documento:{{$documento->antedimentoRelacionado->pessoa->cod_cpf_cnpj}} 
                    Tipo: {{$documento->tipoDocumento->nom_tip_doc}} 
                    Situação: {{$documento->situacaoDoc->nom_status}}
                @endif
            </td>
        </tr>
        
        @endforeach
        </tbody>
</table>
