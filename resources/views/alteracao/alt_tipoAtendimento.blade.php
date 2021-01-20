<form class="form" method="post" action={{route('tipoAtendimento.update', $tipoA)}}>
    @method("PUT")
    @csrf
    <h1 class="titulo" style="text-align:center; padding-right:10%;">Tipo de Atendimento</h1>  
    <div class="cadastro-menor">
        <input id="nom_tipo" type="text" class="form-control col-sm-6" name="nom_tipo" value="{{$tipoA->nom_tipo}}" required autocomplete="nom_tipo" autofocus >
        <label class="control-label negrito" for="radios">Status</label>
        <label for="ativo" style="margin-top:8px;margin-left:5px">
        <input type="radio" name="ind_tipo" id="ativo" value="A" @if($tipoA->ind_tipo == 'A') checked @endif>
                Ativo&nbsp&nbsp&nbsp
            </label>
        <label for="inativo">
            <input type="radio" name="ind_tipo" id="inativo" value="I" @if($tipoA->ind_tipo == 'I') checked @endif>
                Inativo
        </label>
    </div>

     
    <div style="text-align:center; padding-right:10%; padding-top:2%;">    
        <button type="submit" class="btn btn-primary alterar">Alterar</button>
        <a href="javascript:history.back()" class="btn btn-primary alterar">Voltar</a>
    </div>
        
</form>

