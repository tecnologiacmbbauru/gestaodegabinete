<!DOCTYPE html>

<html lang="pt-br">
<head>
    <style type="text/css">
        @page { sheet-size: Letter; }
        @page bigger { sheet-size: 216mm 279mm; }
        @page toc { sheet-size: Letter; }
        @page{
            margin-right:0.4cm;
            margin-left:0.4cm;
            margin-top:1.23cm !important;
            margin-bottom:1.23cm !important;
            padding:0px;
            *{
                font-family: Arial!important;
                font-size:13px;
                font-style: bold;
            }
            table {
                padding:0cm;
                table-layout: fixed;
                width:100%;
                height: 100%;
                border-spacing: 0.5cm 0cm;/*0,5 centimetro de espaçamento de uma celula para outra*/
            }
            body{
                border: 0cm;
                margin:0cm;
            }

            td{
                margin:0cm;
                padding:0cm;
                border:0px solid; /*1px solid;*/
            }
            .celula{
                padding-top: 0px;
                padding-left:0.1cm;
                /*min-width: 10.1cm;*/
                width: 10.19cm;          /*10,19cm; */
                height:2.5cm;              /*3,39cm;*/
                white-space: nowrap;
                word-wrap: break-word;
                overflow: hidden;
                padding-left: 0.5cm;
            }
            .celula-direita{
                padding-top: 0px;
                padding-left:0.1cm;
                /*min-width: 10.1cm;*/
                width: 10.19cm;          /*10,19cm; */
                height:2.5cm;              /*3,39cm;*/
                overflow: hidden; 
                text-overflow: ellipsis; 
                display: -webkit-box;
                -webkit-line-clamp: 1; 
                -webkit-box-orient: vertical; 
                padding-left: 1cm;
            }
        }

    </style>
</head>
<body>

    @if($remetende === null) {{--Tabela sem a etiqueta do remetende (agente politico)--}}
        <table>
            @if($pularLinha != null)
                @for ($j=0;$j<$pularLinha;$j++) 
                    <tr>
                        <td class="celula"></td> 
                        <td class="celula"></td>
                    </tr>      
                @endfor
            @endif
            @php $i=0; @endphp {{--Contador--}}
            @foreach($aniversariantes as $aniversariante)
                @if($i%2==0)
                    <tr>
                        <td class="celula">
                            {{$aniversariante->nom_nome}}
                            <br>
                            {{$aniversariante->nom_endereco}}-{{$aniversariante->nom_numero}}
                            <br>
                            {{$aniversariante->nom_bairro}}
                            <br>
                            {{$aniversariante->nom_cidade}}/{{$aniversariante->nom_estado}}-CEP:{{$aniversariante->num_cep}}
                        </td>
                @else
                        <td class="celula-direita">
                            {{$aniversariante->nom_nome}}
                            <br>
                            {{$aniversariante->nom_endereco}}-{{$aniversariante->nom_numero}}
                            <br>
                            {{$aniversariante->nom_bairro}}-{{$aniversariante->nom_complemento}}
                            <br>
                            {{$aniversariante->nom_cidade}}/{{$aniversariante->nom_estado}}-CEP:{{$aniversariante->num_cep}}
                        </td>
                    </tr>
                @endif
                @php $i++; @endphp
            @endforeach
        </table>
    @else
        <table> {{--Tabela com a etiqueta do remetende (agente politico)--}}
            @foreach($aniversariantes as $aniversariante)
                <tr>
                    <td class="celula">
                        {{$aniversariante->nom_nome}}
                        <br>
                        {{$aniversariante->nom_endereco}}-{{$aniversariante->nom_numero}}
                        <br>
                        {{$aniversariante->nom_bairro}} - {{$aniversariante->nom_complemento}}
                        <br>
                        {{$aniversariante->nom_cidade}}/{{$aniversariante->nom_estado}}-CEP:{{$aniversariante->num_cep}}
                    </td>
                    <td class="celula-direita"> 
                        {{$agentePolitico->cargoPolitico->nom_car_pol}} {{$agentePolitico->nom_vereador}}
                        <br>
                        {{$agentePolitico->nom_endereco}}-{{$agentePolitico->nom_numero}}
                        <br>
                        {{$agentePolitico->nom_complemento}}
                        <br>
                        {{$agentePolitico->nom_cidade}}/{{$agentePolitico->nom_estado}}-CEP:{{$agentePolitico->num_cep}}
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
</body>