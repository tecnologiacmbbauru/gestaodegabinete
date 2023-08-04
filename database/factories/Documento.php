<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DocumentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom_documento' => $this->faker->numberBetween(1,9999),
            'dat_ano'=> $this->faker->numberBetween(2016,2023),
            'lnk_documento'=> $this->faker->url,
            'link_resposta'=> $this->faker->url,
            'txt_assunto'=> $this->faker->text,
            'txt_resposta' => $this->faker->text,
            'nom_usuario_log' => "admin",
            'nom_operacao_log' => "insert",
            'ind_status'=> "A",
            'lembrete' =>  $this->faker->numberBetween(0,1),
            'dat_lembrete' =>  $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = '+1 years', $timezone = null),
            'GAB_UNIDADE_DOCUMENTO_cod_uni_doc'=> $this->faker->numberBetween(1,2),
            'GAB_TIPO_DOCUMENTO_cod_tip_doc'=> $this->faker->numberBetween(1,3),
            'GAB_STATUS_DOCUMENTO_cod_status'=> $this->faker->numberBetween(1,4),
            'GAB_ATENDIMENTO_cod_atendimento'=> $this->faker->numberBetween(1,100),
            'dat_documento'=> $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = '+1 years', $timezone = null),
            'dat_resposta'=> $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = '+1 years', $timezone = null),
            'path_doc'=> $this->faker->url,
            'path_doc_resp'=> $this->faker->url,
        ];
    }
}
