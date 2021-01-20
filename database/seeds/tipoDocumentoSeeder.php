<?php

use Illuminate\Database\Seeder;

class tipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gab_tipo_documento')->insert([
            'nom_tip_doc' => 'Moção',
            'ind_tip_doc' => 'A',
        ]);
        DB::table('gab_tipo_documento')->insert([
            'nom_tip_doc' => 'Ofício',
            'ind_tip_doc' => 'A',
        ]);
        DB::table('gab_tipo_documento')->insert([
            'nom_tip_doc' => 'Requerimento',
            'ind_tip_doc' => 'A',
        ]);
        DB::table('gab_tipo_documento')->insert([
            'nom_tip_doc' => 'Projeto de Lei',
            'ind_tip_doc' => 'A',
        ]);
    }
}
