
@if($documentos->isEmpty()) {{--caso pesquisa não tenha resultado, o método isEmpty ja esta na classe LengthAwarePaginator na qual retorna a pesquisa paginada--}}
    <div id="alert" class="alert alert-success" style="font-size: 14px !important; border:2px solid rgb(100, 253, 131);">
        <img src="{{asset('utils/check-success.png')}}">
        Você não possui lembretes de documentos.
        <a href="#" class="alert-link" style="float: right;" onclick="deleteAlert()">fechar</a>                   
    </div>
@endif

@php
//$segunda = date('d/m/Y', strtotime('monday this week'));
//$sabado = date('d/m/Y', strtotime('saturday this week'));
$hoje = date('Y-m-d');

$semanaPassada = date('Y-m-d', strtotime('-1 week'));  //usada no if que decide a cor da header do card
$i=0; // usado de controler para numerar os cards
@endphp

<fieldset style="padding:5px;">
<div class="card-deck" style="padding-left:10px; padding-right:10px;">
    @foreach ($documentos as $documento)
        <!--<div class="col-md-3">-->
                @if ($documento->dat_lembrete<$hoje)
                @php
                    $firstDate  = new DateTime($documento->dat_lembrete);
                    $secondDate = new DateTime($hoje);
                    $intervalo = $firstDate->diff($secondDate);
                @endphp
                <div id="card{{$i}}" class="card" style="width: 15rem; border: 1px solid rgb(232, 124, 124);">
                    <div class="card-header card-header-danger">Atrasado em {{$intervalo->days}} dias.</div>              
                @else
                <div id="card{{$i}}" class="card" style="width: 15rem; border: 1px solid rgb(160, 160, 38);">
                    <div class="card-header card-header-warning">Lembrete {{date('d/m/Y', strtotime($documento->dat_lembrete))}}</div> 
                @endif
                    
                <div class="card-body">
                    <b>
                        {{$documento->tipoDocumento->nom_tip_doc}} {{$documento->nom_documento}} {{$documento->dat_ano}}
                    </b>
                    <br>
                    {{date('d/m/Y', strtotime($documento->dat_documento))}} -  {{$documento->situacaoDoc->nom_status}}
                    <br>
                    {{$documento->unidadeDocumento->nom_uni_doc}}
                    <br>
                    Anexos:
                    @if($documento->path_doc!=null)
                    <td  width='10%' style="text-align: center;">
                        <a class="link-documento" href="{{asset("storage/{$documento->path_doc}")}}" download="{{$documento->tipoDocumento->nom_tip_doc}}-{{$documento->nom_documento}}-{{$documento->dat_ano}}"><img src="{{asset('utils/baixar-doc.png')}}" alt="Baixar Documento" title="Baixar Documento"></a>
                        @if($documento->lnk_documento!=null)
                            <a href="{{$documento->lnk_documento}}" target="_blank"><img src="{{asset('utils/link-doc.png')}}" alt="Link Documento" title="Link do Documento"></a>
                        @endif
                    </td>
                    @else
                        <td  width='10%' style="text-align: center;">
                            @if($documento->lnk_documento!=null)
                                <a href="{{$documento->lnk_documento}}" target="_blank"><img src="{{asset('utils/link-doc.png')}}" alt="Link Documento" title="Link do Documento"></a>
                            @endif 
                        </td>
                    @endif
                    <br>
                    Assunto:
                    <p id="detalhes{{$i}}" class="card-text" hidden>
                        {{$documento->txt_assunto}}
                    </p>
                    <a href="#" id="ver-mais{{$i}}" class="ver-mais" onclick="verDetalhes({{$i}})">ver mais</a>
                    <hr>
                    <b>Atendimento:</b>
                    @if($documento->GAB_ATENDIMENTO_cod_atendimento==null)
                        Não possui
                    @else
                        <p id="atendimento{{$i}}" class="card-text" hidden style="margin-bottom: 0px; color:rgb(55, 53, 53);">
                            @if($documento->antedimentoRelacionado->ind_status=="A")
                                Atendimento em {{$documento->antedimentoRelacionado->tipoAtendimento->nom_tipo}}
                                <br>
                                {{date('d/m/Y', strtotime($documento->antedimentoRelacionado->dat_atendimento))}} - {{$documento->situacaoDoc->nom_status}}    
                                <br>
                                Munícipe: {{$documento->antedimentoRelacionado->pessoa->nom_nome}}
                                <br>
                            @else
                                O atendimento foi deletado
                            @endif
                        </p>
                        <a href="#" id="verAtendimento{{$i}}" class="ver-mais" onclick="verAtendimento({{$i}})">mostrar</a>
                    @endif
                    <hr>
                    <b>Resposta:</b>
                    @if($documento->GAB_ATENDIMENTO_cod_atendimento==null)
                        Não possui
                    @else
                        <p id="resposta{{$i}}" class="card-text" hidden style="margin-bottom: 0px; color:rgb(55, 53, 53);">
                            {{$documento->dat_resposta = date('d/m/yy',strtotime($documento->dat_resposta))}}
                            <br>
                            @if($documento->path_doc_resp!=null)
                                <a class="link-documento" href="{{asset("storage/{$documento->path_doc_resp}")}}" download="Documento-Resposta"><img src="{{asset('utils/baixar-doc.png')}}" alt="Baixar Documento de Resposta" title="Baixar Documento de Resposta"></a>  
                                @if($documento->link_resposta!=null)
                                    <a href="{{$documento->link_resposta}}" target="_blank"><img src="{{asset('utils/link-doc.png')}}" alt="Link Resposta do Documento" title="Link Resposta do Documento"></a>
                                @endif 
                            @else
                                @if($documento->link_resposta!=null)
                                    <a href="{{$documento->link_resposta}}" target="_blank"><img src="{{asset('utils/link-doc.png')}}" alt="Link Resposta do Documento" title="Link Resposta do Documento"></a>
                                @endif    
                            @endif
                        </p>
                        <a href="#" id="verResposta{{$i}}" class="ver-mais" onclick="verResposta({{$i}})">mostrar</a>
                    @endif
                </div>
                <div class="card-footer" style="vertical-align: middle;">
                    <a href="{{route('lembrete.delete',[$documento->cod_documento,"acao"=>"documento"])}}" class="card-link" style="float:left;" onclick="finalizar({{$i}})"><img src="{{asset('utils/check.png')}}" alt="Simbolo de check list finalizado"  title="Check Finalizado" style="float:left; margin-top:2%;">Finalizar</a>
                    <a href="{{route('documento.edit', $documento->cod_documento)}}" class="card-link" style="float:right;"><img src="{{asset('utils/alterar-16.png')}}" alt="Simbolo de editar documento"  title="Editar documento" style="float:left;">Editar</a>
                </div>
            </div> 
            @php
                $i++;
            @endphp
        <!--</div>-->
    @endforeach
