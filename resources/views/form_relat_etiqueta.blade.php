@extends('layouts.app')

@section('content')
<head>
    <script src="{{ asset('js/jquery.min.js') }}"></script>

</head>
<body>
    <form id="form" class="form" method="post" action={{route('relatorio.pesquisaAniversario')}}>     
    @csrf
    <div class="container">
        <h1 class="titulo" style="text-align:center;">Etiquetas de Aniversariantes</h1> 

        <div >{{--class="relatorio-aniversario"--}}
            <div class="form-row justify-content-md-center" style="margin-right:25%;">
                <label class="col-form-label negrito" for="dia_inicial">Data Inicial</label>
            </div>
            <div class="form-row justify-content-md-center">
                <div class="form-group col-md-1" style="margin-right:0px;">
                    <select id="dia_inicial" class="form-control col-md-12" name="dia_inicial">
                        <option value="1" selected>1</option>
                        <option value="2" >2</option>
                        <option value="3" >3</option>
                        <option value="4" >4</option>
                        <option value="5" >5</option>
                        <option value="6" >6</option>
                        <option value="7" >7</option>
                        <option value="8" >8</option>
                        <option value="9" >9</option>
                        <option value="10" >10</option>
                        <option value="11" >11</option>
                        <option value="12" >12</option>
                        <option value="13" >13</option>
                        <option value="14" >14</option>
                        <option value="15" >15</option>
                        <option value="16" >16</option>
                        <option value="17" >17</option>
                        <option value="18" >18</option>
                        <option value="19" >19</option>
                        <option value="20" >20</option>
                        <option value="21" >21</option>
                        <option value="22" >22</option>
                        <option value="23" >23</option>
                        <option value="24" >24</option>
                        <option value="25" >25</option>
                        <option value="26" >26</option>
                        <option value="27" >27</option>
                        <option value="28" >28</option>
                        <option value="29" >29</option>
                        <option value="30" >30</option>
                        <option value="31" >31</option>
                    </select>
                </div>
                <div class="form-group col-md-3" style="margin-left:0px;">
                    <select id="mes_inicial" class="form-control col-md-12" name="mes_inicial">
                        <option value="01" selected>Janeiro</option>
                        <option value="02" >Fevereiro</option>
                        <option value="03" >Março</option>
                        <option value="04" >Abril</option>
                        <option value="05" >Maio</option>
                        <option value="06" >Junho</option>
                        <option value="07" >Julho</option>
                        <option value="08" >Agosto</option>
                        <option value="09" >Setembro</option>
                        <option value="10" >Outubro</option>
                        <option value="11" >Novembro</option>
                        <option value="12" >Dezembro</option>
                    </select> 
                </div>
            </div>

            <div class="form-row justify-content-md-center" style="margin-right:25%;">
                <label class="col-form-label negrito" for="dia_inicial">Data Final</label>
            </div>  
            <div class="form-row justify-content-md-center">
                <div class="form-group col-md-1">
                    <select id="dia_final" class="form-control col-md-12" name="dia_final">
                        <option value="1" >1</option>
                        <option value="2" >2</option>
                        <option value="3" >3</option>
                        <option value="4" >4</option>
                        <option value="5" >5</option>
                        <option value="6" >6</option>
                        <option value="7" >7</option>
                        <option value="8" >8</option>
                        <option value="9" >9</option>
                        <option value="10" >10</option>
                        <option value="11" >11</option>
                        <option value="12" >12</option>
                        <option value="13" >13</option>
                        <option value="14" >14</option>
                        <option value="15" >15</option>
                        <option value="16" >16</option>
                        <option value="17" >17</option>
                        <option value="18" >18</option>
                        <option value="19" >19</option>
                        <option value="20" >20</option>
                        <option value="21" >21</option>
                        <option value="22" >22</option>
                        <option value="23" >23</option>
                        <option value="24" >24</option>
                        <option value="25" >25</option>
                        <option value="26" >26</option>
                        <option value="27" >27</option>
                        <option value="28" >28</option>
                        <option value="29" >29</option>
                        <option value="30" >30</option>
                        <option value="31" selected>31</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <select id="mes_final" class="form-control col-md-12" name="mes_final">
                        <option value="01" >Janeiro</option>
                        <option value="02" >Fevereiro</option>
                        <option value="03" >Março</option>
                        <option value="04" >Abril</option>
                        <option value="05" >Maio</option>
                        <option value="06" >Junho</option>
                        <option value="07" >Julho</option>
                        <option value="08" >Agosto</option>
                        <option value="09" >Setembro</option>
                        <option value="10" >Outubro</option>
                        <option value="11" >Novembro</option>
                        <option value="12" selected>Dezembro</option>
                    </select> 
                </div>
            </div>    
        </div>
    </form>
    <div style="text-align:center;">    
        <button type="submit" class="btn btn-primary">Pesquisar</button>
        <button type="reset" class="btn btn-primary">Limpar</button>
    </div>

    @if(isset($pesquisa))
        <form class="form" method="post" target="_blank" action={{route('relatorio.imprimeEtiqueta')}}>
            @csrf
            <div class="table-of row">
                <table id="tb_aniversariantes" class="mtab table table-striped table-hover table-responsive-lg"  width="100%">
                    <thead class="thead-dark">
                        <tr>
                            <th><input type="checkbox" name="checkTodos" id="checkTodos"></th>
                            <th>Nome</th>
                            {{--<th>Doc.Indentificação</th>--}}
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Data</th>
                        </tr>
                    </thead> 
                    @if($aniversariantes->isEmpty()) {{--caso pesquisa não tenha resultado, o método isEmpty ja esta na classe LengthAwarePaginator na qual retorna a pesquisa paginada--}}
                        <td colspan="5" style="text-align: center;">Não foi encontrado nenhum registro</td>
                    @endif
                    @foreach($aniversariantes as $aniversariante)
                        <tbody> 
                            <td width='7%'><input type="checkbox" name="aniversariante[]" value="{{$aniversariante->cod_pessoa}}"></td>
                            <td  width='14%'>
                                {{$aniversariante->nom_nome}}
                            </td>
                            {{-- Não seria melhor os contatos? 
                                <td  width='14%'>
                                @if($aniversariante->ind_pessoa=='PF')
                                        @if($aniversariante->cod_cpf_cnpj!=null)
                                            <strong>CPF:</strong> <label class="cpf">{{$aniversariante->cod_cpf_cnpj}}</label>
                                        @endif
                                        <br>
                                        @if($aniversariante->cod_rg!=null)
                                            <strong>RG:</strong> <label class="rg">{{$aniversariante->cod_rg}}</label>
                                        @endif
                                @elseif($aniversariante->ind_pessoa=='PJ')
                                        @if($aniversariante->cod_cpf_cnpj!=null)
                                            <strong>CNPJ:</strong> <label class="cnpj">{{$aniversariante->cod_cpf_cnpj}}</label>
                                        @endif
                                        <br>
                                        @if($aniversariante->cod_ie!=null)
                                            <strong>I.E:</strong> <label class="ie">{{$aniversariante->cod_ie}}</label>
                                        @endif
                                @endif              
                            </td>
                            --}}
                            <td  width='14%'>
                                {{$aniversariante->num_ddd_tel}} <label class="phone">{{$aniversariante->num_tel}}</label>
                                <br>
                                {{$aniversariante->num_ddd_cel}} <label class="cel_phone">{{$aniversariante->num_cel}}</label>            
                            </td> 
                            <td  width='14%'>
                                {{$aniversariante->nom_email}}            
                            </td> 
                            <td  width='14%'>
                                {{date('d/m/Y', strtotime($aniversariante->dat_nascimento))}}            
                            </td> 
                        </tbody>
                    @endforeach
                </table>
            </div> 
            {!!$aniversariantes->appends($dataform)->links()!!}  
        
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
        </form>
        {{--Script que seleciona todas checkbox quando a de cima for clicada--}}
        <script type="text/javascript" defer>
            $("#checkTodos").click(function(){
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
            $("#submit-etiqueta").click(function(){
                var array = document.getElementsByName("aniversariante[]"); 
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
            //foca a tela na tebale, este scrpit esta dentro do if então só vai ser executado caso a tabela exista, ou seja tiver sido feito uma pesquisa
            $(document).ready(function() { 
                window.location.href='#tb_aniversariantes';
            });
        </script>
    @endif
    </div>
</body>
@endsection
