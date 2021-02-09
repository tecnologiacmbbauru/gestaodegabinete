<!--lISTAGEM DOS atendimentos ja cadastrados-->
<div class="table-of row">
    <table id="tb_atendimento" class="mtab table table-striped table-responsive-lg" width="100%">
        <thead class="thead-dark">
            <tr>
                <th>Data</th>
                <th>Pessoa</th>
                <!-- <th>Doc.Identificação</th> -->
                <th>Tipo</th>
                <th>Situação</th>
                <th style="text-align: center;">Relatório</th>
                <th style="text-align: center;">Alterar</th>
                <th style="text-align: center;">Excluir</th>
            </tr>
        </thead>
        @if($Atendimento->isEmpty()) {{--caso pesquisa não tenha resultado, o método isEmpty ja esta na classe LengthAwarePaginator na qual retorna a pesquisa paginada--}}
            <td colspan="7" style="text-align: center;">Não foi encontrado nenhum registro</td>
        @endif
        @foreach($Atendimento as $atendimentoC)
        <tbody>
            <td  width='10%'>   
                {{date('d/m/Y', strtotime($atendimentoC->dat_atendimento))}} <!--Formata para modo de data usado no Brasil-->
            </td>
            <td  width='15%'>
                @if($atendimentoC->GAB_PESSOA_cod_pessoa==null)
                    Não existe pessoa relacionada 
                @elseif($atendimentoC->pessoa->ind_status!="A")
                    Não existe pessoa relacionada 
                @else
                    {{$atendimentoC->pessoa->nom_nome}}
                @endif
            </td>
            <td  width='15%'>
                {{--debug{{$atendimentoC->GAB_TIPO_ATENDIMENTO_cod_tipo}} --}}
                {{$atendimentoC->tipoAtendimento->nom_tipo}}
            </td>
            <td  width='10%'>
                {{$atendimentoC->statusAtendimento->nom_status}}
            </td>
            <td width='10%' style="text-align: center;">
                    <a href="{{route('pdf.atendimento',$atendimentoC->cod_atendimento)}}" target="_blank"><img src="{{asset('utils/relatorio.png')}}" alt="Gerar Relatório do Atendimento" title="Gerar Relatório do Atendimento"></a>                
            </td>
            <td  width='10%' style="text-align: center;">
                <a href="{{route('atendimento.edit', $atendimentoC->cod_atendimento)}}"><img src="{{asset('utils/alterar.png')}}" alt="Alterar"></a>                   
            </td>
            <td  width='10%' style="text-align: center;">
                <form action="{{route('atendimento.destroy', "id_exclusao")}}" method="post">
                    @csrf
                    @method('DELETE')
                    <a type="button" data-toggle="modal" data-target="#modalExclusao" data-id_exclusao="{{$atendimentoC->cod_atendimento}}"><img src="{{asset('utils/excluir.png')}}" alt="Excluir"></a>
                    @include('exclusao/exclusao_modal')
                </form>
            </td>
        </tbody>
        @endforeach
    </table>
</div> 
@if(isset($dataform))
    {!!$Atendimento->appends($dataform)->links()!!} <!-- pacote coletive forms. Criar os links a serem passados da tabela -->  
@endif
<script src="{{asset('js/exclusao.js')}}"deffer></script>
<script type="text/javascript" defer>
    //foca na tabela quando ela é criada
    $(document).ready(function() { 
        window.location.href='#tb_atendimento';
    });
</script>