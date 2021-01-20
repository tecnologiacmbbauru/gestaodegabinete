<form class="form" method="post" action={{route('cargoPolitico.update', $cargoPolit)}}>
       @method("PUT")
       @csrf
        
        <h1 class="titulo" style="text-align:center; padding-right:10%;">Cargo Político</h1>  
        <div class="cadastro-menor">
            <input id="nom_car_pol" type="text" class="form-control col-sm-6" name="nom_car_pol" value="{{$cargoPolit->nom_car_pol}}" required autocomplete="nom_car_pol" autofocus >
            <label class="control-label negrito" for="radios">Status</label>
            <label for="ativo" style="margin-top:8px;margin-left:5px">
                <input type="radio" name="ind_car_pol" id="ativo" value="A" @if($cargoPolit->ind_car_pol == 'A') checked @endif>
                    Ativo&nbsp&nbsp&nbsp
                </label>
            <label for="inativo">
                <input type="radio" name="ind_car_pol" id="inativo" value="I" @if($cargoPolit->ind_car_pol == 'I') checked @endif>
                    Inativo
            </label>
        </div>

     
    <div style="text-align:center; padding-right:10%; padding-top:2%;">    
        <button type="submit" class="btn btn-primary alterar">Alterar</button>
        <a href="javascript:history.back()" class="btn btn-primary alterar">Voltar</a>
    </div>            
</form>
