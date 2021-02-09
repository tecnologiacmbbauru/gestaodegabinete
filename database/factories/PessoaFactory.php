<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Pessoa;
use Faker\Generator as Faker;

$factory->define(Pessoa::class, function (Faker $faker) {
    return [
        'ind_pessoa'=>$faker->randomElement($array = array ('Pj','PF')),
        'nom_nome' => $faker->name,
        'nom_apelido' => $faker->userName,
        'nom_ocupacao' => $faker->text($maxNbChars = 8),
        'cod_cpf_cnpj' => $faker->isbn10,
        'cod_ie' => $faker->isbn10,
        'nom_re' => $faker->name,
        'cod_rg' => $faker->isbn10,
        'ind_sexo'  => $faker->randomElement($array = array ('M','F')),
        'num_cep'  => $faker->postcode,
        'nom_endereco' => $faker->streetName,
        'nom_numero'  => $faker->buildingNumber,
        'nom_estado'  => $faker->stateAbbr,
        'nom_cidade'  => $faker->city,
        'num_ddd_tel' => $faker->numberBetween(10,55),
        'num_tel' => $faker->numberBetween(11111111,99999999),
        'num_ddd_cel' =>    $faker->numberBetween(10,55),
        'num_cel' => $faker->numberBetween(1111111111,999999999),
        'nom_email' => $faker->email,
        'nom_rede_social' => $faker->url,
        'ind_status' => "A",
        'txt_obs' => $faker->text,
        'dat_log' => $faker->date,
        'nom_usuario_log' => "admin",
        'nom_operacao_log' => "insert",
        'nom_bairro'  => $faker->streetSuffix,
        'nom_complemento'  => $faker->streetSuffix,
        'dat_nascimento'  => $faker->date,
    ];
});
