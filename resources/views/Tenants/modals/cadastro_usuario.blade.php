<!-- Modal -->
<div class="modal fade" id="cadUsuario" tabindex="-1" role="dialog" aria-labelledby="cadUsuario" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cadUsuario" style="color: black;">Cadastro de Usuário</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="col-form-label negrito">Nome</label>
                    <input id="name" type="text" name="name" class="form-control" > 
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="col-form-label negrito">Login</label>
                    <input id="user_name" type="text" name="user_name" class="form-control"> 
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="col-form-label negrito">E-mail</label>
                    <input id="email" type="text" name="email" class="form-control"> 
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="col-form-label negrito">Senha</label>
                    <input id="password" type="password" name="password" minlength="3" class="form-control"> 
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label class="col-form-label negrito">Confirmar Senha</label>
                    <input id="password-confirm" type="password" name="password-confirm" minlength="3" class="form-control" onkeyup="validarSenha()"> 
                    <label id="alert-senha" class="alert-obrigatorio" hidden="true">*Senhas digitadas não iguais</label>
                </div>
            </div>
            <input hidden name="domain" id="domain" value="{{$organizacao->domain}}">
            <input hidden name="id" id="id" value="{{$organizacao->id}}">
        </div>
        <div class="modal-footer">
          <button id="cadastrar" type="submit" class="btn btn-success">Cadastrar</button>
        </div>
      </div>
    </div>
</div>

<script type="text/javascript" defer>
    var password = document.getElementById("password"),confirm_password = document.getElementById("password-confirm");
    
    function validarSenha(){
        if(password.value != confirm_password.value) {
            document.getElementById("alert-senha").hidden=false;
            document.getElementById("cadastrar").disabled=true;
        } else {
            document.getElementById("alert-senha").hidden=true;
            document.getElementById("cadastrar").disabled=false;
        }
    }
</script>