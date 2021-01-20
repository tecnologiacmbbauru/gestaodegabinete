<div class="cadastro">
<form class="form" method="post" action={{route('pessoa.update',$pessoaC)}} enctype="multipart/form-data">
    @method("PUT")
    @csrf
    <div class="form-row">
        <div class="form-group col-md-2">
            @if($pessoaC->image !=null)
                <img src="{{url("storage/{$pessoaC->image}")}}" alt="$pessoaC->nom_nome" style="max-widht: 150px; max-height: 150px;">
            <!--Mostra imagem padrão de sem imagem-->
            @else
                <img src="{{url("storage/padrao/padrao.jpg")}}" alt="$pessoaC->nom_nome" style="max-widht: 150px; max-height: 150px;">
            @endif  
        </div>
        <div class="form-group col-md-8">
            <h1 class="h2" style="text-align:center;">{{$pessoaC->nom_nome}} @if($pessoaC->nom_apelido!=null) ({{$pessoaC->nom_apelido}}) @endif</h1>
            <div class="row" style="padding-left:10px; padding-bottom:5px;   align-items: center; justify-content: center;">
                <label class="col-form-label negrito">Tipo de Pessoa: </label>
                <div>
                    <div class="form-check form-check-inline" style="padding:5px;">
                        <input class="form-check-input" type="radio" name="ind_pessoa" id="ind_pessoa" onclick="checarF()" value="PF" @if($pessoaC->ind_pessoa == 'PF') checked @else disabled @endif >
                        <label class="form-check-label" for="gridRadios1">
                            Física
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio"  name="ind_pessoa"  onclick="checarJ()" value="PJ" @if($pessoaC->ind_pessoa == 'PJ') checked @else disabled @endif >
                        <label class="form-check-label" for="gridRadios2">
                            Juridica
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <h4 style="margin-bottom:0px;">Dados Pessoais</h4>
    <hr style="margin-top:0px;" class="col-md-10">

    <div class="form-row">
        <div class="form-group col-md-6">
            <label id="label1" class="col-form-label negrito" for="nom_nome">Nome</label>
            <label id="label2" class="col-form-label negrito" for="nom_nome" hidden="true">Razão Social</label>
            <i><label class="col-form-label" for="nom_nome"> - Campo Obrigatório</label></i> <!--Ou unico campo obrigatório?-->
            <input id="nom_nome" type="text" class="form-control col-md-10" name="nom_nome"  value="{{$pessoaC->nom_nome}}" autofocus  maxlength="150" required>
        </div>
        <div class="form-group col-md-6">
            @if($pessoaC->image !=null)
                <label class="col-form-label negrito" for="nome">Foto de perfil:</label>
                <input type="file" class="form-control col-md-10" name="img_perfil">
            @else
                <label class="col-form-label negrito" for="nome">Foto de perfil:</label>
                <input type="file" class="form-control col-md-10" name="img_perfil">                
            @endif
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-4">
            <label id="label3" class="col-form-label negrito" for="nom_apelido">Apelido</label>
            <label id="label4" class="col-form-label negrito" for="nom_apelido" hidden="true">Nome Fantasia</label>
            <input id="nom_apelido" type="text" class="form-control col-md-9" name="nom_apelido" value="{{$pessoaC->nom_apelido}}" maxlength="100">
        </div>
        <div class="form-group col-md-4">
            <label  id="label5" class="col-form-label negrito" for="nom_ocupacao">Profissão</label>
            <label  id="label6" class="col-form-label negrito" for="nom_ocupacao" hidden="true">Segmento de Atuação</label> <!--Deixar apenas segmento?-->
            <input  type="text" class="form-control col-md-9" name="nom_ocupacao" value="{{$pessoaC->nom_ocupacao}}" maxlength="150">
        </div>
        <div class="form-group col-md-4" id="label7">
            <label for="dat_nascimento" class="col-form-label negrito">Sexo</label>
            <div class="col-md-10" style="padding-left:0px; padding-top:7px;">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ind_sexo" id="ind_sexo" value="M" @if($pessoaC->ind_sexo == 'M') checked @endif>
                    <label class="form-check-label" for="inlineRadio1">Masculino</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ind_sexo" id="inlinind_sexo" value="F"  @if($pessoaC->ind_sexo == 'F') checked @endif>
                    <label class="form-check-label" for="inlineRadio2">Feminino</label>
                </div>
            </div>
        </div> 
        <div class="form-group col-md-4" id="label8" hidden="true">
            <label class="col-md-2 col-form-label negrito" for="nom_nome">Representante/Contato</label>
            <input id="nom_re" type="text" class="form-control col-md-9" name="nom_re"  value="{{$pessoaC->nom_re}}" maxlength="150">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-4">
            <label id="label9" name="label11" class="col-form-label negrito" for="cod_cpf_cnpj" >CPF:</label>
            <label id="label10" name="label11" class="col-form-label negrito" for="cod_cpf_cnpj" hidden="true">CNPJ</label>
            <input id="cod_cpf" type="text" class="form-control col-md-9 cpf" name="cod_cpf_cnpj"  value="{{$pessoaC->cod_cpf_cnpj}}">
            <input id="cod_cnpj" type="text" class="form-control col-md-9 cnpj" name="cod_cpf_cnpj" vvalue="{{$pessoaC->cod_cpf_cnpj}}" hidden="true" disabled="true">
        </div>
        <div class="form-group col-md-4" id="label11">
            <label class="col-form-label negrito" for="cod_rg">RG</label>
            <input id="cod_rg"  type="text" class="form-control col-md-9 rg" name="cod_rg" value="{{$pessoaC->cod_rg}}">
        </div> 
        <div class="form-group col-md-4" id="label12" hidden="true">
            <label class="col-form-label negrito" for="nom_re">Inscrição Estadual:</label>
            <input id="cod_ie" type="text" class="form-control col-md-9 ie" name="cod_ie" value="{{$pessoaC->cod_ie}}" maxlength="15">
        </div>     
        <div class="form-group col-md-4">
            <label id="label13" class=" col-form-label negrito" for="dat_nascimento">Data Nascimento</label>
            <label id="label14" class=" col-form-label negrito" for="dat_nascimento" hidden="true">Data de Constituição</label>
            <input id="dat_nascimento" type="date" name="dat_nascimento" value="{{$pessoaC->dat_nascimento}}" class="form-control input-md col-md-9 datepicker"  >
        </div>
    </div>

    <h4 style="margin-bottom:0px;">Endereço</h4>
    <hr style="margin-top:0px;" class="col-md-10">

    <div class="form-row">
        <div class="form-group col-md-4">
            <label class="col-form-label negrito">CEP</label>
            <input id="num_cep" type="text" class="form-control col-md-9 cep" name="num_cep" value="{{$pessoaC->num_cep}}" (focus)="painelAtivado()">
        </div>
        <div class="form-group col-md-4">
            <label class="col-form-label negrito">Cidade</label>
            <input id="nom_cidade" type="text" class="form-control col-md-9" name="nom_cidade" value="{{$pessoaC->nom_cidade}}" autocomplete="nom_cidade" maxlength="100">
        </div>    
        <div class="form-group col-md-4">
            <label class="col-form-label negrito">Estado</label>
            <select id="nom_estado" class="form-control col-md-9" name="nom_estado">
                <option name="" value="" @if($pessoaC->nom_estado=="") selected @endif>Selecione</option>
                <option name="AC" value="AC" @if($pessoaC->nom_estado=="AC") selected @endif>{{('Acre')}}</option>
                <option name="AL" value="AL" @if($pessoaC->nom_estado=="AL") selected @endif>{{('Alagoas')}}</option>
                <option name="AP" value="AP" @if($pessoaC->nom_estado=="AP") selected @endif>{{('Amapá')}}</option>
                <option name="AM" value="AM" @if($pessoaC->nom_estado=="AM") selected @endif>{{('Amazonas')}}</option>
                <option name="BA" value="BA" @if($pessoaC->nom_estado=="BA") selected @endif>{{('Bahia')}}</option>
                <option name="CE" value="CE" @if($pessoaC->nom_estado=="CE") selected @endif>{{('Ceará')}}</option>
                <option name="DF" value="DF" @if($pessoaC->nom_estado=="DF") selected @endif>{{('Distrito Federal')}}</option>
                <option name="ES" value="ES" @if($pessoaC->nom_estado=="ES") selected @endif>{{('Espírito Santo')}}</option>
                <option name="GO" value="GO" @if($pessoaC->nom_estado=="GO") selected @endif>{{('Goiás')}}</option>
                <option name="MA" value="MA" @if($pessoaC->nom_estado=="MA") selected @endif>{{('Maranhão')}}</option>
                <option name="MT" value="MT" @if($pessoaC->nom_estado=="MT") selected @endif>{{('Mato Grosso')}}</option>
                <option name="MS" value="MS" @if($pessoaC->nom_estado=="MS") selected @endif>{{('Mato Grosso do Sul')}}</option>
                <option name="MG" value="MG" @if($pessoaC->nom_estado=="MG") selected @endif>{{('Minas Gerais')}}</option>
                <option name="PA" value="PA" @if($pessoaC->nom_estado=="PA") selected @endif>{{('Pará')}}</option>
                <option name="PB" value="PB" @if($pessoaC->nom_estado=="PB") selected @endif>{{('Paraíba')}}</option>
                <option name="PR" value="PR" @if($pessoaC->nom_estado=="PR") selected @endif>{{('Paraná')}}</option>
                <option name="PE" value="PE" @if($pessoaC->nom_estado=="PE") selected @endif>{{('Pernambuco')}}</option>
                <option name="PI" value="PI" @if($pessoaC->nom_estado=="PI") selected @endif>{{('Piauí')}}</option>
                <option name="RJ" value="RJ" @if($pessoaC->nom_estado=="RJ") selected @endif>{{('Rio de Janeiro')}}</option>
                <option name="RN" value="RN" @if($pessoaC->nom_estado=="RN") selected @endif>{{('Rio Grande do Norte')}}</option>
                <option name="RS" value="RS" @if($pessoaC->nom_estado=="RS") selected @endif>{{('Rio Grande do Sul')}}</option>
                <option name="RO" value="RO" @if($pessoaC->nom_estado=="RO") selected @endif>{{('Rondônia')}}</option>
                <option name="RR" value="RR" @if($pessoaC->nom_estado=="RR") selected @endif>{{('Roraima')}}</option>
                <option name="SC" value="SC" @if($pessoaC->nom_estado=="SC") selected @endif>{{('Santa Catarina')}}</option>
                <option name="SP" value="SP" @if($pessoaC->nom_estado=="SP") selected @endif>{{('São Paulo')}}</option>
                <option name="SE" value="SE" @if($pessoaC->nom_estado=="SE") selected @endif>{{('Sergipe')}}</option>
                <option name="TO" value="TO" @if($pessoaC->nom_estado=="TO") selected @endif>{{('Tocantins')}}</option>
            </select>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-4">
            <label class="col-form-label negrito" for="nom_endereco">Endereço</label>
            <input id="nom_endereco" type="text" class="form-control col-md-9" name="nom_endereco" value="{{$pessoaC->nom_endereco}}" maxlength="250" >
        </div>
        <div class="form-group col-md-1">
            <label class="col-form-label negrito" for="nom_numero">Numero</label>
            <input id="nom_numero" type="text" name="nom_numero" class="form-control col-md-9" maxlength="10" value="{{$pessoaC->nom_numero}}"> 
        </div>
        <div class="form-group col-md-3">
            <label class="col-form-label negrito">Bairro</label>
            <input id="nom_bairro" type="text" class="form-control col-md-8" name="nom_bairro" value="{{$pessoaC->nom_bairro}}" maxlength="200">
        </div>    
        <div class="form-group col-md-4">
            <label class="col-form-label negrito" for="nom_complemento">Complemento</label>
            <input id="nom_complemento" type="text" name="nom_complemento" class="form-control col-md-9" value="{{$pessoaC->nom_complemento}}"> 
        </div>
    </div>

    <h4 style="margin-bottom:0px;">Contato</h4>
    <hr style="margin-top:0px;" class="col-md-10">

    <div class="form-row">
        <div class="form-group col-md-1">
            <label class="col-form-label negrito"  for="num_ddd_tel">DDD</label>
            <input id="num_ddd_tel" type="text" name="num_ddd_tel" class="form-control col-md-10 ddd" value="{{$pessoaC->num_ddd_tel}}">
        </div>
        <div class="form-group col-md-3">
            <label class="col-form-label negrito" for="num_tel">Telefone</label>
            <input id="num_tel" type="text" name="num_tel"  class="form-control col-md-8 phone" value="{{$pessoaC->num_tel}}">
        </div>
        <div class="form-group col-md-1">
            <label class="col-form-label negrito" for="num_ddd_cel">DDD</label>
            <input id="num_ddd_cel" type="text" name="num_ddd_cel" class="form-control col-md-10 ddd" value="{{$pessoaC->num_ddd_cel}}">
        </div>
        <div class="form-group col-md-3">
            <label class="col-form-label negrito" for="num_cel">Celular</label>
            <input id="num_cel" type="text" name="num_cel" class="form-control  col-md-8 input-md cel_phone" value="{{$pessoaC->num_cel}}">
        </div>
        <div class="form-group col-md-4">
            <label class="col-form-label negrito" for="nom_email">Email</label>
            <input id="nom_email" type="email" class="form-control col-md-9" name="nom_email" value="{{$pessoaC->nom_email}}" maxlength="100">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-11">
            <label class="col-form-label negrito" for="nom_rede_social">Rede Social</label>
            <input id="nom_rede_social" type="text" class="form-control" name="nom_rede_social" value="{{$pessoaC->nom_rede_social}}" placeholder="Exemplo: Facebook:https://www.facebook.com/jose.silva" maxlength="200">
        </div>
    </div>

    <hr style="margin-top:0px;" class="col-md-10">
    
    <div class="form-row">
        <div class="form-group col-md-11">
            <label class="col-form-label negrito" for="txt_obs">Observações</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" id="txt_obs" name="txt_obs">{{$pessoaC->txt_obs}}</textarea>
        </div>
    </div>    
    
    <input type="hidden" NAME="ind_status" VALUE="A">
    
    <div class="form-row div-botoes-cadastro">
        <div>           
            <button type="submit" class="btn btn-primary alterar">Alterar</button>
            <a href="javascript:history.back()" class="btn btn-primary alterar">Voltar</a>
        </div>
    </div>


