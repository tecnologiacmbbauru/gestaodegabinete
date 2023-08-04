<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PessoaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ind_pessoa'=>'PF',
            'nom_nome' => $this->faker->name(),
            'nom_apelido' => $this->faker->userName(),
            'nom_ocupacao' => $this->faker->jobTitle(),
            'cod_cpf_cnpj' => $this->faker->cpf(false),
            'cod_ie' => "",
            'nom_re' => "",
            'cod_rg' => $this->faker->rg(false),
            'ind_sexo'  => $this->faker->randomElement($array = array ('M','F')),
            'num_cep'  => $this->faker->postcode(),
            'nom_endereco' => $this->faker->streetName(),
            'nom_numero'  => $this->faker->buildingNumber(),
            'nom_estado'  => $this->faker->stateAbbr(),
            'nom_cidade'  => $this->faker->city(),
            'num_ddd_tel' => $this->faker->areaCode(),
            'num_tel' => $this->faker->landline(),
            'num_ddd_cel' =>$this->faker->areaCode(),
            'num_cel' => $this->faker->cellphone(),
            'nom_email' => $this->faker->email(),
            'nom_rede_social' => $this->faker->url(),
            'ind_status' => "A",
            'txt_obs' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'dat_log' => $this->faker->date(),
            'nom_usuario_log' => "admin",
            'nom_operacao_log' => "insert",
            'nom_bairro'  => $this->faker->city(),
            'nom_complemento'  => $this->faker->streetSuffix(),
            'dat_nascimento'  => $this->faker->date(),
        ];
    }
}
