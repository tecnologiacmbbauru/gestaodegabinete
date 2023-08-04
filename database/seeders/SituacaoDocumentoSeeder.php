<?php

namespace Database\seeders;

use App\Models\SituacaoDoc;
use Illuminate\Database\Seeder;

class SituacaoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SituacaoDoc::create([
            'nom_status' => 'Enviado',
            'ind_status' => 'A',
        ]);
        SituacaoDoc::create([
            'nom_status' => 'Recebido',
            'ind_status' => 'A',
        ]);
        SituacaoDoc::create([
            'nom_status' => 'Aguardando resposta',
            'ind_status' => 'A',
        ]);
        SituacaoDoc::create([
            'nom_status' => 'Respondido',
            'ind_status' => 'A',
        ]);
    }
}
