<table>
    <thead>
        <tr>
            <td>Tipo</td>
            <td>Nome</td>
            <td>CPF/CNPJ</td>
            <td>RG/IE</td>
            <td>Telefone</td>
            <td>Celular</td>
            <td>Bairro</td>
            <td>Cidade</td>
            <td>Estado</td>
        </tr>
    </thead>
    <tbody>
         @foreach($pessoas as $pessoa)
            <tr>
                <td  width="10">
                    {{$pessoa->ind_pessoa}}
                </td>
                <td  width="15">
                    {{$pessoa->nom_nome}}
                </td>
                <td  width="10">
                    {{$pessoa->nom_apelido}}
                </td>            
                <td  width="15">
                    {{$pessoa->cod_cpf_cnpj}}
                </td>
                <td  width="15">
                    {{$pessoa->cod_rg}}
                </td>
                <td  width="20">
                    {{$pessoa->num_ddd_tel}}-{{$pessoa->num_tel}}
                </td>
                <td width="20">
                    {{$pessoa->num_ddd_cel}}-{{$pessoa->num_cel}}
                </td>
                <td width="15">
                    {{$pessoa->nom_bairro}}
                </td>
                <td width="15">
                    {{$pessoa->nom_cidade}}
                </td>
                <td width="15">
                    {{$pessoa->nom_estado}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>