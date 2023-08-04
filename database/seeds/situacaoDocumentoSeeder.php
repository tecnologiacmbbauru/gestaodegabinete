<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class situacaoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gab_status_documento')->insert([
            'nom_status' => 'Enviado',
            'ind_status' => 'A',
        ]);
        DB::table('gab_status_documento')->insert([
            'nom_status' => 'Recebido',
            'ind_status' => 'A',
        ]);
        DB::table('gab_status_documento')->insert([
            'nom_status' => 'Aguardando resposta',
            'ind_status' => 'A',
        ]);
        DB::table('gab_status_documento')->insert([
            'nom_status' => 'Respondido',
            'ind_status' => 'A',
        ]);
    }
}
