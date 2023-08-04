<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use database\factories\PessoaFactory;

class PessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Pessoa::class, 500)->create();
    }
}
