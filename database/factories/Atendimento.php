<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Atendimento;
use Faker\Generator as Faker;

$factory->define(Atendimento::class, function (Faker $faker) {
    return [
        'dat_atendimento' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = '+1 years', $timezone = null),
        'txt_detalhes' =>$faker->realText($maxNbChars = 200, $indexSize = 2),
        'nom_usuario_log' => "admin",
        'nom_operacao_log' => "insert",
        'ind_status' => "A",
        'lembrete' =>  $faker->numberBetween(0,1),
        'dat_lembrete' =>   $faker->dateTimeBetween($startDate = '-1 years', $endDate = '+1 years', $timezone = null),
        'GAB_PESSOA_cod_pessoa' => $faker->numberBetween(1,100),
        'GAB_TIPO_ATENDIMENTO_cod_tipo' => $faker->numberBetween(1,4),
        'GAB_STATUS_ATENDIMENTO_cod_status' => $faker->numberBetween(1,3),
    ];
});
