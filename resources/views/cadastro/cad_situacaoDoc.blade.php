<form class="form" method="post" action={{route('situacaoDoc.store')}}>
    @csrf
    <h1 class="titulo" style="text-align:center; padding-right:10%;">Situação do Documento</h1>        
    <div class="cadastro-menor">
        <input id="nom_status" type="text" class="form-control col-sm-6" name="nom_status" value="{{old('nom_status')}}" required autocomplete="nom_status" autofocus >
        <input type="hidden" NAME="ind_status" VALUE="A">
    </div>

    <div style="text-align:center; padding-right:10%; padding-top:2%;">    
        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <button type="reset" class="btn btn-primary">Limpar</button>
    </div>
</form>
