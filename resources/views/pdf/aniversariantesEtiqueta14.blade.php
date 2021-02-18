<!DOCTYPE html>

<html lang="pt-br">
<head>
    <style type="text/css">
        @page { sheet-size: Letter; }
        @page bigger { sheet-size: 216mm 279mm; }
        @page toc { sheet-size: Letter; }
        *{
            font-family: Arial!important;
            font-size:13px;
            font-style:bold ;
        }
        body{
            /*padding-right:14px; /*Equivale a 0,5 centrimetros
            padding-left:14px;
            margin-top:2cm;
            margin-bottom:2,1cm;*/
            border:0cm;
            margin: 0cm;
        }
        table {
            margin-top:2,1cm;
            margin-bottom:2.1cm;
            margin-left:0.5cm;
            margin-right:0.5cm;
            table-layout: fixed;
            border:none; /*para debugar use 1px solid no lugar de none*/
            padding:0px;
            width:100%; /*vai ocupar todo espaço da folha tirando as margens/*20,6 CENTIMETRO no papel*/
            border-spacing: 0.3cm 0cm;/*0,3 centimetro de espalamento de uma celula para outra*/
        }
        td{
            margin:0px;
            padding:0px;
            border: 0px solid;
        }
        .celula{
            padding-left:0.1cm;
            min-width:10.1cm;   /*10,19cm;*/
            max-width:10.1cm;          /*10,19cm; */
            height:3.34cm;         /*3,39cm;*/
            white-space: nowrap;
            word-wrap: break-word;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .celula-esquerda{
            padding-left:0.2cm;
            min-width:10.1cm;
            max-width: 10.1cm;          /*10,19cm; */
            height:3.34cm;         /*3,39cm;*/
            white-space: nowrap;
            word-wrap: break-word;
            overflow: hidden;
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
                        <td class="celula-esquerda">
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
            @if($pularLinha != null)
                @for ($j=0;$j<$pularLinha;$j++) 
                    <tr>
                        <td class="celula"></td> 
                        <td class="celula"></td>
                    </tr>      
                @endfor
            @endif
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
                    <td class="celula-esquerda"> 
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