<!--Chama o Script para decidir se é pessoa fisica ou juridica-->
    @if($pessoaC->ind_pessoa == 'PF')
        <script>
            document.getElementById("cod_cpf").disabled=false;
            document.getElementById("cod_cpf").hidden=false;
            document.getElementById("cod_cnpj").disabled=true;
            document.getElementById("cod_cnpj").hidden=true;
            var check = document.getElementsByName("ind_pessoa"); 
            //check[1].disabled = true;
            for(var i=2;i<15;i++){
                document.getElementById("label"+i).hidden=true;
                i++;
            }
            for(var j=1;j<15;j++){
                document.getElementById("label"+j).hidden=false;
                j++;
            }
        </script>
    @elseif($pessoaC->ind_pessoa == 'PJ')
        <script>
            document.getElementById("cod_cpf").disabled=true;
            document.getElementById("cod_cpf").hidden=true;
            document.getElementById("cod_cnpj").disabled=false;
            document.getElementById("cod_cnpj").hidden=false;
            for(var i=2;i<15;i++){
                document.getElementById("label"+i).hidden=false;
                i++;
            }
            for(var j=1;j<15;j++){
                document.getElementById("label"+j).hidden=true;
                j++;
        }
        </script>
    @endif
<!--Este script é chamado depois de carregar todo html, pois caso ao contrario ele não encontraria as labels.-->
</form>

</div>