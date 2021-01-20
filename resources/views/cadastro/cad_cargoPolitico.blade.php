
<form class="form" method="post" action={{route('cargoPolitico.store')}}>
    @csrf
    <h1 class="titulo" style="text-align:center; padding-right:10%;">Cargo Político</h1>        
    <div class="cadastro-menor">
        <input id="nom_car_pol" type="text" class="form-control col-sm-6" name="nom_car_pol" value="{{old('nom_car_pol')}}" required autocomplete="nom_car_pol" autofocus >
        <input type="hidden" NAME="ind_car_pol" VALUE="A">
    </div>

    <div style="text-align:center; padding-right:10%; padding-top:2%;">    
        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <button type="reset" class="btn btn-primary">Limpar</button>
    </div>
</form>