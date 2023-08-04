<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AtendimentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'dat_atendimento' => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = '+1 years', $timezone = null),
            'txt_detalhes' =>$this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'nom_usuario_log' => "admin",
            'nom_operacao_log' => "insert",
            'ind_status' => "A",
            'lembrete' =>  $this->faker->numberBetween(0,1),
            'dat_lembrete' =>   $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = '+1 years', $timezone = null),
            'GAB_PESSOA_cod_pessoa' => $this->faker->numberBetween(1,100),
            'GAB_TIPO_ATENDIMENTO_cod_tipo' => $this->faker->numberBetween(1,4),
            'GAB_STATUS_ATENDIMENTO_cod_status' => $this->faker->numberBetween(1,3),
        ];
    }
}
