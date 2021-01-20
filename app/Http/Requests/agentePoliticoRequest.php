<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class agentePoliticoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nom_vereador'                   =>'required|max:50',
            'nom_orgao'                      =>'nullable|max:150',
            'nom_numero'                     =>'nullable|max:100',
            'nom_complemento'                =>'nullable|max:200',
            'nom_cidade'                     =>'nullable|max:100',
            'nom_estado'                     =>'nullable',
            'num_cep'                        =>'nullable|max:9',
            'img_foto'                       =>'nullable',
            'tip_foto'                       =>'nullable',
            'tam_foto'                       =>'nullable',
            'GAB_CARGO_POLITICO_cod_car_pol' =>'nullable'
        ];
    }

    public function messages()
    {
        return[
            'nom_vereador.required' => "O nome do Agente Politico não foi preenchido!",
            'nom_orgao.max' => "Nome do orgão: O número de caracteres do excede o máximo permitido!",
            'nom_numero.max' => "Número: O número de caracteres do excede o máximo permitido!",
            'nom_complemento.max' => "Bairro/complemento: O número de caracteres do excede o máximo permitido!",
            'nom_cidade.max' => "Cidade: O número de caracteres do excede o máximo permitido!",
            'num_cep.max' => "CEP: O número de caracteres do excede o máximo permitido!"
        ];
    }
}
