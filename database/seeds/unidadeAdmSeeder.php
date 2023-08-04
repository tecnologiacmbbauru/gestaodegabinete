<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class unidadeAdmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gab_unidade_documento')->insert([
            'nom_uni_doc' => 'Câmara',
            'ind_uni_doc' => 'A',
        ]);
        DB::table('gab_unidade_documento')->insert([
            'nom_uni_doc' => 'Prefeitura',
            'ind_uni_doc' => 'A',
        ]);
    }
}
