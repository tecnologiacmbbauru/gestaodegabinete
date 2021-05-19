<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Pessoa;
use Faker\Generator as Faker;

$factory->define(Pessoa::class, function (Faker $faker) {
    return [
        'ind_pessoa'=>'PF',
        'nom_nome' => $faker->name,
        'nom_apelido' => $faker->userName,
        'nom_ocupacao' => $faker->jobTitle,
        'cod_cpf_cnpj' => $faker->cpf(false),
        'cod_ie' => "",
        'nom_re' => "",
        'cod_rg' => $faker->rg(false),
        'ind_sexo'  => $faker->randomElement($array = array ('M','F')),
        'num_cep'  => $faker->postcode,
        'nom_endereco' => $faker->streetName,
        'nom_numero'  => $faker->buildingNumber,
        'nom_estado'  => $faker->stateAbbr,
        'nom_cidade'  => $faker->city,
        'num_ddd_tel' => $faker->areaCode,
        'num_tel' => $faker->landline,
        'num_ddd_cel' =>$faker->areaCode,
        'num_cel' => $faker->cellphone,
        'nom_email' => $faker->email,
        'nom_rede_social' => $faker->url,
        'ind_status' => "A",
        'txt_obs' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'dat_log' => $faker->date,
        'nom_usuario_log' => "admin",
        'nom_operacao_log' => "insert",
        'nom_bairro'  => $faker->city,
        'nom_complemento'  => $faker->streetSuffix,
        'dat_nascimento'  => $faker->date,
    ];
});
