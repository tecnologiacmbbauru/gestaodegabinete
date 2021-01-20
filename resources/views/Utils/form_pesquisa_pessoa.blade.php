    <form id="pesquisa_pessoa" class="form" method="post" action={{route('atendimento.pesquisa_pessoa')}}>
        <div class="form-group row" id="input_nom pessoa">
            <label class="col-md-2 col-form-label" for="input_nom_pessoa">Pessoa:</label>
            <div class="col-md-10">
                <input id="pessoa_busca" type="text" class="form-control" name="pessoa_busca" autofocus ><button on="click">Ok!</button>
                <input type="text" id='teste' readonly>
                <ul class="resultado"></ul>
            </div>        
        </div>
    </form>