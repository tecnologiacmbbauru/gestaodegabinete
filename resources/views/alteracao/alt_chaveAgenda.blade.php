<form class="form" method="post" action={{route('chaveAgenda.update',$chaveAgenda->id)}}>
    @csrf
    @method('PUT')
    <h1 class="titulo" style="text-align:center; padding-right:10%;">Chaves - Google Agenda</h1>
    <div class="cadastro-agenda">
        <div class="form-row">
            <div class="form-group col-md-8">
                <label class="col-form-label negrito">Nome</label>
                <input id="name" type="text" class="form-control" name="name" value="{{$chaveAgenda->name}}" maxlength="255" >
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label class="col-form-label negrito">Google Calendar API</label>
                <input id="api_key" type="text" class="form-control" name="api_key" value="{{$chaveAgenda->api_key}}" maxlength="255">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label class="col-form-label negrito">Google Calendar ID</label>
                <input id="calendar_id" type="text" class="form-control" name="calendar_id" value="{{$chaveAgenda->calendar_id}}" maxlength="255" >
            </div>
        </div>
    </div>
    <div style="text-align:center; padding-right:10%;">
        <button type="submit" class="btn btn-primary alterar">Alterar</button>
        <a href="javascript:history.back()" class="btn btn-primary alterar">Voltar</a>
    </div>
</form>
