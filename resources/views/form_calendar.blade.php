<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href="{{asset('js/lib/main.css')}}" rel='stylesheet' />
<link href="{{ asset('css/full-calendar.css') }}" rel="stylesheet">
<script src="{{'js/lib/main.js'}}"></script>
<script src="{{'js/lib/locales-all.js'}}"></script>
{{--<script src="{{'js/calendar.js'}}"></script>--}}

<script type='text/javascript'>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      googleCalendarApiKey: 'AIzaSyCXLyNYMfCVQoZ_Q2Z7YlGZMHP0Ii43G8M',
        headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
      eventSources: [
        {
          googleCalendarId: 'paulogsm7@gmail.com',
           className: 'gcal-event'
        }
      ],
      locale:'pt-br',
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

</head>
<body>
      <div id='calendar'></div>

</body>
</html>
