
<!-- Modal com Poup de confirmação de exclusão-->
<div class="modal" id="modalPesquisaAtend" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Pesquisar Atendimento</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div id="form_pesq_cadastro" style="display: block;">
                <div class="form-row" id="input_nom pessoa">
                    <div class="form-group col-md-12">
                        <label class="col-form-label negrito" for="input_nom_pessoa">Pessoa</label>
                        <input id="pessoa_busca" type="text" class="form-control" name="pessoa_busca" autofocus >
                        <input type="text" id='GAB_PESSOA_cod_pessoa' name="GAB_PESSOA_cod_pessoa" hidden="true"  readonly>
                        <img src="" alt="Imagem de Municipe" id="img_pessoa" name="img_pessoa" style="max-widht: 150px; max-height: 150px;" hidden="true">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class="col-form-label negrito" for="input_nom_pessoa">Data</label>
                        <input id="dat_atendimento" type="date" name="dat_atendimento" class="form-control input-md datepicker" autofocus > 
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class="col-form-label negrito" for="input_tipo_atendimento">Tipo de Atendimento</label>
                        <select  class="form-control" id="GAB_TIPO_ATENDIMENTO_cod_tipo">
                            @foreach ($tipoAtendimento as $tipoAtendimento)
                                <option  value="{{ $tipoAtendimento->cod_tipo}}">{{ $tipoAtendimento->nom_tipo}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">  
                        <label class="col-form-label negrito" for="input_status_atendimento">Situação do Atendimento</label>
                        <select  class="form-control" id="GAB_STATUS_ATENDIMENTO_cod_status">
                            @foreach ($statusAtendimento as $statusAtendimento)
                                <option  value="{{$statusAtendimento->cod_status}}">{{$statusAtendimento->nom_status}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Preencha todos campos para realizar uma busca.</label><!--Mudar-->
                    </div>
                </div>
                <a id="Cadastrar" class="btn btn-primary" >Cadastrar</a>
                <a id="Pesquisar" class="btn btn-primary" >Pesquisar</a>
            </div>
            
                <div class=form-group id="form_pesq_result" style="display:none;" >
                <label>Clique sobre um atendimento para selecionar</label>
                    <table id="tb_saida_pesquisa" class="mtab table table-hover table-responsive" cellspacing="10" width="100%">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Pessoa</th>
                            <th>Status</th>
                            <th>Tipo</th>
                        </tr>
                        <tbody id="resultado_pesquisa"></tbody>
                    </table>    
                </div>
            
                <div class=form-group id="form_cad_result" style="display:none;">
                    <h5 class="negrito">Atendimento Relacionado</h5>
                    <label style="font-weight: bolder">Data:</label> <label id="data"></label>
                    <br>
                    <label style="font-weight: bolder">Pessoa:</label> <label id="pessoa"></label>
                    <br>
                    <label style="font-weight: bolder">Doc.Identificação:</label> <label id="ident"></label>
                    <br>
                    <label style="font-weight: bolder">Tipo:</label> <label id="tipo"></label>
                    <br>
                    <label style="font-weight: bolder">Situação:</label> <label id="situacao"></label>
                    <br>
                    <input type="hidden" name="GAB_ATENDIMENTO_cod_atendimento" id="GAB_ATENDIMENTO_cod_atendimento"> <!--Passagem para o banco de dados-->
                    <a id="Alterar" class="btn btn-primary"> Alterar Atendimento</a> 
                </div>








            






        </div>
        {{--<div class="modal-footer">
          <button type="submit" class="btn btn-primary">Sim</button> <!--Submit que vai enviar o método delete esta aqui -->
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>--}}
      </div>
    </div>
  </div>
  