<?php

namespace Database\seeders;

use App\Models\Documento;
use Illuminate\Database\Seeder;
use database\factories\PessoaJuridicaFactory;

class PessoaJuridicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pessoa::factory()->count(500)->states('PJ')->make();
    }
}
