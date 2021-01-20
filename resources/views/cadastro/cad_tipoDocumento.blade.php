
<form class="form" method="post" action={{route('tipoDocumento.store')}}>
    @csrf
    <h1 class="titulo" style="text-align:center; padding-right:10%;">Tipo de Documento</h1>        
    <div class="cadastro-menor">
        <input id="nom_tip_doc" type="text" class="form-control col-sm-6" name="nom_tip_doc" value="{{old('nom_tip_doc')}}" required autocomplete="nom_tip_doc" autofocus >
        <input type="hidden" NAME="ind_tip_doc" VALUE="A">
    </div>

    <div style="text-align:center; padding-right:10%; padding-top:2%;">    
        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <button type="reset" class="btn btn-primary">Limpar</button>
    </div>
</form>