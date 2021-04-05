
@if($atendimentos->isEmpty()) {{--caso pesquisa não tenha resultado, o método isEmpty ja esta na classe LengthAwarePaginator na qual retorna a pesquisa paginada--}}
    <div id="alert" class="alert alert-success" style="font-size: 14px !important; border:2px solid rgb(100, 253, 131);">
        <img src="{{asset('utils/check-success.png')}}">
        Você não possui lembretes de atendimentos.
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
@foreach ($atendimentos as $atendimento)
    @if($i===0 or $i===4)
        <div class="card-deck" style="padding-left:10px; padding-right:10px; margin-bottom:10px;">
            @if ($atendimento->dat_lembrete<$hoje)
            @php
                $firstDate  = new DateTime($atendimento->dat_lembrete);
                $secondDate = new DateTime($hoje);
                $intervalo = $firstDate->diff($secondDate);
            @endphp
            <div id="card{{$i}}" class="card" style="width: 15rem; border: 1px solid rgb(232, 124, 124);">
                <div class="card-header card-header-danger">Atrasado em {{$intervalo->days}} dias.</div>              
            @else
            <div id="card{{$i}}" class="card" style="width: 15rem; border: 1px solid rgb(160, 160, 38);">
                <div class="card-header card-header-warning">Lembrete {{date('d/m/Y', strtotime($atendimento->dat_lembrete))}}</div> 
            @endif
                <div class="card-body">
                    <b>
                        Atendimento em {{$atendimento->tipoAtendimento->nom_tipo}}
                    </b>
                        <br>
                        {{date('d/m/Y', strtotime($atendimento->dat_atendimento))}}   -    {{$atendimento->statusAtendimento->nom_status}}
                        <br>
                        Munícipe: {{$atendimento->pessoa->nom_nome}}
                        <br>
                        Detalhes:
                    <p id="detalhes{{$i}}" class="card-text" hidden>
                        {{$atendimento->txt_detalhes}}
                    </p>
                    <a href="#" id="ver-mais{{$i}}" class="ver-mais" onclick="verDetalhes({{$i}})">ver mais</a>
                </div>
                <div class="card-footer" style="vertical-align: middle;">
                    <a href="{{route('lembrete.delete', [$atendimento->cod_atendimento,"acao"=>"atendimento"])}}" class="card-link" style="float:left;" onclick="finalizar({{$i}})"><img src="{{asset('utils/check.png')}}" alt="Simbolo de check list finalizado"  title="Check Finalizado" style="float:left; margin-top:2%;">Finalizar</a>
                    <a href="{{route('atendimento.edit', $atendimento->cod_atendimento)}}" class="card-link" style="float:right;"><img src="{{asset('utils/alterar-16.png')}}" alt="Simbolo de editar atendimento"  title="Editar Atendimento" style="float:left;">Editar</a>
                </div>
            </div> 
    @elseif($i===3 or $i===7)
            @if ($atendimento->dat_lembrete<$hoje)
            @php
                $firstDate  = new DateTime($atendimento->dat_lembrete);
                $secondDate = new DateTime($hoje);
                $intervalo = $firstDate->diff($secondDate);
            @endphp
            <div id="card{{$i}}" class="card" style="width: 15rem; border: 1px solid rgb(232, 124, 124);">
                <div class="card-header card-header-danger">Atrasado em {{$intervalo->days}} dias.</div>              
            @else
            <div id="card{{$i}}" class="card" style="width: 15rem; border: 1px solid rgb(160, 160, 38);">
                <div class="card-header card-header-warning">Lembrete {{date('d/m/Y', strtotime($atendimento->dat_lembrete))}}</div> 
            @endif
                
                <div class="card-body">
                    <b>
                        Atendimento em {{$atendimento->tipoAtendimento->nom_tipo}}
                    </b>
                        <br>
                        {{date('d/m/Y', strtotime($atendimento->dat_atendimento))}}   -    {{$atendimento->statusAtendimento->nom_status}}
                        <br>
                        Munícipe: {{$atendimento->pessoa->nom_nome}}
                        <br>
                        Detalhes:
                    <p id="detalhes{{$i}}" class="card-text" hidden>
                        {{$atendimento->txt_detalhes}}
                    </p>
                    <a href="#" id="ver-mais{{$i}}" class="ver-mais" onclick="verDetalhes({{$i}})">ver mais</a>
                </div>
                <div class="card-footer" style="vertical-align: middle;">
                    <a href="{{route('lembrete.delete', [$atendimento->cod_atendimento,"acao"=>"atendimento"])}}" class="card-link" style="float:left;" onclick="finalizar({{$i}})"><img src="{{asset('utils/check.png')}}" alt="Simbolo de check list finalizado"  title="Check Finalizado" style="float:left; margin-top:2%;">Finalizar</a>
                    <a href="{{route('atendimento.edit', $atendimento->cod_atendimento)}}" class="card-link" style="float:right;"><img src="{{asset('utils/alterar-16.png')}}" alt="Simbolo de editar atendimento"  title="Editar Atendimento" style="float:left;">Editar</a>
                </div>
            </div>
        </div> <!--fecha a div card-->
    @else
            @if ($atendimento->dat_lembrete<$hoje)
            @php
                $firstDate  = new DateTime($atendimento->dat_lembrete);
                $secondDate = new DateTime($hoje);
                $intervalo = $firstDate->diff($secondDate);
            @endphp
            <div id="card{{$i}}" class="card" style="width: 15rem; border: 1px solid rgb(232, 124, 124);">
                <div class="card-header card-header-danger">Atrasado em {{$intervalo->days}} dias.</div>              
            @else
            <div id="card{{$i}}" class="card" style="width: 15rem; border: 1px solid rgb(160, 160, 38);">
                <div class="card-header card-header-warning">Lembrete {{date('d/m/Y', strtotime($atendimento->dat_lembrete))}}</div> 
            @endif
                
                <div class="card-body">
                    <b>
                        Atendimento em {{$atendimento->tipoAtendimento->nom_tipo}}
                    </b>
                        <br>
                        {{date('d/m/Y', strtotime($atendimento->dat_atendimento))}}   -    {{$atendimento->statusAtendimento->nom_status}}
                        <br>
                        Munícipe: {{$atendimento->pessoa->nom_nome}}
                        <br>
                        Detalhes:
                    <p id="detalhes{{$i}}" class="card-text" hidden>
                        {{$atendimento->txt_detalhes}}
                    </p>
                    <a href="#" id="ver-mais{{$i}}" class="ver-mais" onclick="verDetalhes({{$i}})">ver mais</a>
                </div>
                <div class="card-footer" style="vertical-align: middle;">
                    <a href="{{route('lembrete.delete', [$atendimento->cod_atendimento,"acao"=>"atendimento"])}}" class="card-link" style="float:left;" onclick="finalizar({{$i}})"><img src="{{asset('utils/check.png')}}" alt="Simbolo de check list finalizado"  title="Check Finalizado" style="float:left; margin-top:2%;">Finalizar</a>
                    <a href="{{route('atendimento.edit', $atendimento->cod_atendimento)}}" class="card-link" style="float:right;"><img src="{{asset('utils/alterar-16.png')}}" alt="Simbolo de editar atendimento"  title="Editar Atendimento" style="float:left;">Editar</a>
                </div>
            </div> 
    @endif
    @php
        $i++;
    @endphp
@endforeach
</fieldset>

@if($atendimentos->nextPageUrl() != null)
    <a href="{{$atendimentos->appends(['select-lembrete'=>$exibir])->nextPageUrl()}}" style="float:right;"><img src="{{asset('utils/right-arrow.png')}}"></a>
@endif  
@if($atendimentos->previousPageUrl() != null)
    <a href="{{$atendimentos->appends(['select-lembrete'=>$exibir])->previousPageUrl()}}" style="float:left;"><img src="{{asset('utils/right-arrow.png')}}" style="transform: rotate(180deg);"></a>
@endif
