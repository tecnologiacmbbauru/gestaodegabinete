<h1 class="titulo" style="text-align:center;">Agente Político</h1> 
<form class="form" method="post" action={{route('agentePolitico.store')}} enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-3"> 
            <label class="col-form-control negrito">Cargo Político</label>
            <select id="inputCargo" class="form-control col-md-11" name="GAB_CARGO_POLITICO_cod_car_pol">
                @foreach($cargoPolitico as $cargoPolitico)
                    <option name="GAB_CARGO_POLITICO_cod_car_pol" value="{{($cargoPolitico->cod_car_pol)}}">{{($cargoPolitico->nom_car_pol)}}</option>
                @endforeach
            </select>     
        </div>        
        <div class="form-group col-md-6">
            <label class="col-form-control negrito">Nome do Agente Político</label>
            <input id="nom_vereador" type="text" class="form-control col-md-11" name="nom_vereador" value="{{old('nom_vereador')}}" maxlength="50" autofocus required> 
        </div>
        <div class="form-group col-md-3">
            <label class="col-form-control negrito">Foto de perfil</label>
            <input type="file" class="form-control input-arquivo" name="img_foto" id="img_foto" accept="image/*"/>
            <label id="alert-foto" class="alert-obrigatorio" hidden="true">* A extensão do arquivo não é aceita.</label>
            <label id="alert-foto-tamanho" class="alert-obrigatorio" hidden="true">* O tamanho máximo de foto aceito é 25mb.</label>
        </div>
    </div>

    <h4 style="margin-bottom:0px;">Endereço do Orgão</h4>
    <hr style="margin-top:0px;" class="col-md-10">

    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="col-form-control negrito">Nome do Orgão</label>
            <input id="nom_orgao" type="text" class="form-control col-md-12" name="nom_orgao" value="{{old('nom_orgao')}}" autocomplete="nom_orgao" maxlength="150" >           
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4"> 
            <label class="col-form-control negrito">CEP</label>
            <input id="num_cep" type="text" class="form-control cep col-md-11" name="num_cep" value="{{old('num_cep')}}" autocomplete="num_cep" maxlength="9">  
        </div>
        <div class="form-group col-md-4">
            <label class="col-form-control negrito">Cidade</label>
            <input id="nom_cidade" type="text" class="form-control col-md-11" name="nom_cidade" value="{{old('nom_cidade')}}" autocomplete="nom_cidade" maxlength="100" >           
        </div>
        <div class="form-group col-md-4"> 
            <label class="col-form-control negrito">Estado</label>
            <select id="nom_estado" class="form-control col-md-12" name="nom_estado">
                <option name="" value="" selected>Selecione</option>
                <option name="AC" value="AC">{{('Acre')}}</option>
                <option name="AL" value="AL">{{('Alagoas')}}</option>
                <option name="AP" value="AP">{{('Amapá')}}</option>
                <option name="AM" value="AM">{{('Amazonas')}}</option>
                <option name="BA" value="BA">{{('Bahia')}}</option>
                <option name="CE" value="CE">{{('Ceará')}}</option>
                <option name="DF" value="DF">{{('Distrito Federal')}}</option>
                <option name="ES" value="ES">{{('Espírito Santo')}}</option>
                <option name="GO" value="GO">{{('Goiás')}}</option>
                <option name="MA" value="MA">{{('Maranhão')}}</option>
                <option name="MT" value="MT">{{('Mato Grosso')}}</option>
                <option name="MS" value="MS">{{('Mato Grosso do Sul')}}</option>
                <option name="MG" value="MG">{{('Minas Gerais')}}</option>
                <option name="PA" value="PA">{{('Pará')}}</option>
                <option name="PB" value="PB">{{('Paraíba')}}</option>
                <option name="PR" value="PR">{{('Paraná')}}</option>
                <option name="PE" value="PE">{{('Pernambuco')}}</option>
                <option name="PI" value="PI">{{('Piauí')}}</option>
                <option name="RJ" value="RJ">{{('Rio de Janeiro')}}</option>
                <option name="RN" value="RN">{{('Rio Grande do Norte')}}</option>
                <option name="RS" value="RS">{{('Rio Grande do Sul')}}</option>
                <option name="RO" value="RO">{{('Rondônia')}}</option>
                <option name="RR" value="RR">{{('Roraima')}}</option>
                <option name="SC" value="SC">{{('Santa Catarina')}}</option>
                <option name="SP" value="SP">{{('São Paulo')}}</option>
                <option name="SE" value="SE">{{('Sergipe')}}</option>
                <option name="TO" value="TO">{{('Tocantins')}}</option>
            </select>
        </div>
    </div>    
    <div class="form-row">
        <div class="form-group col-md-5">
            <label class="col-form-control negrito">Endereço</label>
            <input id="nom_endereco" type="text" class="form-control col-md-12" name="nom_endereco" value="{{old('nom_endereco')}}" autocomplete="nom_endereco" maxlength="100">          
        </div>
        <div class="form-group col-md-2"> 
            <label  class="col-form-control negrito">Número</label>
            <input id="nom_numero" type="text" class="form-control" name="nom_numero" value="{{old('nom_numero')}}" autocomplete="nom_numero" maxlength="100">  
        </div>
        <div class="form-group col-md-5"> 
            <label class="col-form-control negrito">Bairro/Complemento</label>
            <input id="nom_complemento" type="text" class="form-control col-md-12" name="nom_complemento" value="{{old('nom_complemento')}}" autocomplete="nom_complemento" maxlength="200">  
        </div>
    </div>
    @include('ajuda/modal_agentePolit')

    <div style="text-align:center; padding-top:2%;">
        <button id="btn-cadastrar" type="submit" class="btn btn-primary">Cadastrar</button>
        <button id="teste" type="reset" class="btn btn-primary">Limpar</button>
        {{--
        teste
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalAgentePolit">
        Abrir modal de demonstração
        </button>
        --}}
    </div>
</form>


{{--Valida a imagem que o usuario enviou--}}
<script type="text/javascript" defer>
    //Validação do input de documento
    $('#img_foto').bind('change', function() {
        $("#btn-cadastrar").attr("disabled", false);//primeiro ativa o botão cadastrar caso estivesse desativado
        document.getElementById("alert-foto").hidden=true;//e esconde as mensagens de erro
        document.getElementById("alert-foto-tamanho").hidden=true; 

        if((this.files[0].size/1024/1024)>25){//valida se o tamanho é valido
            document.getElementById("img_foto").focus;
            document.getElementById("alert-foto-tamanho").hidden=false; 
            $("#btn-cadastrar").attr("disabled", true);
        }else{ //valida se a extensão é valida
            if(this.files[0].type=="image/png" || this.files[0].type=="image/jpg" || this.files[0].type=="image/gif" || this.files[0].type=="image/jpeg" || this.files[0].type=="image/heic" || this.files[0].type=="image/heif"){
                return true;
            }else{ //caso a imagem não seja valida emite um aviso
                document.getElementById("alert-foto").hidden=false;
                jQuery('html, body').animate({scrollTop: 0}, 300); //Faz a animação da tela subindo até o topo, onde tem a mensagem
                document.getElementById("img_foto").focus;
                $("#btn-cadastrar").attr("disabled", true);
            }
        }
    });
</script>

@if(Auth::user()->ajuda_inicio==1)
<script type="text/javascript" defer>
    jQuery(document).ready(function(){
        $('#ModalAgentePolit').modal('show');
    });
</script>
@endif
