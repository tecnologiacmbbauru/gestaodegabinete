<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class tipoAtendimentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gab_tipo_atendimento')->insert([
            'nom_tipo' => 'Saúde',
            'ind_tipo' => 'A',
        ]);
        DB::table('gab_tipo_atendimento')->insert([
            'nom_tipo' => 'Educação',
            'ind_tipo' => 'A',
        ]);
        DB::table('gab_tipo_atendimento')->insert([
            'nom_tipo' => 'Segurança',
            'ind_tipo' => 'A',
        ]);
        DB::table('gab_tipo_atendimento')->insert([
            'nom_tipo' => 'Infraestrutura',
            'ind_tipo' => 'A',
        ]);
    }
}
