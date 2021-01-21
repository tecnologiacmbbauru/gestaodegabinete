<table>
    <thead>
        <tr>
            <td>Nome</td>
            <td>CPF/CNPJ</td>
            <td>RG/IE</td>
            <td>Endereço</td>
            <td>Bairro</td>
            <td>Cidade</td>
            <td>Estado</td>
            <td>Email</td>
            <td>Telefone</td>
            <td>Celular</td>
        </tr>
    </thead>
    <tbody>
         @foreach($pessoas as $pessoa)
            <tr>
                <td  width="15">
                    {{$pessoa->nom_nome}}
                </td>          
                <td  width="15">
                    {{$pessoa->cod_cpf_cnpj}}
                </td>
                <td  width="15">
                    {{$pessoa->cod_rg}}
                </td>
                <td width="15">
                    {{$pessoa->nom_endereco}}, {{$pessoa->nom_numero}}
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
                <td  width="20">
                    {{$pessoa->nom_email}}
                </td>
                <td  width="20">
                    {{$pessoa->num_ddd_tel}}-{{$pessoa->num_tel}}
                </td>
                <td width="20">
                    {{$pessoa->num_ddd_cel}}-{{$pessoa->num_cel}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>