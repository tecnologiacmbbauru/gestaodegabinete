<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Pessoa;
use Faker\Generator as Faker;

$factory->state(Pessoa::class,'PJ', function (Faker $faker) {
    return [
        'ind_pessoa'=>'PJ',
        'nom_nome' => $faker->company.$faker->companySuffix,
        'nom_apelido' => $faker->company,
        'nom_ocupacao' => $faker->jobTitle,
        'cod_cpf_cnpj' => $faker->cnpj(false),
        'cod_ie' => $faker->isbn10,
        'nom_re' => $faker->name,
        'cod_rg' => "",
        'ind_sexo'  => "",
    ];
});
