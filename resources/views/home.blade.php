@extends('layouts.app')

@section('content')
<link href="{{asset('js/lib/main.css')}}" rel='stylesheet' />
<link href="{{ asset('css/full-calendar.css') }}" rel="stylesheet">
<style>
  /*
  O calendar da um margin top de 40px para o body
  o código a seguir serve para retirar
  */
  body{
    margin:0px;
  }
</style>



<script src="{{'js/lib/main.js'}}"></script>
<script src="{{'js/lib/locales-all.js'}}"></script>

<!--Para pegar os detalhes do evento, script do gabinete-old-->
<script src="./fullcalendar/moment/main.min.js"></script>
<script src="./fullcalendar/moment/moment-with-locales.min.js"></script>
<script src="./fullcalendar/moment/moment-timezone-with-data.min.js"></script>

@if(!$chaveAgendas->isEmpty())
  <script type='text/javascript'>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          googleCalendarApiKey: '{{$api_key}}', //chave cadastrada google agenda
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
                {{--Coloca para mostrar evento de todos calendar_id--}}
                @foreach ($chaveAgendas as $chaveAgenda)
                    googleCalendarId: '{{$chaveAgenda->calendar_id}}',
                @endforeach
                  className: 'gcal-event'
              }
            ],
      //function resize layout responsive
      windowResize: function(view) {
          if ($(window).width() <= 767){
              calendar.changeView('listWeek');
              calendar.setOption('headerToolbar', {
                  left: 'prev',
                  center: 'title',
                  right: 'next'
                });
          }
      },

      eventClick: function (info) {
        info.jsEvent.preventDefault(); // prevent browser from visiting event's URL in the current tab
        // console.log(info.event);
        moment.locale('pt-BR');

        var fim = new moment.tz(info.event.end,"UTC");
        var ini = new moment.tz(info.event.start,"UTC");

        var duration = moment.duration(fim.diff(ini));
        var texto;
        if (ini.isValid() && !fim.isValid()) { //verificar se data inicial é válida e final não é válida  - mostrar apenas data e horario iniciais
            //OBS: Se as datas e horários inicial e final foram iguais no Google Agenda,
            //o horário final não é considerado/exportado pelo Google Agenda e o FullCalendar não recebe uma data válida
            texto = ini.format("dddd, D") + " de " + ini.format("MMMM") + " de " + ini.format("YYYY") + ", a partir da(s) " + ini.format("HH:mm") + " h";
        } else if (moment(ini).isSame(fim, 'day')) { //verificar se data inicial e final são as mesmas sem considerar horário
            if ((ini.minutes() > 0 || ini.hours() > 0) && (fim.minutes() > 0 || fim.hours() > 0)) { //TEM HORARIO INICIAL CADASTRADO e TEM HORARIO FINAL CADASTRADO
                texto = ini.format("dddd, D") + " de " + ini.format("MMMM") + " de " + ini.format("YYYY, HH:mm") + " h - " + fim.format("HH:mm") + " h";
            } else if (ini.minutes() > 0 || ini.hours() > 0) {//TEM APENAS HORARIO INICIAL CADASTRADO
                texto = ini.format("dddd, D") + " de " + ini.format("MMMM") + " de " + ini.format("YYYY") + ", a partir da(s) " + ini.format("HH:mm") + " h";
            } else if (fim.minutes() > 0 || fim.hours() > 0) { //TEM APENAS HORARIO FINAL CADASTRADO
                texto = ini.format("dddd, D") + " de " + ini.format("MMMM") + " de " + ini.format("YYYY") + " até à(s) " + fim.format("HH:mm") + " h";
            } else {//NÃO TEM HORARIO CADASTRADO
                texto = ini.format("dddd, D") + " de " + ini.format("MMMM") + " de " + ini.format("YYYY");
            }
        } else { //dia inicial diferente do dia final
            if ((ini.minutes() == 0 && ini.hours() == 0) && (fim.minutes() == 0 && fim.hours() == 0) && duration.days() == 1) { //não tem horário definido e possui duração de 1 dia
                texto = ini.format("dddd, D") + " de " + ini.format("MMMM") + " de " + ini.format("YYYY");
            } else if ((ini.minutes() > 0 || ini.hours() > 0) && (fim.minutes() > 0 || fim.hours() > 0)) { // TEM HORARIO INICIAL CADASTRADO e TEM HORARIO FINAL CADASTRADO
                texto = ini.format("D") + " de " + ini.format("MMMM") + " de " + ini.format("YYYY, HH:mm") + " h - " + fim.format("D") + " de " + fim.format("MMMM") + " de " + fim.format("YYYY, HH:mm") + " h";
            } else if (ini.minutes() > 0 || ini.hours() > 0) {//TEM APENAS HORARIO INICIAL CADASTRADO
                texto = ini.format("D") + " de " + ini.format("MMMM") + " de " + ini.format("YYYY, HH:mm") + " h - " + fim.format("D") + " de " + fim.format("MMMM") + " de " + fim.format("YYYY");
            } else if (fim.minutes() > 0 || fim.hours() > 0) { //TEM APENAS HORARIO FINAL CADASTRADO
                texto = ini.format("D") + " de " + ini.format("MMMM") + " de " + ini.format("YYYY") + " - " + fim.format("D") + " de " + fim.format("MMMM") + " de " + fim.format("YYYY, HH:mm") + " h ";
            } else {//NÃO TEM HORARIO CADASTRADO
                fim = fim.subtract(1, 'days'); //subtrai 1 dia da data final

                if (moment(ini).isSame(fim, 'month')) { //verificar se mês e ano são os mesmos sem considerar horário
                    texto = ini.format("D") + " - " + fim.format("D") + " de " + ini.format("MMMM") + " de " + ini.format("YYYY");
                } else {
                    texto = ini.format("D") + " de " + ini.format("MMMM") + " de " + ini.format("YYYY") + " - " + fim.format("D") + " de " + fim.format("MMMM") + " de " + fim.format("YYYY");
                }
            }
        }

        //Limpar campos
        // $('#visualizar #titulo').text("");
        // $('#visualizar #duracao').text("");
        $('#visualizar #local').text("");
        $('#visualizar #descricao').text("");

        //Popular campos
        $('#visualizar #titulo').text(info.event.title);
        $('#visualizar #duracao').text(texto);

        if (!info.event.extendedProps.location) { //local vazio
            document.getElementById("titulolocal").style.display = "none";
            document.getElementById("local").style.display = "none";
        } else {//local com valor
            document.getElementById("titulolocal").style.display = "";
            document.getElementById("local").style.display = "";
            $('#visualizar #local').text(info.event.extendedProps.location);
        }

        if (!info.event.extendedProps.description) { //descrição vazia
            document.getElementById("titulodescricao").style.display = "none";
            document.getElementById("descricao").style.display = "none";
        } else {//descrição com valor
            //console.log(info.event.extendedProps.description);
            document.getElementById("titulodescricao").style.display = "";
            document.getElementById("descricao").style.display = "";
            $('#visualizar #descricao').html(info.event.extendedProps.description);
        }

        $('#visualizar').modal('show');
        return false;
      }
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

