<form class="form" method="post" action={{route('chaveAgenda.store')}}>
        @csrf
        <h1 class="titulo" style="text-align:center; padding-right:10%;">Chaves - Google Agenda</h1>
        <div class="cadastro-agenda">
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label class="col-form-label negrito">Nome da Agenda</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{old('api_key')}}" maxlength="255" >
                </div>
            </div>
            @if (isset($ChavePrimaria))
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label class="col-form-label negrito">Google Calendar API</label>
                        <input id="api_key" type="text" class="form-control" name="api_key" value="{{$ChavePrimaria->api_key}}" maxlength="255" readonly>
                    </div>
                </div>
            @else
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label class="col-form-label negrito">Google Calendar API</label>
                        <input id="api_key" type="text" class="form-control" name="api_key" value="{{old('api_key')}}" maxlength="255" >
                    </div>
                </div>
            @endif
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label class="col-form-label negrito">Google Calendar ID</label>
                    <input id="calendar_id" type="text" class="form-control" name="calendar_id" value="{{old('calendar_id')}}" maxlength="255" >
                </div>
            </div>
        </div>
        <div style="text-align:center; padding-right:10%;">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <button id="limpar" type="reset" class="btn btn-primary">Limpar</button>
        </div>
</form>
<p style="font-size: 13px; margin-top:10px;">
    Para sincronizar seu "Google Agenda" com o software "Gestão de Gabinete", para isto siga os passos disponiveis <a class="a-footer" href="https://fullcalendar.io/docs/google-calendar" target="_blank">aqui</a>.
</p>
