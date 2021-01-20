<form class="form" method="post" action={{route('chaveAgenda.store')}}>
        @csrf
        <h1 class="titulo" style="text-align:center; padding-right:10%;">Chaves - Google Agenda</h1>
        <div class="cadastro-agenda">    
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label class="col-form-label negrito">Google Calendar API Key</label>
                    <input id="api_key" type="text" class="form-control" name="api_key" value="{{old('api_key')}}" maxlength="255" >
                </div>
            </div>
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
