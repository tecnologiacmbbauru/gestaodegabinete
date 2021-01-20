<h1 class="titulo" style="text-align:center; padding-right:10%;">Agente Político</h1> 
<form class="form" method="post" action={{route('agentePolitico.altera')}} enctype="multipart/form-data">
    @csrf

    <div class="form-row">
        <div class="form-group col-md-6">
            @if($vereador->img_foto !=null)
                <img src="{{url("storage/{$vereador->img_foto}")}}" alt="Imagem de Vereador" style="max-widht: 150px; max-height: 200px;">
            @else
                <img src="{{url("storage/padrao/padrao.jpg")}}" alt="Imagem de Vereador" style="max-widht: 50px;">
            @endif 
        </div>  
        <div class="form-group col-md-6"> 
        <!--ARRRUMAR CARGO POLITICO - RELACIONAMENTO 1 PARA 1-->  
            <label class="col-form-label negrito">Nome do Agente Político</label>
            <input id="nom_vereador" type="text" class="form-control col-sm-10" name="nom_vereador" value="{{($vereador->nom_vereador)}}"  maxlength="50" autofocus > 
            <br>            
            <label class="col-form-label negrito">Cargo Político</label>
            <select id="inputCargo" class="form-control col-sm-10" name="GAB_CARGO_POLITICO_cod_car_pol">
                 @foreach($cargoPolitico as $cargoPolitico)
                    <option name="GAB_CARGO_POLITICO_cod_car_pol" value="{{($cargoPolitico->cod_car_pol)}}" @if($vereador->GAB_CARGO_POLITICO_cod_car_pol==$cargoPolitico->cod_car_pol) selected @endif>{{($cargoPolitico->nom_car_pol)}}</option>
                @endforeach
            </select>  
            <br>         
            <label class="col-form-label negrito" for="nome">Foto de perfil:</label>
            <input type="file" class="form-control input-arquivo col-sm-10" name="img_perfil"  >    
        </div>     
    </div>
    
    <h4 style="margin-bottom:0px;">Endereço do Orgão</h4>
    <hr style="margin-top:0px;" class="col-md-10">
       
        
    <div class="form-group row">
        <div class="form-group col-md-6">
            <label class="col-form-label negrito">Nome do Orgão</label>
            <input id="nom_orgao" type="text" class="form-control col-sm-10" name="nom_orgao" value="{{$vereador->nom_orgao}}" autocomplete="nom_orgao" maxlength="150" autofocus >
        </div>
        <div class="form-group col-md-6">
            <label class="col-form-label negrito">CEP</label>
            <input id="num_cep" type="text" class="form-control cep col-sm-10" name="num_cep" value="{{$vereador->num_cep}}" >
        </div>
    </div> 

    <div class="form-group row">
        <div class="form-group col-md-6">
            <label class="col-form-label negrito">Endereço</label>
            <input id="nom_endereco" type="text" class="form-control col-sm-10" name="nom_endereco" value="{{$vereador->nom_endereco}}" maxlength="100"  >
        </div>
        <div class="form-group col-md-1">
            <label class="col-form-label negrito">Número</label>
            <input id="nom_numero" type="text" class="form-control" name="nom_numero" value="{{$vereador->nom_numero}}" maxlength="100" >
        </div>
        <div class="form-group col-md-5" style="padding-left:0px;">
            <label class="col-form-label negrito">Bairro/Complemento</label>
            <input id="nom_complemento" type="text" class="form-control col-sm-10" name="nom_complemento" value="{{$vereador->nom_complemento}}" maxlength="200"  >
        </div>        
    </div> 

    <div class="form-group row">
        <div class="form-group col-md-6">
            <label class="col-form-label negrito">Cidade</label>
                <input id="nom_cidade" type="text" class="form-control col-sm-10" name="nom_cidade" value="{{$vereador->nom_cidade}}" maxlength="100"  >
        </div>
        <div class="form-group col-md-6">
            <label class="col-form-label negrito">Estado</label>
            <select id="nom_estado" class="form-control col-md-10" name="nom_estado">
                <option name="" value="" @if($vereador->nom_estado=="") selected @endif>Selecione</option>
                <option name="AC" value="AC" @if($vereador->nom_estado=="AC") selected @endif>{{('Acre')}}</option>
                <option name="AL" value="AL" @if($vereador->nom_estado=="AL") selected @endif>{{('Alagoas')}}</option>
                <option name="AP" value="AP" @if($vereador->nom_estado=="AP") selected @endif>{{('Amapá')}}</option>
                <option name="AM" value="AM" @if($vereador->nom_estado=="AM") selected @endif>{{('Amazonas')}}</option>
                <option name="BA" value="BA" @if($vereador->nom_estado=="BA") selected @endif>{{('Bahia')}}</option>
                <option name="CE" value="CE" @if($vereador->nom_estado=="CE") selected @endif>{{('Ceará')}}</option>
                <option name="DF" value="DF" @if($vereador->nom_estado=="DF") selected @endif>{{('Distrito Federal')}}</option>
                <option name="ES" value="ES" @if($vereador->nom_estado=="ES") selected @endif>{{('Espírito Santo')}}</option>
                <option name="GO" value="GO" @if($vereador->nom_estado=="GO") selected @endif>{{('Goiás')}}</option>
                <option name="MA" value="MA" @if($vereador->nom_estado=="MA") selected @endif>{{('Maranhão')}}</option>
                <option name="MT" value="MT" @if($vereador->nom_estado=="MT") selected @endif>{{('Mato Grosso')}}</option>
                <option name="MS" value="MS" @if($vereador->nom_estado=="MS") selected @endif>{{('Mato Grosso do Sul')}}</option>
                <option name="MG" value="MG" @if($vereador->nom_estado=="MG") selected @endif>{{('Minas Gerais')}}</option>
                <option name="PA" value="PA" @if($vereador->nom_estado=="PA") selected @endif>{{('Pará')}}</option>
                <option name="PB" value="PB" @if($vereador->nom_estado=="PB") selected @endif>{{('Paraíba')}}</option>
                <option name="PR" value="PR" @if($vereador->nom_estado=="PR") selected @endif>{{('Paraná')}}</option>
                <option name="PE" value="PE" @if($vereador->nom_estado=="PE") selected @endif>{{('Pernambuco')}}</option>
                <option name="PI" value="PI" @if($vereador->nom_estado=="PI") selected @endif>{{('Piauí')}}</option>
                <option name="RJ" value="RJ" @if($vereador->nom_estado=="RJ") selected @endif>{{('Rio de Janeiro')}}</option>
                <option name="RN" value="RN" @if($vereador->nom_estado=="RN") selected @endif>{{('Rio Grande do Norte')}}</option>
                <option name="RS" value="RS" @if($vereador->nom_estado=="RS") selected @endif>{{('Rio Grande do Sul')}}</option>
                <option name="RO" value="RO" @if($vereador->nom_estado=="RO") selected @endif>{{('Rondônia')}}</option>
                <option name="RR" value="RR" @if($vereador->nom_estado=="RR") selected @endif>{{('Roraima')}}</option>
                <option name="SC" value="SC" @if($vereador->nom_estado=="SC") selected @endif>{{('Santa Catarina')}}</option>
                <option name="SP" value="SP" @if($vereador->nom_estado=="SP") selected @endif>{{('São Paulo')}}</option>
                <option name="SE" value="SE" @if($vereador->nom_estado=="SE") selected @endif>{{('Sergipe')}}</option>
                <option name="TO" value="TO" @if($vereador->nom_estado=="TO") selected @endif>{{('Tocantins')}}</option>
            </select>
        </div>
    </div> 

    <div style="text-align:center; padding-right:10%; padding-top:2%;">    
        <button type="submit" class="btn btn-primary alterar">Alterar</button>
    </div>           

</form>
