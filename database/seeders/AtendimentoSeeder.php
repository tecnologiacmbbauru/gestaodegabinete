<?php

namespace Database\seeders;

use App\Models\Atendimento;
use Illuminate\Database\Seeder;

class AtendimentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Atendimento::factory()->count(1000)->make();
    }
}