{{--Script para excluir notificações--}}
<script>
  function deleteAlert(lembrete){
      if(lembrete == "danger"){
          document.getElementById("alert-danger").remove();
      }else{
          document.getElementById("alert-warning").remove();
      }
  }
</script>

<div class="container">
  @if ($lembreteAtd>0 or $lembreteDoc>0)
    <div id="alert-danger" class="alert alert-danger" style="font-size: 14px !important; border:2px solid rgb(232, 124, 124);">
        <img src="{{asset('utils/notification-danger.png')}}">
        Você possui <a class="alert-link" href="{{route('lembrete.pesquisa',['select-lembrete'=>'atendimento'])}}">{{$lembreteAtd}} atendimentos</a> e <a class="alert-link" href="{{route('lembrete.pesquisa',['select-lembrete'=>'documento'])}}">{{$lembreteDoc}} documentos</a> em aberto.
        <a href="#" class="alert-link" style="float: right;" onclick="deleteAlert('danger')">fechar</a>                   
    </div>
  @endif

  @if ($lembreteAtdSemana>0 or $lembreteDocSemana>0)
    <div id="alert-warning" class="alert alert-warning" style="font-size: 14px !important; border:2px solid rgb(211, 211, 25);">
        <img src="{{asset('utils/notification-bell.png')}}">
        Você possui <a class="alert-link" href="{{route('lembrete.pesquisa',['select-lembrete'=>'semana'])}}">{{$lembreteAtdSemana}} atendimentos</a> e <a class="alert-link" href="{{route('lembrete.pesquisa',['select-lembrete'=>'semana'])}}">{{$lembreteDocSemana}} documentos</a> para esta semana.
        <a href="#" class="alert-link" style="float: right;" onclick="deleteAlert('warning')">fechar</a>                   
    </div>
  @endif

  <div class="form-group" style="margin:0px; margin-bottom:5px;">
    <h2 class="titulo" style="text-align:center;">{{$vereador->cargoPolitico->nom_car_pol}}<a href="{{route('agentePolitico.index')}}" target="" style="color:black !important;"> {{$vereador->nom_vereador}}</a></h2>
    <h4 style="text-align:center;">{{$vereador->nom_orgao}}</h4>
  </div>


  <div class="row">
    <div class="form-group col-lg-3" >
      @if($vereador->img_foto !=null)
        <img src="{{url("storage/{$vereador->img_foto}")}}" alt="Imagem de Vereador" width="100%;">
      @elseif($vereador->img_foto === null)
        <img src="{{url("utils/sem-imagem.jpg")}}" alt="Imagem de Vereador" width="100%;">
      @endif
    </div>

    <div  id='calendar' class="col-lg-6" style="height:100% widht:100% margin:0px;">
        @if($chaveAgendas->isEmpty())
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
    <!--Modal para mostrar eventos no click-->
    @include('Utils/modal_calendar')
    @include('Utils/modal_aniversariante')
    <div class="col-lg-3">
      <div class="card card-aniversariantes">
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
              <li class="list-group-item li-data-niver"><b>{{$data->format('d/m/Y')}}</b></li>
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
                    <a type="button" class="link-aniversariante" onclick="populaModal({{$aniversariante}})" data-toggle="modal" data-target="#ModalAniversariante" data-aniversariante="{{$aniversariante}}">{{$aniversariante->nom_nome}}</a>
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

