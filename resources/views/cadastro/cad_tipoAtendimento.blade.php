
<form class="form" method="post" action={{route('tipoAtendimento.store')}}>
    @csrf
    <h1 class="titulo" style="text-align:center; padding-right:10%;">Tipo de Atendimento</h1>        
    <div class="cadastro-menor">
        <input id="nom_tipo" type="text" class="form-control col-sm-6" name="nom_tipo" value="{{old('nom_tipo')}}" required autocomplete="nom_tipo" autofocus >
        <input type="hidden" NAME="ind_tipo" VALUE="A">
    </div>

    <div style="text-align:center; padding-right:10%; padding-top:2%;">    
        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <button type="reset" class="btn btn-primary">Limpar</button>
    </div>
</form>