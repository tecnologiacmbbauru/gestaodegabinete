<div class="cadastro">
{{--<p style="padding:0px; margin:0px;"><strong>Dica:</strong> Preencha apenas o nome se quiser cadastrar uma pessoa de forma rapida.Você pode alterar o cadastro posteriormente para preencher os outros campos.</p>--}}
<form id="form_cadastro_pessoa" method="post" enctype="multipart/form-data" autocomplete="off">
    @csrf
    <h1 class="titulo" style="text-align:center; padding-right:10%;">Cadastro de Pessoa</h1>
    <div class="row" style="padding-bottom:5px;   align-items: center; justify-content: center; padding-right:8%;"> <!--justify-content:center;--->
        <label class="col-form-label negrito">Tipo de Pessoa: </label>
        <div>
            <div class="form-check form-check-inline" style="padding:5px;">
                <input class="form-check-input" type="radio" name="ind_pessoa" id="ind_pessoa" onclick="checarF()" value="PF" >
                <label class="form-check-label" for="gridRadios1">
                    Física
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"  name="ind_pessoa"  onclick="checarJ()" value="PJ">
                <label class="form-check-label" for="gridRadios2">
                    Juridica
                </label>
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
            <input id="nom_nome" type="text" class="form-control col-md-10" name="nom_nome" value="{{old('nom_nome')}}" autofocus  maxlength="150" required>
        </div>
        <div class="form-group col-md-4">
            <label class="col-sm-2 col-form-label negrito" for="nome">Foto</label>
            <input id="img_perfil" type="file" class="form-control col-md-12 input-arquivo" name="img_perfil" accept="image/*" />
            <label id="alert-foto" class="alert-obrigatorio" hidden="true">* A extensão do arquivo não é aceita.</label>
            <label id="alert-foto-tamanho" class="alert-obrigatorio" hidden="true">* O tamanho máximo de foto aceito é 25mb.</label>
            <label id="alert-foto-success" class="alert-success" hidden="true">* Foto carregada com sucesso.</label>
        </div>
        <div class="form-group col-md-2" style="padding-left:2%;">
            <label class="col-form-label negrito" for="nom_complemento">Webcam</label>
            <br>
            <button type="button" data-toggle="modal" data-target="#modalWebcam" class="btn-webcam" onclick="iniciaWebcan()"><img src="{{asset('Utils/webcam.png')}}" alt="Tirar foto com webcam" title="Tirar foto com webcam"></button>
            <input hidden id="foto_webcam" name="foto_webcam" value="">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-4">
            <label id="label3" class="col-form-label negrito" for="nom_apelido">Apelido</label>
            <label id="label4" class="col-form-label negrito" for="nom_apelido" hidden="true">Nome Fantasia</label>
            <input id="nom_apelido" type="text" class="form-control col-md-9" name="nom_apelido" value="{{old('nom_apelido')}}" maxlength="100">
        </div>
        <div class="form-group col-md-4">
            <label  id="label5" class="col-form-label negrito" for="nom_ocupacao">Profissão</label>
            <label  id="label6" class="col-form-label negrito" for="nom_ocupacao" hidden="true">Segmento de Atuação</label> <!--Deixar apenas segmento?-->
            <input  type="text" class="form-control col-md-9" name="nom_ocupacao" value="{{old('nom_ocupacao')}}" maxlength="150">
        </div>
        <div class="form-group col-md-4" id="label7">
            <label for="dat_nascimento" class="col-form-label negrito">Sexo</label>
            <div class="col-md-10" style="padding-left:0px; padding-top:7px;">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ind_sexo" id="ind_sexo" value="M">
                    <label class="form-check-label" for="inlineRadio1">Masculino</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ind_sexo" id="inlinind_sexo" value="F">
                    <label class="form-check-label" for="inlineRadio2">Feminino</label>
                </div>
            </div>
        </div> 
        <div class="form-group col-md-4" id="label8" hidden="true">
            <label class="col-md-2 col-form-label negrito" for="nom_nome">Representante/Contato</label>
            <input id="nom_re" type="text" class="form-control col-md-9" name="nom_re" value="{{old('nom_re')}}" maxlength="150">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-4">
            <label id="label9" name="label11" class="col-form-label negrito" for="cod_cpf_cnpj" >CPF:</label>
            <label id="label10" name="label11" class="col-form-label negrito" for="cod_cpf_cnpj" hidden="true">CNPJ</label>
            <input id="cod_cpf" type="text" class="form-control col-md-9 cpf" name="cod_cpf_cnpj" value="{{old('cod_cpf_cnpj')}}">
            <input id="cod_cnpj" type="text" class="form-control col-md-9 cnpj" name="cod_cpf_cnpj" value="{{old('cod_cpf_cnpj')}}" hidden="true" disabled="true">
        </div>
        <div class="form-group col-md-4" id="label11">
            <label class="col-form-label negrito" for="cod_rg">RG</label>
            <input id="cod_rg"  type="text" class="form-control col-md-9 rg" name="cod_rg" value="{{old('cod_rg')}}">
        </div> 
        <div class="form-group col-md-4" id="label12" hidden="true">
            <label class="col-form-label negrito" for="nom_re">Inscrição Estadual:</label>
            <input id="cod_ie" type="text" class="form-control col-md-9 ie" name="cod_ie" value="{{old('cod_ie')}}" maxlength="15">
        </div>     
        <div class="form-group col-md-4">
            <label id="label13" class=" col-form-label negrito" for="dat_nascimento">Data Nascimento</label>
            <label id="label14" class=" col-form-label negrito" for="dat_nascimento" hidden="true">Data de Constituição</label>
            <input id="dat_nascimento" type="date" name="dat_nascimento" placeholder="" class="form-control input-md col-md-9 datepicker">
        </div>
    </div>
    
    <h4 style="margin-bottom:0px;">Endereço</h4>
    <hr style="margin-top:0px;" class="col-md-10">

    <div class="form-row">
        <div class="form-group col-md-4">
            <label class="col-form-label negrito">CEP</label>
            <input id="num_cep" type="text" class="form-control col-md-9 cep" name="num_cep" (focus)="painelAtivado()">
        </div>
        <div class="form-group col-md-4">
            <label class="col-form-label negrito">Cidade</label>
            <input id="nom_cidade" type="text" class="form-control col-md-9" name="nom_cidade" value="{{old('nom_cidade')}}" autocomplete="nom_cidade" maxlength="100">
        </div>    
        <div class="form-group col-md-4">
            <label class="col-form-label negrito">Estado</label>
            @include('Utils/estados')
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-4">
            <label class="col-form-label negrito" for="nom_endereco">Endereço</label>
            <input id="nom_endereco" type="text" class="form-control col-md-9" name="nom_endereco" value="{{old('nom_endereco')}}" maxlength="250" >
        </div>
        <div class="form-group col-md-1">
            <label class="col-form-label negrito" for="nom_numero">Numero</label>
            <input id="nom_numero" type="text" name="nom_numero" class="form-control col-md-11" maxlength="10">
        </div>
        <div class="form-group col-md-3">
            <label class="col-form-label negrito">Bairro</label>
            <input id="nom_bairro" type="text" class="form-control col-md-8" name="nom_bairro" value="{{old('nom_bairro')}}" maxlength="200">
        </div>    
        <div class="form-group col-md-4">
            <label class="col-form-label negrito" for="nom_complemento">Complemento</label>
            <input id="nom_complemento" type="text" name="nom_complemento" class="form-control col-md-9">
        </div>
    </div>

    <h4 style="margin-bottom:0px;">Contato</h4>
    <hr style="margin-top:0px;" class="col-md-10">

    <div class="form-row">
        <div class="form-group col-md-1">
            <label class="col-form-label negrito"  for="num_ddd_tel">DDD</label>
            <input id="num_ddd_tel" type="text" name="num_ddd_tel" class="form-control col-md-10 ddd">
        </div>
        <div class="form-group col-md-3">
            <label class="col-form-label negrito" for="num_tel">Telefone</label>
            <input id="num_tel" type="text" name="num_tel"  class="form-control col-md-8 phone">
        </div>
        <div class="form-group col-md-1">
            <label class="col-form-label negrito" for="num_ddd_cel">DDD</label>
            <input id="num_ddd_cel" type="text" name="num_ddd_cel" class="form-control col-md-10 ddd">
        </div>
        <div class="form-group col-md-3">
            <label class="col-form-label negrito" for="num_cel">Celular</label>
            <input id="num_cel" type="text" name="num_cel" class="form-control  col-md-8 input-md cel_phone">
        </div>
        <div class="form-group col-md-4">
            <label class="col-form-label negrito" for="nom_email">Email</label>
            <input id="nom_email" type="email" class="form-control col-md-9" name="nom_email" value="{{old('nom_email')}}" maxlength="100">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-11">
            <label class="col-form-label negrito" for="nom_rede_social">Rede Social</label>
            <input id="nom_rede_social" type="text" class="form-control" name="nom_rede_social" value="{{old('nom_rede_social')}}" placeholder="Exemplo: Facebook:https://www.facebook.com/jose.silva" maxlength="200">
        </div>
    </div>

    <hr style="margin-top:0px;" class="col-md-10">
    
    <div class="form-row">
        <div class="form-group col-md-11">
            <label class="col-form-label negrito" for="txt_obs">Observações</label>
            <textarea class="form-control" rows="3" id="txt_obs" name="txt_obs"></textarea>
        </div>
    </div>
    {{--Modal de ajuda--}}
    @include('ajuda/modal_helpPessoa')

    <input type="hidden" NAME="ind_status" VALUE="A">

    <div class="form-row div-botoes-cadastro">
        <div>
            <button id="btn-cadastrar" type="submit" class="btn btn-primary">Cadastrar</button>
            <button id="btn-pesquisa" type="submit"  onclick="pesquisar()" class="btn btn-primary">Pesquisar</button>
            <button id="limpar" type="reset" class="btn btn-primary">Limpar</button>  
        </div>      
    </div>