</div>

@if($documentos->nextPageUrl() != null)
    <a href="{{$documentos->appends(['select-lembrete'=>$exibir])->nextPageUrl()}}" style="float:right;"><img src="{{asset('utils/right-arrow.png')}}"></a>
@endif  
@if($documentos->previousPageUrl() != null)
    <a href="{{$documentos->appends(['select-lembrete'=>$exibir])->previousPageUrl()}}" style="float:left;"><img src="{{asset('utils/right-arrow.png')}}" style="transform: rotate(180deg);"></a>
@endif
</fieldset>

<script>
    function verAtendimento(contador){
        //oculta os detalhes do atendimento
        document.getElementById("atendimento"+contador).hidden = !document.getElementById("atendimento"+contador).hidden;
        
        //altera o texto de "ver mais" para "ver menos" ou vice versa dependendo da classe atual atendimento
        if(document.getElementById("verAtendimento"+contador).className=="ver-mais"){
            document.getElementById("verAtendimento"+contador).innerHTML="ocultar";
            document.getElementById("verAtendimento"+contador).className="ver-menos";
        }else{
            document.getElementById("verAtendimento"+contador).innerHTML="mostrar";
            document.getElementById("verAtendimento"+contador).className="ver-mais";
        }
    }

    function verResposta(contador){
        //oculta os detalhes do atendimento
        document.getElementById("resposta"+contador).hidden = !document.getElementById("resposta"+contador).hidden;
        
        //altera o texto de "ver mais" para "ver menos" ou vice versa dependendo da classe atual
        if(document.getElementById("verResposta"+contador).className=="ver-mais"){
            document.getElementById("verResposta"+contador).innerHTML="ocultar";
            document.getElementById("verResposta"+contador).className="ver-menos";
        }else{
            document.getElementById("verResposta"+contador).innerHTML="mostrar";
            document.getElementById("verResposta"+contador).className="ver-mais";
        }
    }

</script>