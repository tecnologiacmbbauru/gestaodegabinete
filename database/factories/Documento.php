<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\documento;
use Faker\Generator as Faker;

$factory->define(documento::class, function (Faker $faker) {
    return [
        'nom_documento' => $faker->numberBetween(1,9999),
        'dat_ano'=> $faker->numberBetween(2016,2023),
        'lnk_documento'=> $faker->url,
        'link_resposta'=> $faker->url,
        'txt_assunto'=> $faker->text,
        'txt_resposta' => $faker->text,
        'nom_usuario_log' => "admin",
        'nom_operacao_log' => "insert",
        'ind_status'=> "A",
        'lembrete' =>  $faker->numberBetween(0,1),
        'dat_lembrete' =>  $faker->dateTimeBetween($startDate = '-1 years', $endDate = '+1 years', $timezone = null),
        'GAB_UNIDADE_DOCUMENTO_cod_uni_doc'=> $faker->numberBetween(1,2),
        'GAB_TIPO_DOCUMENTO_cod_tip_doc'=> $faker->numberBetween(1,3),
        'GAB_STATUS_DOCUMENTO_cod_status'=> $faker->numberBetween(1,4),
        'GAB_ATENDIMENTO_cod_atendimento'=> $faker->numberBetween(1,100),
        'dat_documento'=> $faker->dateTimeBetween($startDate = '-1 years', $endDate = '+1 years', $timezone = null),
        'dat_resposta'=> $faker->dateTimeBetween($startDate = '-1 years', $endDate = '+1 years', $timezone = null),
        'path_doc'=> $faker->url,
        'path_doc_resp'=> $faker->url,
    ];
});
