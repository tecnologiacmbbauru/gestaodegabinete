<div class="modal" id="ModalAuxiliarDocumento" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal-title" class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <input id="acao" value="" hidden>
                <button type="button" class="btn btn-primary" onclick="executaExclusao(document.getElementById('acao').value)">Sim</button> 
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function executaExclusao(acao){
        if(acao==="lembrete"){
            document.getElementById('fieldset_lembrete').innerHTML = "Lembrete Finalizado";
            document.getElementById('excluir_lembrete').value = "on";
            $('#ModalAuxiliarDocumento').modal('hide')
        }else if(acao==="atendimento"){
            document.getElementById('segunda_secao').innerHTML = "Atendimento desvinculado";
            document.getElementById('GAB_ATENDIMENTO_cod_atendimento').value = "";
            $('#ModalAuxiliarDocumento').modal('hide')
        }else if(acao==="resposta"){
            document.getElementById('terceira_secao').innerHTML = "Resposta excluída";
            document.getElementById('excluir_resposta').value = "on";
            $('#ModalAuxiliarDocumento').modal('hide')
        }
    }
</script>