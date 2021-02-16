
<!-- Modal com Poup de confirmação de exclusão-->
<div class="modal" id="ModalAniversariante" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Dados do Aniversariante</h5> <img src="{{('utils/balloons.png')}}" alt="ballons" style="margin-left:10px;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <!--<img id="foto" src="" alt="foto do aniversariante" style="max-widht: 150px; max-height: 150px;">-->
            <b><label id="nome"></label>  <label id="apelido"></label></b>
            <br>
            <b>Endereço: </b><label id="rua"></label><label id="numero"></label><label id="bairro"></label><label id="cidade"></label><label id="estado"></label>
            <br>
            <b>Telefone: </b><label id="ddd_tel"></label><label id="telefone"></label>
            <br>
            <b>Celular: </b><label id="ddd_cel"></label><label id="celular"></label>
            <br>
            <b>Email: </b><label id="email"></label>
            <br>
            <b>Rede social: </b><a id="rede_social" style="color:#546e7a"></a>
            <br>
            <b>Texto de Observação: </b><label id="txt_obs"></label>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" data-dismiss="modal">Fechar</button> 
        </div>
      </div>
    </div>
  </div>
  