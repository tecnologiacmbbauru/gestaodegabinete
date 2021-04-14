<div class="form-row" id="div_dat_lembrete">
    <div class="form-group col-md-12">
        <div class="form-inline">
            <label for="lembrar_dias" class="col-form-label negrito">Me lembre em</label>
                <input id="dias-lembrete" class="form-control col-md-1" maxlength="3" onkeyup="preencheData()" style="margin-left: 5px; margin-right: 5px;">
            <b style="margin-right: 10px;">dias.</b>
            <b>Data do lembrete:</b> <input class="form-control input-lembrar" id="dat_lembrete" name="dat_lembrete" type="date" style="margin-left:5px; margin-right:5px;" value="{{$docC->dat_lembrete}}">
        </div>
    </div>
</div>

<!--lembrar que existe um lembrete cadastrador-->
<input type="checkbox" id="lembrete" name="lembrete" checked hidden>

{{--Script responsavel por mudar os campos requiridos para caso de cadastro, e nenhuma campo requirido para caso de pesquisa--}}
<script type="text/javascript">
    function mostraLembrete(){
        document.getElementById('div_dat_lembrete').hidden = !document.getElementById('div_dat_lembrete').hidden;
    }
</script>

{{--Mostra dia em data--}}
<script type="text/javascript">
    //Função de:https://stackoverflow.com/questions/23593052/format-javascript-date-as-yyyy-mm-dd
    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) 
            month = '0' + month;
        if (day.length < 2) 
            day = '0' + day;

        return [year, month, day].join('-');
    }


    function preencheData(){
        dataAtual = new Date;
        var dias = parseInt(document.getElementById('dias-lembrete').value);
        dataAtual.setDate(dataAtual.getDate() + dias);  
        console.log(dataAtual,dias);
        //console.log(agora);     
        document.getElementById('dat_lembrete').value = formatDate(dataAtual);
    }

    $("#dat_lembrete").on("change", function(){
        var dataAtual = new Date;
        var dataSelecionada = new Date(document.getElementById('dat_lembrete').value);
        var diffMilissegundos = dataSelecionada - dataAtual;
        var diffSegundos = diffMilissegundos / 1000;
        var diffMinutos = diffSegundos / 60;
        var diffHoras = diffMinutos / 60;
        var diffDias = diffHoras / 24;
        diffDias = Math.ceil(diffDias);
        document.getElementById('dias-lembrete').value = diffDias;
    });

    $(document).ready(function(){
	// códigos jQuery a serem executados quando a página carregar
        var dataAtual = new Date;
        var dataSelecionada = new Date(document.getElementById('dat_lembrete').value);
        var diffMilissegundos = dataSelecionada - dataAtual;
        var diffSegundos = diffMilissegundos / 1000;
        var diffMinutos = diffSegundos / 60;
        var diffHoras = diffMinutos / 60;
        var diffDias = diffHoras / 24;
        diffDias = Math.ceil(diffDias);
        document.getElementById('dias-lembrete').value = diffDias;    
    });
</script>