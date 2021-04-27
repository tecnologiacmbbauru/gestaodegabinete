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
            margin-top:1.4cm !important;
            margin-bottom:1.23cm !important;
            padding:0px;
            {
                font-family: Arial!important;
                font-size:13px;
                font-style: bold;
            }
            table {
                padding:0cm;
                table-layout: fixed;
                width:100% !important;
                height: 100% !important;
                border-spacing: 0.3cm 0cm !important;/*0,3 centimetro de espalamento de uma celula para outra*/
            }
            body{
                border: 0cm !important;
                margin:0cm !important;
            }
            td{
                margin:0cm !important;
                padding:0cm !important;
                border:1px solid; /*1px solid;*/
            }
            .celula{
                margin:0cm !important;
                padding:0cm !important;
                width: 6.8cm !important;           
                height: 2.7cm !important;          
                padding-left:0.4cm !important;
                padding-bottom: 0.3cm !important;
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
                        <td class="celula"></td>
                    </tr>      
                @endfor
            @endif
            @php $i=0; @endphp {{--Contador--}}
            @foreach($aniversariantes as $aniversariante)
                @if($i==0) {{--Começo uma linha--}}
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
                    @php $i++; @endphp                            
                @elseif($i==2) {{--Termino uma linha--}}
                        <td class="celula">
                            {{$aniversariante->nom_nome}}
                            <br>
                            {{$aniversariante->nom_endereco}}-{{$aniversariante->nom_numero}}
                            <br>
                            {{$aniversariante->nom_bairro}}
                            <br>
                            {{$aniversariante->nom_cidade}}/{{$aniversariante->nom_estado}}-CEP:{{$aniversariante->num_cep}}
                        </td>                   
                    </tr>
                    @php $i=0; @endphp
                @else
                        <td class="celula">
                            {{$aniversariante->nom_nome}}
                            <br>
                            {{$aniversariante->nom_endereco}}-{{$aniversariante->nom_numero}}
                            <br>
                            {{$aniversariante->nom_bairro}}
                            <br>
                            {{$aniversariante->nom_cidade}}/{{$aniversariante->nom_estado}}-CEP:{{$aniversariante->num_cep}}
                        </td>
                    @php $i++; @endphp  
                @endif
            @endforeach
        </table>
    @else
        <table> {{--Tabela com a etiqueta do remetende (agente politico)--}}
            @if($pularLinha != null)
                @for ($j=0;$j<$pularLinha;$j++) 
                    <tr>
                        <td class="celula"></td> 
                        <td class="celula"></td>
                        <td class="celula"></td>
                    </tr>      
                @endfor
            @endif
            @php $iniLinha=true; $linhaImpar=true; @endphp {{--iniLinha = true se estiver começando ou false se estiver terminando uma linha
                                                            $linhaImpar = se a linha for impar imprime um aniversariante/agente/aniversariante
                                                                          se a linha for par imprime um agente/aniversariante/agente  --}}
            @foreach($aniversariantes as $aniversariante)
                @if($linhaImpar==true)
                    @if($iniLinha==true)
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
                            <td class="celula"> 
                                {{$agentePolitico->cargoPolitico->nom_car_pol}} {{$agentePolitico->nom_vereador}}
                                <br>
                                {{$agentePolitico->nom_endereco}}-{{$agentePolitico->nom_numero}}
                                <br>
                                {{$agentePolitico->nom_complemento}}
                                    <br>
                                {{$agentePolitico->nom_cidade}}/{{$agentePolitico->nom_estado}}-CEP:{{$agentePolitico->num_cep}}
                            </td> 
                            @php $iniLinha=false; $linhaImpar=true; @endphp
                    @else
                            <td class="celula">
                                {{$aniversariante->nom_nome}}
                                <br>
                                {{$aniversariante->nom_endereco}}-{{$aniversariante->nom_numero}}
                                <br>
                                {{$aniversariante->nom_bairro}} - {{$aniversariante->nom_complemento}}
                                <br>
                                {{$aniversariante->nom_cidade}}/{{$aniversariante->nom_estado}}-CEP:{{$aniversariante->num_cep}}
                            </td>  
                        </tr>  
                        @php $iniLinha=true; $linhaImpar=false; @endphp                
                    @endif
                @else
                    <tr>
                        <td class="celula"> 
                            {{$agentePolitico->cargoPolitico->nom_car_pol}} {{$agentePolitico->nom_vereador}}
                            <br>
                            {{$agentePolitico->nom_endereco}}-{{$agentePolitico->nom_numero}}
                            <br>
                            {{$agentePolitico->nom_complemento}}
                            <br>
                            {{$agentePolitico->nom_cidade}}/{{$agentePolitico->nom_estado}}-CEP:{{$agentePolitico->num_cep}}
                        </td> 
                        <td class="celula">
                            {{$aniversariante->nom_nome}}
                            <br>
                            {{$aniversariante->nom_endereco}}-{{$aniversariante->nom_numero}}
                            <br>
                            {{$aniversariante->nom_bairro}} - {{$aniversariante->nom_complemento}}
                            <br>
                            {{$aniversariante->nom_cidade}}/{{$aniversariante->nom_estado}}-CEP:{{$aniversariante->num_cep}}
                        </td>     
                        <td class="celula"> 
                            {{$agentePolitico->cargoPolitico->nom_car_pol}} {{$agentePolitico->nom_vereador}}
                            <br>
                            {{$agentePolitico->nom_endereco}}-{{$agentePolitico->nom_numero}}
                            <br>
                            {{$agentePolitico->nom_complemento}}
                            <br>
                            {{$agentePolitico->nom_cidade}}/{{$agentePolitico->nom_estado}}-CEP:{{$agentePolitico->num_cep}}
                        </td> 
                    </tr>     
                    @php $iniLinha=true; $linhaImpar=true; @endphp          
                @endif
            @endforeach
        </table>
    @endif
</body>


              {{-- @if($i==0)
                    <tr>
                        @if($par==false)
                            <td class="celula">
                                {{$aniversariante->nom_nome}}
                                <br>
                                {{$aniversariante->nom_endereco}}-{{$aniversariante->nom_numero}}
                                <br>
                                {{$aniversariante->nom_bairro}} - {{$aniversariante->nom_complemento}}
                                <br>
                                {{$aniversariante->nom_cidade}}/{{$aniversariante->nom_estado}}-CEP:{{$aniversariante->num_cep}}
                            </td>
                            @php $i++; $par=true; @endphp
                        @else
                            <td class="celula"> 
                                {{$agentePolitico->nom_vereador}}
                                <br>
                                {{$agentePolitico->nom_endereco}}-{{$agentePolitico->nom_numero}}
                                <br>
                                {{$agentePolitico->nom_complemento}}
                                    <br>
                                {{$agentePolitico->nom_cidade}}/{{$agentePolitico->nom_estado}}-CEP:{{$agentePolitico->num_cep}}
                            </td>
                            @php $i++; $par=false; @endphp
                        @endif
                @elseif($i==3)
                        @if($par==false)
                            <td class="celula">
                                {{$aniversariante->nom_nome}}
                                <br>
                                {{$aniversariante->nom_endereco}}-{{$aniversariante->nom_numero}}
                                <br>
                                {{$aniversariante->nom_bairro}} - {{$aniversariante->nom_complemento}}
                                <br>
                                {{$aniversariante->nom_cidade}}/{{$aniversariante->nom_estado}}-CEP:{{$aniversariante->num_cep}}
                            </td>
                            @php $par=true; @endphp
                        @else
                            <td class="celula"> 
                                {{$agentePolitico->nom_vereador}}
                                <br>
                                {{$agentePolitico->nom_endereco}}-{{$agentePolitico->nom_numero}}
                                <br>
                                {{$agentePolitico->nom_complemento}}
                                    <br>
                                {{$agentePolitico->nom_cidade}}/{{$agentePolitico->nom_estado}}-CEP:{{$agentePolitico->num_cep}}
                            </td>
                            @php $par=false; @endphp
                        @endif
                    </tr>
                    @php $i=0; @endphp
                @else 
                    @if($par==false)
                        <td class="celula">
                                {{$aniversariante->nom_nome}}
                                <br>
                                {{$aniversariante->nom_endereco}}-{{$aniversariante->nom_numero}}
                                <br>
                                {{$aniversariante->nom_bairro}} - {{$aniversariante->nom_complemento}}
                                <br>
                                {{$aniversariante->nom_cidade}}/{{$aniversariante->nom_estado}}-CEP:{{$aniversariante->num_cep}}
                            </td>
                            @php $i++; $par=true; @endphp
                    @else
                            <td class="celula"> 
                                {{$agentePolitico->nom_vereador}}
                                <br>
                                {{$agentePolitico->nom_endereco}}-{{$agentePolitico->nom_numero}}
                                <br>
                                {{$agentePolitico->nom_complemento}}
                                    <br>
                                {{$agentePolitico->nom_cidade}}/{{$agentePolitico->nom_estado}}-CEP:{{$agentePolitico->num_cep}}
                            </td>
                            @php $i++; $par=false; @endphp
                    @endif
                @endif   
                --}}   