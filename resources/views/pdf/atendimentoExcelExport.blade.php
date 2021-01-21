<style type="text/css">
    .tabela tbody tr:nth-child(even) {
        background-color: #DCDCDC;
    }
    td{
        text-align="right";
    }
</style>
<table class=".tabela">
        <thead>
            <tr>
                <td>Data</td>
                <td>Nome</td>
                <td>CPF/CNPJ</td>
                <td>RG/IE</td>
                <td>Telefone</td>
                <td>Celular</td>
                <td>Bairro</td>
                <td>Cidade</td>
                <td>Estado</td>
                <td>Tipo Atendimento</td>
                <td>Situação Atendimento</td>
                <td>Detalhes</td>
            </tr>
        </thead>
        <tbody>
         @foreach($atendimentos as $atendimento)
            <tr>
                <td width="15">{{date('d/m/Y', strtotime($atendimento->dat_atendimento))}}</td>
                @if($atendimento->GAB_PESSOA_cod_pessoa!=null)
                    <td  width="25">
                        {{$atendimento->pessoa->nom_nome}}
                    </td>
                    <td  width="15">
                        {{$atendimento->pessoa->cod_cpf_cnpj}}
                    </td>
                    <td  width="15">
                        {{$atendimento->pessoa->cod_rg}}
                        @if ($atendimento->pessoa->ind_pessoa=="PJ")
                            {{$atendimento->pessoa->cod_ie}}
                        @endif
                    </td>
                    <td  width="20">
                        {{$atendimento->pessoa->num_ddd_tel}}-{{$atendimento->pessoa->num_tel}}
                    </td>
                    <td width="20">
                        {{$atendimento->pessoa->num_ddd_cel}}-{{$atendimento->pessoa->num_cel}}
                    </td>
                    <td width="20">
                        {{$atendimento->pessoa->nom_bairro}}
                    </td>
                    <td width="15">
                        {{$atendimento->pessoa->nom_cidade}}
                    </td>
                    <td width="15">
                        {{$atendimento->pessoa->nom_estado}}
                    </td>
                @else
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>    
                    <td></td>                
                @endif
                <td width="20">{{$atendimento->tipoAtendimento->nom_tipo}}</td>
                <td width="20">{{$atendimento->statusAtendimento->nom_status}}</td>
                <td width="20">{{$atendimento->txt_detalhes}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