</form>
@include('Utils/modal_webcam')
{{--Alteração de pessoa fisica e juridica e busca ou cadastro--}}
<script type="text/javascript">
    var checkInicio = document.getElementsByName("ind_pessoa"); //Inicia com pessoa fisica checada
    checkInicio[0].checked = true; 
    document.getElementById("nom_nome").required=true; 
    document.getElementById("form_cadastro_pessoa").action="{{route('pessoa.store')}}"; //inicia com a rota de cadastro de Pessoa
    
    function pesquisar(){ //quando clicado em pesquisar muda o mesmo form para a rota de pesquisa
       document.getElementById("nom_nome").required=false; //tira o requerimento de preencher o campo
       document.getElementById("form_cadastro_pessoa").action="{{route('pessoa.pesquisaPessoa')}}"; //Muda para a rota de pesquisa 
    }
</script>

{{--Valida a imagem que o usuario enviou--}}
<script type="text/javascript" defer>
    //Validação do input de documento
    $('#img_perfil').bind('change', function() {
        $("#btn-cadastrar").attr("disabled", false);//primeiro ativa o botão cadastrar caso estivesse desativado
        document.getElementById("alert-foto").hidden=true;//e esconde as mensagens de erro
        document.getElementById("alert-foto-tamanho").hidden=true; 
        document.getElementById("alert-foto-success").hidden=true; 

        if((this.files[0].size/1024/1024)>25){//valida se o tamanho é valido
            document.getElementById("img_perfil").focus;
            document.getElementById("alert-foto-tamanho").hidden=false; 
            $("#btn-cadastrar").attr("disabled", true);
        }else{ //valida se a extensão é valida
            if(this.files[0].type=="image/png" || this.files[0].type=="image/jpg" || this.files[0].type=="image/gif" || this.files[0].type=="image/jpeg" || this.files[0].type=="image/heic" || this.files[0].type=="image/heif"){
                return true;
            }else{ //caso a imagem não seja valida emite um aviso
                document.getElementById("alert-foto").hidden=false;
                jQuery('html, body').animate({scrollTop: 0}, 300); //Faz a animação da tela subindo até o topo, onde tem a mensagem
                document.getElementById("img_perfil").focus;
                $("#btn-cadastrar").attr("disabled", true);
            }
        }
    });
</script>
</div>

@if(Auth::user()->ajd_pessoa==1)
<script type="text/javascript" defer>
    jQuery(document).ready(function(){
        $('#ModalHelpPessoa').modal('show');
    });
</script>
@endif
