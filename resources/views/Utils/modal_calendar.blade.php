  <!--Modal com os detalhes do evento-->
  <div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="h4 modal-title text-center">Detalhes do Evento</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h2 class="h3 text-center" id="titulo" style="margin-top: 0px;"></h2>
                <p>
                    <strong><span>Quando: </span></strong>
                    <span id="duracao"></span>
                </p>
                <p>
                    <strong><span id="titulolocal">Onde: </span></strong>
                    <span id="local"></span>
                </p>
                <p>
                    <strong><span id="titulodescricao">Descrição: </span></strong>
                    <span id="descricao"></span>
                </p>
            </div>
        </div>
    </div>
  </div>