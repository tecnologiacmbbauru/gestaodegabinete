@extends('layouts.app')


@section('content')
<link href="{{asset('js/lib/main.css')}}" rel='stylesheet' />
<link href="{{ asset('css/full-calendar.css') }}" rel="stylesheet">
<script src="{{'js/lib/main.js'}}"></script>
<script src="{{'js/lib/locales-all.js'}}"></script>
{{--<script src="{{'js/calendar.js'}}"></script>--}}

<script type='text/javascript'>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      googleCalendarApiKey: '{{$chaveAgenda->api_key}}',
        headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
      locale:'pt-br',
      timeZone: 'America/Sao_Paulo',
      selectable: true,
      initialView: 'dayGridMonth',
      eventSources: [
        {
            googleCalendarId: '{{$chaveAgenda->calendar_id}}',
            className: 'gcal-event'
        }
      ],
    /*select:function(event) {
        alert('evento selecionado');
    }*/
    });

    calendar.render();
    $('#visualizar').modal('show');
  });

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
<div class="container">
  <h2 style="text-align:center;">Agenda</h2>
  <div id='calendar'></div>
</div>

@endsection