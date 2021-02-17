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
                @php
                    $i=1; //contador para saber qual o atendimento relacionado
                @endphp
                <tbody>
                    @foreach($documentos as $docC)
                    <tr>
                        <td  width='11%'>{{date('d/m/Y', strtotime($docC->dat_documento))}}</td>
                        <td  width='10%'>{{$docC->nom_documento}}/{{$docC->dat_ano}}</td>
                        <td  width='10%'>{{$docC->tipoDocumento->nom_tip_doc}}</td>
                        <td  width='10%'>{{$docC->situacaoDoc->nom_status}}</td>
                        <td  width='10%'>{{$docC->unidadeDocumento->nom_uni_doc}}</td>
                        <td width='18%'>
                            @if($docC->GAB_ATENDIMENTO_cod_atendimento!=null)  
                                @if($docC->antedimentoRelacionado->ind_status=="A")
                                    Sim 
                                    {{--CÓDIGO PARA MOSTRAR INFORMAÇÕES SOBRE O ATENDIMENTO--}}
                                    {{--Passa o contador de parametro para a função que mostra o atendimento--}}
                                        <img type="button" src="{{asset('Utils/seta-down.svg')}}" id="seta{{$i}}" onclick="atendimentoR({{$i}})">
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
                        <td width='14%'>
                            @if($docC->dat_resposta!=null)
                                Sim
                                <img type="button" src="{{asset('Utils/seta-down.svg')}}" id="seta-res{{$i}}" onclick="dataRela({{$i}})">
                                {{--O nome da div tem o cotnador relacionado, para a função atendimnetoR saber qual div é para mostrar--}} 
                                <div id="dataRela{{$i}}" hidden="true"> 
                                    Data: {{$docC->dat_resposta = date('d/m/yy',strtotime($docC->dat_resposta))}}
                                </div>
                            @else
                                Não
                            @endif                    
                        </td>  
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
                    </tr>   
                    @php
                        $i++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
    </div> 

{{--Data e atendimento relacionado--}}
<script defer>
    var checkAtendR = true;
    function atendimentoR(contator){
        //document.getElementById('seta').transform(rotate(180deg)); /* Equal to rotateZ(45deg) */
        if(checkAtendR == true){
            document.getElementById("seta"+contator).style.transform = "rotate("+180+"deg)";
            document.getElementById("atendimentoRela"+contator).hidden=false;
            checkAtendR=false;
        }else{
            document.getElementById("seta"+contator).style.transform = "rotate("+0+"deg)";
            document.getElementById("atendimentoRela"+contator).hidden=true;
            checkAtendR=true;            
        }
    }
    var Checkresp = true;
    function dataRela(contator){
        //document.getElementById('seta').transform(rotate(180deg)); /* Equal to rotateZ(45deg) */
        if(checkAtendR == true){
            document.getElementById("seta-res"+contator).style.transform = "rotate("+180+"deg)";
            document.getElementById("dataRela"+contator).hidden=false;
            checkAtendR=false;
        }else{
            document.getElementById("seta-res"+contator).style.transform = "rotate("+0+"deg)";
            document.getElementById("dataRela"+contator).hidden=true;
            checkAtendR=true;            
        }
    }
</script>
       
    {!!$documentos->appends($dataform)->links()!!} <!-- pacote coletive forms. Criar os links a serem passados da tabela -->
    <script src="{{asset('js/exclusao.js')}}"deffer></script>
    <script type="text/javascript" defer>
        //foca na tabela quando ela é criada
        $(document).ready(function() { 
            window.location.href='#tb_documento';
        });
    </script>