@extends('layouts.app')

@section('content')
<link href="{{asset('js/lib/main.css')}}" rel='stylesheet' />
<link href="{{ asset('css/full-calendar.css') }}" rel="stylesheet">
<script src="{{'js/lib/main.js'}}"></script>
<script src="{{'js/lib/locales-all.js'}}"></script>

@if($chaveAgenda!=null)
  <script type='text/javascript'>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        
        var calendar = new FullCalendar.Calendar(calendarEl, {
          googleCalendarApiKey: '{{$chaveAgenda->api_key}}', //chave cadastrada google agenda
            headerToolbar: {
              center: '' // buttons for switching between views
            },
            locale:'pt-br',
            timeZone: 'America/Sao_Paulo',
            selectable: true,
            initialView: 'eventosSemana',
            height: 500,
            views: {
              eventosSemana: {
                type: 'listWeek',
                duration: {days: 7},
              }
            },
            eventSources: [ //eventos que vão ser mostrado na agenda
              {
                  googleCalendarId: '{{$chaveAgenda->calendar_id}}',  //id cadastrado do google agenda
                  className: 'gcal-event'
              }
            ],
        });

        calendar.render();  

    });
  </script>
@endif

<script>
    var mostraAniversariante = true;
    function mostraAniversa(contator){
        if(mostraAniversariante == true){
            document.getElementById("dadosAniver"+contator).hidden=false;
            mostraAniversariante=false;
        }else{
            document.getElementById("dadosAniver"+contator).hidden=true;
            mostraAniversariante=true;            
        }
    }
</script>
<style>
/*
O calendar da um margin top de 40px para o body
o código a seguir serve para retirar
*/
body{
  margin:0px;
}

</style>

<div class="form-group" style="margin:0px; margin-bottom:5px;">
  <h2 class="titulo" style="text-align:center;">{{$vereador->cargoPolitico->nom_car_pol}}<a href="{{route('agentePolitico.index')}}" target="" style="color:black !important;"> {{$vereador->nom_vereador}}</a></h2>
  <h4 style="text-align:center;">{{$vereador->nom_orgao}}</h4>
</div>    

<div class="container">
<div class="row">

    <div class="form-group col-lg-3" >
      @if($vereador->img_foto !=null)
        <img src="{{url("storage/{$vereador->img_foto}")}}" alt="Imagem de Vereador" width="100%;">
      @elseif($vereador->img_foto === null)
        <img src="{{url("storage/padrao/padrao.jpg")}}" alt="Imagem de Vereador" width="100%;">
      @endif
    </div>   

    <div  id='calendar' class="col-lg-6" style="height:100% widht:100% margin:0px;"> 
        @if($chaveAgenda==null)
          <div class="card">
            <div class="card-header">
                <b><label class="titulo-card">Agenda</label></b>
            </div>
            <ul class="list-group list-group-flush" style="text-align:center;">      
              <p>A sua Agenda não está sincronizada.
              <br>
              Cadastre as <a href="{{route('chaveAgenda.index')}}" class="link-cad"><u>chaves do Google</u></a> para sincronizar sua Agenda.
              </p>
            </u>
          </div>     
        @endif
    </div>

    <div class="col-lg-3">
      <div class="card">
        <div class="card-header">
             <b><label class="titulo-card">Aniversários</label></b>
        </div>
        <ul class="list-group list-group-flush" style="text-align:center;">
          @if($aniversariantes->isEmpty())
            <p>Não há Aniversariante cadastrado (nos próximos 5 dias).
                <br>
              Cadastre os dados de mais <a href="{{route('pessoa.index')}}" class="link-cad"><u>Pessoas</u></a>, incluindo a Data de Nascimento.
            </p>
          @else
            @php 
                $data = new DateTime('now');
                $umDia = new DateInterval('P1D'); // Intervalo de 1 dia
                $j=1; //contador para saber qual o aniversariante relacionado
            @endphp
            @for($i=0;$i<5;$i++)
              <li class="list-group-item" style="background-color:#D3D3D3"><b>{{$data->format('d/m/Y')}}</b></li>
              @foreach($aniversariantes as $aniversariante)
                @if(date('d', strtotime($aniversariante->dat_nascimento)) == $data->format('d'))
                  <li class="list-group-item">
                    <!--<a href="#" onclick="mostraAniversa({{$j}})">{{$aniversariante->nom_nome}}</a>
                    <div id="dadosAniver{{$j}}" hidden="true"> {{--O nome da div tem o cotnador relacionado, para a função atendimnetoR saber qual div é para mostrar--}}
                          <label style="font-weight: bolder">Celular:</label>
                          <br>
                          <label>{{$aniversariante->num_ddd_cel}} {{$aniversariante->num_cel}}</label>
                          <br>
                          <label style="font-weight: bolder">Email:</label>
                          <br>
                          <label>{{$aniversariante->nom_email}}</label>
                          <br>
                          <label style="font-weight: bolder">Rede Social:</label>
                          <br>
                          <label>{{$aniversariante->nom_rede_social}}</label> 
                          <br>
                          <a href="{{route('pessoa.edit',  $aniversariante->cod_pessoa)}}" type="submit">ir para o cadastro</a>
                    </div>-->    
                    
                    {{$aniversariante->nom_nome}}
                    
                  </li>
                  @php $j++; @endphp
                @endif
              @endforeach
              @php 
                $data->add($umDia); // Altera o valor de $hoje
              @endphp
            @endfor
          @endif
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection
