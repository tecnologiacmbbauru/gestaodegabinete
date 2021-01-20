<?php

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
            'nom_status' => 'Encaminhado',
            'ind_status' => 'A',
        ]);
        DB::table('gab_status_atendimento')->insert([
            'nom_status' => 'Resolvido',
            'ind_status' => 'A',
        ]);
    }
}
