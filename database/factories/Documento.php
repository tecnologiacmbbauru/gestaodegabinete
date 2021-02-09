<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\documento;
use Faker\Generator as Faker;

$factory->define(documento::class, function (Faker $faker) {
    return [
        'nom_documento' => $faker->numberBetween(1,9999),
        'dat_ano'=> $faker->numberBetween(2015,2022),
        'lnk_documento'=> $faker->url,
        'link_resposta'=> $faker->url,
        'txt_assunto'=> $faker->text,
        'txt_resposta' => $faker->text,
        'nom_usuario_log' => "admin",
        'nom_operacao_log' => "insert",
        'ind_status'=> "A",
        'GAB_UNIDADE_DOCUMENTO_cod_uni_doc'=> $faker->numberBetween(1,2),
        'GAB_TIPO_DOCUMENTO_cod_tip_doc'=> $faker->numberBetween(1,3),
        'GAB_STATUS_DOCUMENTO_cod_status'=> $faker->numberBetween(1,4),
        'GAB_ATENDIMENTO_cod_atendimento'=> $faker->numberBetween(1,500),
        'dat_documento'=> $faker->date,
        'dat_resposta'=> $faker->date,
        'path_doc'=> $faker->url,
        'path_doc_resp'=> $faker->url,
    ];
});
