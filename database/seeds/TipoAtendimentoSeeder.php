<?php

namespace Database\Seeders;

use App\Models\TipoAtendimento;
use Illuminate\Database\Seeder;

class TipoAtendimentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoAtendimento::create([
            'nom_tipo' => 'Saúde',
            'ind_tipo' => 'A',
        ]);
        TipoAtendimento::create([
            'nom_tipo' => 'Educação',
            'ind_tipo' => 'A',
        ]);
        TipoAtendimento::create([
            'nom_tipo' => 'Segurança',
            'ind_tipo' => 'A',
        ]);
        TipoAtendimento::create([
            'nom_tipo' => 'Infraestrutura',
            'ind_tipo' => 'A',
        ]);
    }
}
