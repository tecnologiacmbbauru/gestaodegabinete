{{--Verificar se dispostivo é desktop ou mobile--}}
@php
    $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
    $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
    $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
    $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
    $symbian = strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");

    if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
        $dispositivo = "mobile";
    }else{
        $dispositivo = "computador";
    } 
@endphp

<div id="topo-pesqPessoa"  style="margin-top:5px; display:flex">

    @if(isset($dataform) and $dispositivo=="mobile")
        <div class="row">
            <div class="col" style="margin-bottom: 20px;margin-top: 20px;display:flex;justify-content:center;align-items:center;">
                <form class="form-inline" method="post" target="_blank" action={{route('relatorio.Pessoa',['dataform'=>$dataform])}}>
                    @method('get')
                    <button type="submit" aria-label="Gerar relatório pdf" class="btn-pdf" style="background-color: #f5f5f5;" name="action" value="relatorio">
                        <img src="{{asset('utils/pdf.png')}}" alt="Exportar para PDF"  title="O relatório de PDF imprime até 500 registros">
                    </button>
                    <button type="submit" aria-label="Gerar relatório Excel" class="btn-pdf"  style="background-color: #f5f5f5;" name="action" value="relatorioExcel">
                        <img src="{{asset('utils/xls.png')}}" alt="Exportar para XLS" title="Exportar para XLS"> 
                    </button>
                </form>
            </div>
            <div class="col" style="margin-bottom: 20px;text-align:center;">
                    {{--Se existir mais de 15 dados abre os links--}}
                    @if(isset($dataform))
                        A pesquisa retornou: {{$pessoa->total()}} registros.
                        {!!$pessoa->appends($dataform)->links()!!}
                    @endif
            </div>
        </div>
    @endif

    @if(isset($dataform) and $dispositivo=="computador")
        <div class="col" style="margin-bottom: 15px;margin-top: 20px;">
            {{--Se existir mais de 15 dados abre os links--}}
            A pesquisa retornou: {{$pessoa->total()}} registros.
            @if(isset($dataform))        
                {!!$pessoa->appends($dataform)->links()!!}
            @endif
        </div>
        <div class="col-md-8" style="display:flex;justify-content:flex-end;align-items:center; margin-bottom: 10px;">
            <div>
            <form method="post" target="_blank" action={{route('relatorio.Pessoa',['dataform'=>$dataform])}}>
                @method('get')
                <button type="submit" aria-label="Gerar relatório pdf" class="btn-pdf" style="background-color: #f5f5f5;" name="action" value="relatorio">
                    <img src="{{asset('utils/pdf.png')}}" alt="Exportar para PDF" title="O relatório de PDF imprime até 500 registros">
                </button>
                <button type="submit" aria-label="Gerar relatório Excel" class="btn-pdf"  style="background-color: #f5f5f5;" name="action" value="relatorioExcel">
                    <img src="{{asset('utils/xls.png')}}" alt="Exportar para XLS" title="Exportar para XLS"> 
                </button>
            </form>
            </div>
        </div>
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
                    <th>Endereço</th> 
                    <th>E-mail</th>
                    <th>Telefone/Celular</th>     
                    <th style="text-align: center;">Alterar</th>
                    <th style="text-align: center;">Excluir</th>
                </tr>
            </thead>
            @if($pessoa->isEmpty()) {{--caso pesquisa não tenha resultado, o método isEmpty ja esta na classe LengthAwarePaginator na qual retorna a pesquisa paginada--}}
                <td colspan="8" style="text-align: center;">Não foi encontrado nenhum registro</td>
            @endif
            @foreach($pessoa as $pessoaC)
            <tbody>
                <td width='7%'><input type="checkbox" name="pessoa[]" value="{{$pessoaC->cod_pessoa}}"></td>
                <td  width='20%'>{{$pessoaC->nom_nome}}</td>
                <td  width='20%'>
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
                
                <td  width='5%' style="text-align: center;">
                        <a href="{{route('pessoa.edit',  $pessoaC->cod_pessoa)}}"><img src="{{asset('utils/alterar.png')}}" alt="Alterar"></a>                  
                    </form>
                </td>
                <td  width='5%' style="text-align: center;">
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
            
            //foca na tabela quando ela é criada
            $(document).ready(function() { 
                window.location.href='#topo-pesqPessoa';
            });


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