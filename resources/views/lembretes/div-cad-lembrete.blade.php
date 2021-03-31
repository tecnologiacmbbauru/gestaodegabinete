<div class="form-row">
    <div class="form-group col-md-6">
        <div class="form-check form-check-inline" id="div_lembrar">
            <input class="form-check-input" type="checkbox" id="lembrete" name="lembrete" onclick="mostraLembrete(document.getElementById('div_dat_lembrete').hidden)">
            <label class="form-check-label negrito" for="div_lembrar">Adicionar Lembrete</label>
        </div>
    </div>
</div>
<div class="form-row" id="div_dat_lembrete" hidden>
    <div class="form-group col-md-6">
        <div class="form-inline" style="margin-bottom:5px;" >
            <label for="lembrar_dias" class="col-form-label negrito">Me lembre em</label><input class="input-lembrar" id="dat_lembrete" name="dat_lembrete" type="date" style="margin-left:5px; margin-right:5px;">
        </div>
    </div>
</div>

{{--Script responsavel por mudar os campos requiridos para caso de cadastro, e nenhuma campo requirido para caso de pesquisa--}}
<script type="text/javascript">
    function mostraLembrete(){
        document.getElementById('div_dat_lembrete').hidden = !document.getElementById('div_dat_lembrete').hidden;
    }
</script>