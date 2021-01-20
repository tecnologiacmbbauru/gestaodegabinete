<?php

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
            'nom_uni_doc' => 'Secretaria de Obras',
            'ind_uni_doc' => 'A',
        ]);
        DB::table('gab_unidade_documento')->insert([
            'nom_uni_doc' => 'Prfeitura',
            'ind_uni_doc' => 'A',
        ]);
    }
}
