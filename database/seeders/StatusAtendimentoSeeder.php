<?php

namespace Database\seeders;

use App\Models\StatusAtendimento;
use Illuminate\Database\Seeder;

class StatusAtendimentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusAtendimento::create([
            'nom_status' => 'Aberto',
            'ind_status' => 'A',
        ]);
        StatusAtendimento::create([
            'nom_status' => 'Em andamento',
            'ind_status' => 'A',
        ]);
        StatusAtendimento::create([
            'nom_status' => 'Concluído',
            'ind_status' => 'A',
        ]);
    }
}
