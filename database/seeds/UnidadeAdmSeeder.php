<?php

namespace Database\Seeders;

use App\Models\UnidadeDocumento;
use Illuminate\Database\Seeder;

class UnidadeAdmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UnidadeDocumento::create([
            'nom_uni_doc' => 'Câmara',
            'ind_uni_doc' => 'A',
        ]);
        UnidadeDocumento::create([
            'nom_uni_doc' => 'Prefeitura',
            'ind_uni_doc' => 'A',
        ]);
    }
}