{{--Preencher a modal de aniversariante--}}
<script>
  function populaModal(aniversariante){
    document.getElementById("nome").innerHTML = aniversariante.nom_nome;
    if(aniversariante.nom_apelido!=null)
        document.getElementById("apelido").innerHTML = " - '"+aniversariante.nom_apelido+"'";
    document.getElementById("rua").innerHTML = aniversariante.nom_endereco;
    if(aniversariante.nom_numero!=null)
      document.getElementById("numero").innerHTML = "-"+aniversariante.nom_numero;
    if(aniversariante.nom_bairro!=null)
      document.getElementById("bairro").innerHTML = ", "+aniversariante.nom_bairro;
    if(aniversariante.nom_cidade!=null)
      document.getElementById("cidade").innerHTML = ", "+aniversariante.nom_cidade;
    if(aniversariante.nom_estado!=null)
      document.getElementById("cidade").innerHTML = ", "+aniversariante.estado;
    if(aniversariante.num_ddd_tel!=null)
      document.getElementById("ddd_tel").innerHTML = "("+aniversariante.num_ddd_tel+")";
    document.getElementById("telefone").innerHTML = aniversariante.num_tel;
    if(aniversariante.num_ddd_cel!=null)
      document.getElementById("ddd_cel").innerHTML = "("+aniversariante.num_ddd_cel+")";
    document.getElementById("celular").innerHTML = aniversariante.num_cel ;
    document.getElementById("email").innerHTML = aniversariante.nom_email;
    document.getElementById("rede_social").href = aniversariante.nom_rede_social;
    document.getElementById("rede_social").innerHTML = aniversariante.nom_rede_social;
    document.getElementById("txt_obs").innerHTML = aniversariante.txt_obs;
  }
</script>
