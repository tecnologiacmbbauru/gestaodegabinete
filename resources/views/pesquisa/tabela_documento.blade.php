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
                        <th style="text-align: center;">Anexos</th>
                        <th style="text-align: center;">Alterar</th>
                        <th style="text-align: center;">Excluir</th>
                    </tr>
                </thead>
                @if($documentos->isEmpty()) {{--caso pesquisa não tenha resultado, o método isEmpty ja esta na classe LengthAwarePaginator (classe responsavel por retornar a pesquisa paginada)--}}
                    <td colspan="10" style="text-align: center;">Não foi encontrado nenhum registro</td>
                @endif
                @php
                    $i=1; //contador para saber qual o atendimento relacionado
                @endphp
                <tbody>
                    @foreach($documentos as $docC)
                    <tr>
                        <td  width='10%'>{{date('d/m/Y', strtotime($docC->dat_documento))}}</td>
                        <td  width='10%'>{{$docC->nom_documento}}/{{$docC->dat_ano}}</td>
                        <td  width='10%'>{{$docC->tipoDocumento->nom_tip_doc}}</td>
                        <td  width='10%'>{{$docC->situacaoDoc->nom_status}}</td>
                        <td  width='10%'>{{$docC->unidadeDocumento->nom_uni_doc}}</td>
                        <td width='14%'>
                            @if($docC->GAB_ATENDIMENTO_cod_atendimento!=null)  
                                @if($docC->antedimentoRelacionado->ind_status=="A")
                                    Sim 
                                    {{--CÓDIGO PARA MOSTRAR INFORMAÇÕES SOBRE O ATENDIMENTO--}}
                                    {{--Passa o contador de parametro para a função que mostra o atendimento--}}
                                    <img class="seta" type="button" src="{{asset('Utils/seta-down.svg')}}" id="seta{{$i}}" onclick="atendimentoR({{$i}})">
                                    {{--O nome da div tem o cotnador relacionado, para a função atendimnetoR saber qual div é para mostrar--}} 
                                    <div id="atendimentoRela{{$i}}" hidden="true"> 
                                        <label style="font-weight: bolder">Data:</label> <label>{{date('d/m/Y', strtotime($docC->antedimentoRelacionado->dat_atendimento))}}</label>
                                        <br>
                                        <label style="font-weight: bolder">Pessoa:</label> <label>{{$docC->antedimentoRelacionado->pessoa->nom_nome}}</label>
                                        <br>
                                        <label style="font-weight: bolder">Tipo:</label> <label>{{$docC->tipoDocumento->nom_tip_doc}}</label>
                                        <br>
                                        <label style="font-weight: bolder">Situação:</label> <label>{{$docC->situacaoDoc->nom_status}}</label>          
                                    </div>
                                @else
                                    Não
                                @endif                            
                            @else
                                Não
                            @endif
                        </td>
                        <td width='10%'>
                            @if($docC->dat_resposta!=null)
                                Sim
                                <img class="seta" type="button" src="{{asset('Utils/seta-down.svg')}}" id="seta-res{{$i}}" onclick="respRela({{$i}})">
                                {{--O nome da div tem o cotnador relacionado, para a função atendimnetoR saber qual div é para mostrar--}} 
                                <div id="respRela{{$i}}" hidden="true" style="font-weight: 540;"> 
                                    {{$docC->dat_resposta = date('d/m/yy',strtotime($docC->dat_resposta))}}
                                    <br>
                                    @if($docC->path_doc_resp!=null)
                                        <a class="link-documento" href="{{asset("storage/{$docC->path_doc_resp}")}}" download="Documento-Resposta"><img src="{{asset('utils/baixar-doc.png')}}" alt="Baixar Documento de Resposta" title="Baixar Documento de Resposta"></a>  
                                        @if($docC->link_resposta!=null)
                                            <a href="{{$docC->link_resposta}}" target="_blank"><img src="{{asset('utils/link-doc.png')}}" alt="Link Resposta do Documento" title="Link Resposta do Documento"></a>
                                        @endif 
                                    @else
                                        @if($docC->link_resposta!=null)
                                            <a href="{{$docC->link_resposta}}" target="_blank"><img src="{{asset('utils/link-doc.png')}}" alt="Link Resposta do Documento" title="Link Resposta do Documento"></a>
                                        @endif    
                                    @endif
                                </div>
                            @else
                                Não
                            @endif                    
                        </td>  
                        @if($docC->path_doc!=null)
                            <td  width='10%' style="text-align: center;">
                                <a class="link-documento" href="{{asset("storage/{$docC->path_doc}")}}" download="{{$docC->tipoDocumento->nom_tip_doc}}-{{$docC->nom_documento}}-{{$docC->dat_ano}}"><img src="{{asset('utils/baixar-doc.png')}}" alt="Baixar Documento" title="Baixar Documento"></a>
                                @if($docC->lnk_documento!=null)
                                    <a href="{{$docC->lnk_documento}}" target="_blank"><img src="{{asset('utils/link-doc.png')}}" alt="Link Documento" title="Link do Documento"></a>
                                @endif
                            </td>
                        @else
                            <td  width='10%' style="text-align: center;">
                                @if($docC->lnk_documento!=null)
                                    <a href="{{$docC->lnk_documento}}" target="_blank"><img src="{{asset('utils/link-doc.png')}}" alt="Link Documento" title="Link do Documento"></a>
                                @endif 
                            </td>
                        @endif
                        <td  width='8%'style="text-align: center;">
                            <a href="{{route('documento.edit',  $docC->cod_documento)}}"><img src="{{asset('utils/alterar.png')}}" alt="Alterar"></a>
                        </td>
                        <td  width='8%' style="text-align: center;">
                            <form action="{{route('documento.destroy', "id_exclusao")}}" method="post">
                                @csrf
                                @method('DELETE')
                                <a type="button" data-toggle="modal" data-target="#modalExclusao" data-id_exclusao="{{$docC->cod_documento }}"><img src="{{asset('utils/excluir.png')}}" alt="Excluir"></a>
                                @include('exclusao/exclusao_modal')
                            </form>
                        </td>
                    </tr>   
                    @php
                        $i++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
    </div> 

{{--Data e atendimento relacionado--}}
<script src="{{asset('js/mostraRelacionados.js')}}" defer></script>
     
{!!$documentos->appends($dataform)->links()!!} <!-- pacote coletive forms. Criar os links a serem passados da tabela -->
<script src="{{asset('js/exclusao.js')}}"deffer></script>
<script type="text/javascript" defer>
    //foca na tabela quando ela é criada
    $(document).ready(function() { 
        window.location.href='#tb_documento';
    });
</script>