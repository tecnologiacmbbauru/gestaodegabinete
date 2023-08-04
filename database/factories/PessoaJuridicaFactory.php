<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class PessoaJuridicaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ind_pessoa' => 'PJ',
            'nom_nome' => $this->faker->company.$this->faker->companySuffix,
            'nom_apelido' => $this->faker->company,
            'nom_ocupacao' => $this->faker->jobTitle,
            'cod_cpf_cnpj' => $this->faker->cnpj(false),
            'cod_ie' => $this->faker->isbn10,
            'nom_re' => $this->faker->name,
            'cod_rg' => "",
            'ind_sexo'  => "",
        ];
    }
}
