<?php

namespace Database\seeders;

use App\Models\TipoDocumento;
use Illuminate\Database\Seeder;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoDocumento::create([
            'nom_tip_doc' => 'Carta',
            'ind_tip_doc' => 'A',
        ]);
        TipoDocumento::create([
            'nom_tip_doc' => 'Ofício',
            'ind_tip_doc' => 'A',
        ]);
        TipoDocumento::create([
            'nom_tip_doc' => 'Requerimento',
            'ind_tip_doc' => 'A',
        ]);
    }
}
