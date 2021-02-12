<div div="topo-pesqDocumento" style="margin-bottom: 15px;margin-top: 15px;">
    <label style="margin-left:10px;"> Total de registros: {{$documentos->total()}} (a pesquisa retorna até 500)</label>
    {!!$documentos->appends($dataform)->links()!!} <!-- pacote coletive forms. Criar os links a serem passados da tabela -->  
</div>
    <div class="table-of row">
            <table id="tb_documento" class="mtab table table-striped table-hover table-responsive-lg" width="100%">
                <thead class="thead-dark">
                    <tr>
                        <th>Data</th>
                        <th>Número/Ano</th>
                        <th>Tipo</th>
                        <th>Situação</th>
                        <th>Unidade</th>
                        <th>Atendimento</th>
                        <th>Resposta</th>
                        <th style="text-align: center;">Alterar</th>
                        <th style="text-align: center;">Excluir</th>
                    </tr>
                </thead>
                @if($documentos->isEmpty()) {{--caso pesquisa não tenha resultado, o método isEmpty ja esta na classe LengthAwarePaginator (classe responsavel por retornar a pesquisa paginada)--}}
                    <td colspan="9" style="text-align: center;">Não foi encontrado nenhum registro</td>
                @endif
                @foreach($documentos as $docC)
                <tbody>
                    <td  width='11%'>{{date('d/m/Y', strtotime($docC->dat_documento))}}</td>
                    <td  width='10%'>{{$docC->nom_documento}}/{{$docC->dat_ano}}</td>
                    <td  width='10%'>{{$docC->tipoDocumento->nom_tip_doc}}</td>
                    <td  width='10%'>{{$docC->situacaoDoc->nom_status}}</td>
                    <td  width='10%'>{{$docC->unidadeDocumento->nom_uni_doc}}</td>
                    <td  width='10%'>@if($docC->GAB_ATENDIMENTO_cod_atendimento!=null)
                        @if($docC->antedimentoRelacionado->ind_status=="A")
                            Sim 
                        @else
                            Não
                        @endif
                    @else
                        Não
                    @endif</td>
                    <td  width='10%'>@if($docC->dat_resposta!=Null)Sim @else Não @endif</td>
                    <td  width='10%'style="text-align: center;">
                        <a href="{{route('documento.edit',  $docC->cod_documento)}}"><img src="{{asset('utils/alterar.png')}}" alt="Alterar"></a>
                    </td>
                    <td  width='10%' style="text-align: center;">
                        <form action="{{route('documento.destroy', "id_exclusao")}}" method="post">
                            @csrf
                            @method('DELETE')
                            <a type="button" data-toggle="modal" data-target="#modalExclusao" data-id_exclusao="{{$docC->cod_documento }}"><img src="{{asset('utils/excluir.png')}}" alt="Excluir"></a>
                            @include('exclusao/exclusao_modal')
                        </form>
                    </td>
                </tbody>
                @endforeach
            </table>
    </div> 
       
    {!!$documentos->appends($dataform)->links()!!} <!-- pacote coletive forms. Criar os links a serem passados da tabela -->
    <script src="{{asset('js/exclusao.js')}}"deffer></script>
    <script type="text/javascript" defer>
        //foca na tabela quando ela é criada
        $(document).ready(function() { 
            window.location.href='#tb_documento';
        });
    </script>