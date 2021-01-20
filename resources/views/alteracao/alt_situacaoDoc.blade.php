<form class="form" method="post" action={{route('situacaoDoc.update', $sitDoc->cod_status)}}>
    @method("PUT")
    @csrf
        <h1 class="titulo" style="text-align:center; padding-right:10%;">Situação do Documento</h1>  
        <div class="cadastro-menor">
            <input id="nom_status" type="text" class="form-control col-sm-6" name="nom_status" value="{{$sitDoc->nom_status}}" required autocomplete="nom_status" autofocus >
            <label class="control-label negrito" for="radios">Status</label>
                <label for="ativo" style="margin-top:8px;margin-left:5px">
                        <input type="radio" name="ind_status" id="ativo" value="A" @if($sitDoc->ind_status == 'A') checked @endif>
                            Ativo&nbsp&nbsp&nbsp
                    </label>
                <label for="inativo">
                    <input type="radio" name="ind_status" id="inativo" value="I" @if($sitDoc->ind_status == 'I') checked @endif>
                        Inativo
                </label>
        </div>

     
    <div style="text-align:center; padding-right:10%; padding-top:2%;">    
        <button type="submit" class="btn btn-primary alterar">Alterar</button>
        <a href="javascript:history.back()" class="btn btn-primary alterar">Voltar</a>
    </div>          
</form>
