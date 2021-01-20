<div style="display:flex;justify-content:flex-end;align-items:center;margin-top:10px;">
    @if(isset($dataform))
        <form class="form-horizontal" method="post" target="_blank" action={{route('relatorio.Pessoa',['dataform'=>$dataform])}}>
            @method('get')
            <button type="submit" aria-label="Gerar relatório pdf" class="btn-pdf" style="background-color: #f5f5f5;" name="action" value="relatorio">
                <img src="{{asset('utils/pdf.png')}}" alt="Exportar para PDF" title="Exportar para PDF">
            </button>
            <button type="submit" aria-label="Gerar relatório Excel" class="btn-pdf"  style="background-color: #f5f5f5;" name="action" value="relatorioExcel">
                <img src="{{asset('utils/xls.png')}}" alt="Exportar para XLS" title="Exportar para XLS"> 
            </button>

        </form>
    @endif
</div>
<form class="form" method="post" target="_blank" action={{route('relatorio.imprimeEtiqueta')}}>
    @csrf
    <div class="table-of row">
        <table id="tb_pessoa" class="mtab table table-striped table-hover table-responsive-lg" width="100%">
            <thead class="thead-dark">
                <tr> 
                    <th><input type="checkbox" name="checkTodos" id="checkTodos"></th>   
                    <th>Nome</th>
                    <th>Doc. Identificação</th>
                    <th>Endereço/Bairro</th> 
                    <th>E-mail</th>
                    <th>Telefone/Celular</th>     
                    <th style="text-align: center;">Alterar</th>
                    <th style="text-align: center;">Excluir</th>
                </tr>
            </thead>
            @if($pessoa->isEmpty()) {{--caso pesquisa não tenha resultado, o método isEmpty ja esta na classe LengthAwarePaginator na qual retorna a pesquisa paginada--}}
                <td colspan="7" style="text-align: center;">Não foi encontrado nenhum registro</td>
            @endif
            @foreach($pessoa as $pessoaC)
            <tbody>
                <td width='7%'><input type="checkbox" name="pessoa[]" value="{{$pessoaC->cod_pessoa}}"></td>
                <td  width='15%'>{{$pessoaC->nom_nome}}</td>
                <td  width='15%'>
                    @if($pessoaC->ind_pessoa=='PF')
                        @if($pessoaC->cod_cpf_cnpj!=null)
                            <strong>CPF:</strong> <label class="cpf">{{$pessoaC->cod_cpf_cnpj}}</label>
                        @endif
                        <br>
                        @if($pessoaC->cod_rg!=null)
                            <strong>RG:</strong> <label class="rg">{{$pessoaC->cod_rg}}</label>
                        @endif
                    @elseif($pessoaC->ind_pessoa=='PJ')
                        @if($pessoaC->cod_cpf_cnpj!=null)
                            <strong>CNPJ:</strong> <label class="cnpj">{{$pessoaC->cod_cpf_cnpj}}</label>
                        @endif
                        <br>
                        @if($pessoaC->cod_ie!=null)
                            <strong>I.E:</strong> <label class="ie">{{$pessoaC->cod_ie}}</label>
                        @endif
                    @endif
                </td>
                <td  width='20%'>{{$pessoaC->nom_endereco}} {{$pessoaC->nom_numero}}
                    <br>@if($pessoaC->nom_bairro!=null){{$pessoaC->nom_bairro}},@endif
                    @if($pessoaC->nom_cidade!=null){{$pessoaC->nom_cidade}}/{{$pessoaC->nom_estado}}@endif
                </td>
                <td  width='10%'>{{$pessoaC->nom_email}}</td>
                <td  width='10%'>
                    {{$pessoaC->num_ddd_tel}} <label class="phone">{{$pessoaC->num_tel}}</label>
                    <br>
                    {{$pessoaC->num_ddd_cel}} <label class="cel_phone">{{$pessoaC->num_cel}}</label>
                </td>
                
                <td  width='10%' style="text-align: center;">
                        <a href="{{route('pessoa.edit',  $pessoaC->cod_pessoa)}}"><img src="{{asset('utils/alterar.png')}}" alt="Alterar"></a>                  
                    </form>
                </td>
                <td  width='10%' style="text-align: center;">
                    <form action="{{route('pessoa.destroy', "id_exclusao")}}" method="post">
                        @csrf
                        @method('DELETE')
                        <a type="button" data-toggle="modal" data-target="#modalExclusao" data-id_exclusao="{{$pessoaC->cod_pessoa}}"><img src="{{asset('utils/excluir.png')}}" alt="Excluir"></a>
                        @include('exclusao/exclusao_modal')
                    </form>
                </td>
            </tbody>
            @endforeach
        </table>
    </div> 
        <div>
            {{--Se existir mais de 15 dados abre os links--}}
            @if(isset($dataform))
                {!!$pessoa->appends($dataform)->links()!!}
            @endif
        </div>
        <hr>
        <div>
            <b><label>IMPRESSÃO DE ETIQUETAS</label></b><br>
            <input type="radio" name="tip_et" id="tip_et" value="14">
            Folha com <b>14 etiquetas</b> (02 colunas x 07 linhas)<br>
            <input type="radio" name="tip_et" id="tip_et" value="20" >
            Folha com <b>20 etiquetas</b> (02 colunas x 10 linhas)<br>
            <input type="radio" name="tip_et" id="tip_et" value="30" checked>
            Folha com <b>30 etiquetas</b> (03 colunas x 10 linhas)<br>
            <div style="line-height: 50px;"><input type="checkbox" name="op_re" id="op_re" checked > Deseja imprimir <b>Remetente (Agente Político)</b>?</div>
            Deseja <b>pular quantas linhas</b> da folha de etiquetas?
            <input name="pular" id="pular" type="number" min="0" max="9" >             
            <button id="submit-etiqueta" type="submit"><img src="{{asset('utils/print.png')}}" title="Gerar documento para impressão de Etiquetas"></button>
        </div>

        {{--Script que seleciona todas checkbox quando a de cima for clicada--}}
        <script type="text/javascript" defer>
            $("#checkTodos").click(function(){
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
            $("#submit-etiqueta").click(function(){
                var array = document.getElementsByName("pessoa[]"); 
                var cont = 0; //controle para saber se ao menos um checkbox esta marcado
                for (var i=0;i<array.length;i++){ 
                    if (array[i].checked == true){
                        cont = 1;
                        break;  
                    }
                }
                if (cont == 0){ //Nenhum checkbox selecionado
                    event.preventDefault();
                    alert("Selecione ao menos uma Pessoa para a impressão de etiquetas.");
                }
            });

        </script>
  
</form>
    <script src="{{asset('js/exclusao.js')}}"deffer></script>