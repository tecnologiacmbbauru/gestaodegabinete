<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class statusAtendimentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gab_status_atendimento')->insert([
            'nom_status' => 'Aberto',
            'ind_status' => 'A',
        ]);
        DB::table('gab_status_atendimento')->insert([
            'nom_status' => 'Em andamento',
            'ind_status' => 'A',
        ]);
        DB::table('gab_status_atendimento')->insert([
            'nom_status' => 'Concluído',
            'ind_status' => 'A',
        ]);
    }
}
